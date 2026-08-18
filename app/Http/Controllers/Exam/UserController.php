<?php

namespace App\Http\Controllers\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\Deposit;
use App\Models\Exam;
use App\Models\ExamProgress;
use App\Models\ExamScore;
use Carbon\Carbon;
use Mail;
use App\Mail\CanceledBookingMail;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $title = "My Account - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        $exam = ExamScore::where('user_id', $user_id)->where('status','approved')->first();
        return view('exam.dashboard.index', compact('title','user','exam'));
    }

    public function start_exam(Request $request)
    {
        $title = "My Account - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        $examDurationMinutes = 35;

        // 🔥 CHECK IF USER HAS ALREADY COMPLETED AN EXAM
        $completedExam = ExamScore::where('user_id', $user_id)->first();
        if ($completedExam) {
            return redirect()->route('user.exam-done')
                ->with('info', 'You have already completed the exam.');
        }

        // 🔥 GET OR CREATE EXAM SESSION
        $session = ExamProgress::firstOrCreate(
            [
                'user_id' => $user_id,
                'is_complete' => false // Only look for incomplete sessions
            ],
            [
                'exam_session_id' => \Illuminate\Support\Str::uuid(),
                'start_time' => Carbon::now(),
                'current_question' => 0,
                'time_remaining' => $examDurationMinutes * 60,
                'answers' => json_encode([])
            ]
        );

        // 🔥 CALCULATE ACTUAL TIME REMAINING
        $startTime = Carbon::parse($session->start_time);
        $endTime = $startTime->copy()->addMinutes($examDurationMinutes);
        $remainingSeconds = now()->diffInSeconds($endTime, false);

        // 🔥 IF TIME IS UP, SCORE AND REDIRECT
        if ($remainingSeconds <= 0) {
            $this->scoreIncompleteExam($session);
            return redirect()->route('user.exam-done');
        }

        // 🔥 GET QUESTIONS (same across all sessions for fairness)
        $examTables = ['exam_ones', 'exam_twos', 'exam_threes', 'exam_fours'];
        $questions = collect();

        foreach ($examTables as $table) {
            $tableQuestions = DB::table($table)
                ->select('id','question', 'answer1', 'answer2', 'answer3', 'correct_answer')
                ->inRandomOrder()
                ->limit(2)
                ->get();

            $questions = $questions->merge($tableQuestions);
        }

        $questions = $questions->shuffle();

        return view('exam.dashboard.start-exam', compact('title', 'questions', 'user', 'session', 'remainingSeconds'));
    }

    public function saveProgress(Request $request)
    {
        try {
            $validated = $request->validate([
                'exam_session_id' => 'required|string',
                'answers' => 'required|array',
                'current_question' => 'required|integer',
                'time_remaining' => 'required|integer',
                'is_complete' => 'required|boolean'
            ]);

            $user_id = $request->session()->get('user_id');

            // 🔥 UPDATE OR CREATE PROGRESS
            ExamProgress::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'exam_session_id' => $validated['exam_session_id']
                ],
                [
                    'answers' => json_encode($validated['answers']),
                    'current_question' => $validated['current_question'],
                    'time_remaining' => $validated['time_remaining'],
                    'is_complete' => $validated['is_complete'],
                    'last_saved_at' => now()
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Progress saved successfully'
            ]);

        } catch (\Exception $e) {
            \Log::error('Save progress error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to save progress'
            ], 500);
        }
    }

    public function submitExam(Request $request)
    {
        try {
            $validated = $request->validate([
                'exam_session_id' => 'required|string',
                'answers' => 'required|array',
                'score' => 'required|integer',
                'time_taken' => 'integer',
                'is_complete' => 'required|boolean'
            ]);

            $user_id = $request->session()->get('user_id');

            DB::beginTransaction();

            // 🔥 SAVE FINAL EXAM SCORE
            $exam = ExamScore::updateOrCreate(
                [
                    'user_id' => $user_id
                ],
                [
                    'exam_session_id' => $validated['exam_session_id'],
                    'score' => $validated['score'],
                    'total_questions' => count($validated['answers']),
                    'answers' => json_encode($validated['answers']),
                    'time_taken' => $validated['time_taken'] ?? null,
                    'submitted_at' => now(),
                    'status' => 'pending' // Admin will approve
                ]
            );

            // 🔥 MARK PROGRESS AS COMPLETE
            ExamProgress::where('exam_session_id', $validated['exam_session_id'])
                ->update([
                    'is_complete' => true,
                    'completed_at' => now()
                ]);

            // 🔥 UPDATE USER STATUS
            DB::table('users')
                ->where('user_id', $user_id)
                ->update([
                    'exam_taken' => "yes",
                    'updated_at' => now(),
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'exam_id' => $exam->id,
                'score' => $validated['score']
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Exam submission error: ' . $e->getMessage());

            // 🔥 FALLBACK: TRY TO SCORE FROM SAVED PROGRESS
            return $this->scoreFromProgress($request);
        }
    }

    /**
     * 🔥 FALLBACK: Score exam from saved progress if submission fails
     */
    private function scoreFromProgress(Request $request)
    {
        try {
            $user_id = $request->session()->get('user_id');
            $exam_session_id = $request->input('exam_session_id');

            $progress = ExamProgress::where('user_id', $user_id)
                ->where('exam_session_id', $exam_session_id)
                ->first();

            if (!$progress) {
                return response()->json(['error' => 'No progress found'], 404);
            }

            $answers = json_decode($progress->answers, true);
            $score = $this->calculateScoreFromAnswers($answers);

            DB::beginTransaction();

            ExamScore::updateOrCreate(
                ['user_id' => $user_id],
                [
                    'exam_session_id' => $exam_session_id,
                    'score' => $score,
                    'total_questions' => count($answers),
                    'answers' => json_encode($answers),
                    'submitted_at' => now(),
                    'status' => 'pending'
                ]
            );

            ExamProgress::where('exam_session_id', $exam_session_id)
                ->update(['is_complete' => true]);

            DB::table('users')
                ->where('user_id', $user_id)
                ->update(['exam_taken' => "yes"]);

            DB::commit();

            return response()->json([
                'success' => true,
                'score' => $score,
                'note' => 'Scored from saved progress'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Complete failure'], 500);
        }
    }

    /**
     * 🔥 Score incomplete exam when time runs out
     */
    private function scoreIncompleteExam($session)
    {
        try {
            $answers = json_decode($session->answers, true) ?: [];
            $score = $this->calculateScoreFromAnswers($answers);

            DB::beginTransaction();

            ExamScore::updateOrCreate(
                ['user_id' => $session->user_id],
                [
                    'exam_session_id' => $session->exam_session_id,
                    'score' => $score,
                    'total_questions' => count($answers),
                    'answers' => json_encode($answers),
                    'submitted_at' => now(),
                    'status' => 'pending',
                    'time_taken' => 35 * 60 // Full time elapsed
                ]
            );

            ExamProgress::where('exam_session_id', $session->exam_session_id)
                ->update([
                    'is_complete' => true,
                    'completed_at' => now()
                ]);

            DB::table('users')
                ->where('user_id', $session->user_id)
                ->update(['exam_taken' => "yes"]);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Score incomplete exam error: ' . $e->getMessage());
        }
    }

    /**
     * 🔥 Calculate score from answers array by fetching correct answers
     */
    private function calculateScoreFromAnswers($answers)
    {
        if (empty($answers)) {
            return 0;
        }

        // Get all exam questions to compare answers
        $examTables = ['exam_ones', 'exam_twos', 'exam_threes', 'exam_fours'];
        $allQuestions = collect();

        foreach ($examTables as $table) {
            $questions = DB::table($table)
                ->select('correct_answer')
                ->get();
            $allQuestions = $allQuestions->merge($questions);
        }

        $score = 0;
        foreach ($answers as $index => $userAnswer) {
            if ($userAnswer && isset($allQuestions[$index])) {
                if ($userAnswer === $allQuestions[$index]->correct_answer) {
                    $score++;
                }
            }
        }

        return $score;
    }

    public function exam_done(Request $request)
    {
        $title = "Exam Complete - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        // 🔥 GET EXAM SCORE
        $examScore = ExamScore::where('user_id', $user_id)->first();
        $score = $examScore ? $examScore->score : 0;

        return view('exam.dashboard.exam-done', compact('score','title','user'));
    }

    // ... rest of your existing methods (cancel, benefits, profile, etc.)

    public function cancel(Request $request, $book_id)
    {
        $title = "My Account - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        $list = Listing::select("*")
                ->leftJoin('bookings', 'bookings.list_id', '=', 'listings.list_id')
                ->where("bookings.book_id", $book_id)
                ->where("bookings.user_id", $user_id)
                ->first();
        $totalAmount = calculateTotalAmount($user_id);
        return view('exam.dashboard.cancel-order', compact('title','user','list'));
    }

    public function cancel_order(Request $request, $book_id)
    {
        $title = "My Account - " . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        $email = $user->email;
        $list = Listing::select("*")
                ->leftJoin('bookings', 'bookings.list_id', '=', 'listings.list_id')
                ->leftJoin('deposits', 'bookings.book_id', '=', 'deposits.book_id')
                ->where("bookings.book_id", $book_id)
                ->first();

        $amount = $list->main_price;
        $details = [
            'subject' =>"Sorry to See You Go, " . $user->first_name ."!",
            'name' => $user->first_name,
            'amount' => $amount,
            'book_id' => $book_id,
            'property' => $list->list_title,
        ];

        try {
            Mail::to($email)->send(new CanceledBookingMail($details));

            DB::table('bookings')
                ->where('book_id', $book_id)
                ->update([
                    'book_status'=> "Canceled",
                    'cancel_date'=> now(),
                    'updated_at'=> now(),
                ]);
            return redirect("user/index")->with('success','Booking Order Successfully Canceled');
        } catch (Throwable $e) {
            return redirect("user/index")->with('error','There was a Temporary error canceling booking, Please Try again or contact support');
        }
    }

    public function benefits(Request $request)
    {
        $title = "User Benefits - " . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        return view('exam.dashboard.benefits', compact('title','user'));
    }

    public function profile(Request $request)
    {
        $title = "My Profile | " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        if ($request->isMethod('GET')) {
            return view('exam.dashboard.profile', compact('title','user'));
        }

        if ($request->isMethod('PUT')) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required|numeric',
            ]);

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time().'.'.$image->extension();
                $imageName = str_replace(' ', '-', $imageName);
                $request->file('profile_image')->move('uploads/profile', $imageName);

                $user = DB::table('users')
                    ->where('user_id', $user_id)
                    ->update([
                        'first_name'=> $request->input('first_name'),
                        'last_name'=> $request->input('last_name'),
                        'phone'=> $request->input('phone'),
                        'profile_picture'=> $imageName,
                    ]);
            } else {
                $user = DB::table('users')
                    ->where('user_id', $user_id)
                    ->update([
                        'first_name'=> $request->input('first_name'),
                        'last_name'=> $request->input('last_name'),
                        'phone'=> $request->input('phone'),
                    ]);
            }

            return redirect("user/profile")->with('success', 'Profile updated successfully!');
        }
    }

    public function accountDetails(Request $request)
    {
        $title = "Account Details | " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        if ($request->isMethod('GET')) {
            return view('exam.dashboard.account-details', compact('title','user'));
        }

        if ($request->isMethod('PUT')) {
            $request->validate([
                'bank_name' => 'required',
                'account_name' => 'required',
                'sort_code' => 'required|numeric',
            ]);

            if ($request->hasFile('alipay_qr')) {
                $image = $request->file('alipay_qr');
                $imageName = time().'.'.$image->extension();
                $imageName = str_replace(' ', '-', $imageName);
                $request->file('alipay_qr')->move('uploads/profile', $imageName);

                $user = DB::table('users')
                    ->where('user_id', $user_id)
                    ->update([
                        'bank_name'=> $request->input('bank_name'),
                        'account_name'=> $request->input('account_name'),
                        'sort_code'=> $request->input('sort_code'),
                        'alipay_qr'=> $imageName,
                    ]);
            } else {
                $user = DB::table('users')
                    ->where('user_id', $user_id)
                    ->update([
                        'bank_name'=> $request->input('bank_name'),
                        'account_name'=> $request->input('account_name'),
                        'sort_code'=> $request->input('sort_code'),
                    ]);
            }

            return redirect("user/account-details")->with('success', 'Profile updated successfully!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->flush();
        return redirect("login")->with('success','Successfully logged out ');
    }
}
