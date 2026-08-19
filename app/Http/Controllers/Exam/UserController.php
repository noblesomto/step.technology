<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExamBatch;
use App\Models\ExamProgress;
use App\Models\ExamScore;
use Carbon\Carbon;

class UserController extends Controller
{
    const EXAM_DURATION_MINUTES = 35;
    const QUESTIONS_PER_TABLE = 10;
    const EXAM_TABLES = ['exam_ones', 'exam_twos', 'exam_threes', 'exam_fours'];

    public function index(Request $request)
    {
        $title = "My Account - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        $activeBatch = ExamBatch::active();
        $latestExam = ExamScore::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
        $activeBatchExam = $activeBatch
            ? ExamScore::where('user_id', $user_id)->where('exam_batch_id', $activeBatch->id)->first()
            : null;

        return view('exam.dashboard.index', compact('title', 'user', 'activeBatch', 'latestExam', 'activeBatchExam'));
    }

    public function start_exam(Request $request)
    {
        $title = "Take Exam - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        // Exams only run during an open sitting (batch), managed by admin.
        $activeBatch = ExamBatch::active();
        if (!$activeBatch) {
            return redirect()->route('user.index')
                ->with('info', 'There is no exam sitting open right now. Please check back later.');
        }

        // Already completed this sitting.
        $completedExam = ExamScore::where('user_id', $user_id)->where('exam_batch_id', $activeBatch->id)->first();
        if ($completedExam) {
            return redirect()->route('user.exam-done')
                ->with('info', 'You have already completed this exam sitting.');
        }

        // Resume this batch's in-progress session, or start a fresh one —
        // scoped to the batch so a stale session from a previous sitting is
        // never picked back up.
        $session = ExamProgress::where('user_id', $user_id)
            ->where('exam_batch_id', $activeBatch->id)
            ->where('is_complete', false)
            ->first();

        if (!$session) {
            $session = ExamProgress::create([
                'user_id' => $user_id,
                'exam_batch_id' => $activeBatch->id,
                'exam_session_id' => \Illuminate\Support\Str::uuid(),
                'question_ids' => $this->pickQuestionIds(),
                'start_time' => Carbon::now(),
                'current_question' => 0,
                'time_remaining' => self::EXAM_DURATION_MINUTES * 60,
                'answers' => [],
            ]);
        }

        // Actual time remaining, computed server-side from the pinned start time.
        $startTime = Carbon::parse($session->start_time);
        $endTime = $startTime->copy()->addMinutes(self::EXAM_DURATION_MINUTES);
        $remainingSeconds = now()->diffInSeconds($endTime, false);

        if ($remainingSeconds <= 0) {
            $this->finalizeExam($session, $session->answers ?? [], null);
            return redirect()->route('user.exam-done');
        }

        // Build the question payload for display — never expose which
        // option is correct; only shuffled option text is sent to the client.
        // Order must exactly match question_ids (answers[] is positional),
        // so a question deleted mid-sitting becomes a placeholder, not a gap.
        $questions = $this->resolveQuestions($session->question_ids)->map(function ($q) {
            if (!$q) {
                return ['id' => null, 'question' => 'This question is no longer available — please select any option to continue.', 'options' => ['Skip']];
            }

            return [
                'id' => $q->id,
                'question' => $q->question,
                'options' => collect([$q->answer1, $q->answer2, $q->answer3, $q->correct_answer])->shuffle()->values(),
            ];
        })->values();

        return view('exam.dashboard.start-exam', compact(
            'title', 'user', 'session', 'questions', 'remainingSeconds'
        ))->with('durationMinutes', self::EXAM_DURATION_MINUTES);
    }

    public function saveProgress(Request $request)
    {
        try {
            $validated = $request->validate([
                'exam_session_id' => 'required|string',
                'answers' => 'required|array',
                'current_question' => 'required|integer',
                'time_remaining' => 'required|integer',
                'is_complete' => 'required|boolean',
            ]);

            $user_id = $request->session()->get('user_id');

            ExamProgress::where('user_id', $user_id)
                ->where('exam_session_id', $validated['exam_session_id'])
                ->update([
                    'answers' => $validated['answers'],
                    'current_question' => $validated['current_question'],
                    'time_remaining' => $validated['time_remaining'],
                    'last_saved_at' => now(),
                ]);

            return response()->json(['success' => true, 'message' => 'Progress saved']);
        } catch (\Exception $e) {
            \Log::error('Save progress error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to save progress'], 500);
        }
    }

    public function submitExam(Request $request)
    {
        $validated = $request->validate([
            'exam_session_id' => 'required|string',
            'answers' => 'required|array',
            'time_taken' => 'nullable|integer',
            'is_complete' => 'required|boolean',
        ]);

        $user_id = $request->session()->get('user_id');

        $session = ExamProgress::where('user_id', $user_id)
            ->where('exam_session_id', $validated['exam_session_id'])
            ->first();

        if (!$session) {
            return response()->json(['success' => false, 'error' => 'Exam session not found'], 404);
        }

        if ($session->is_complete) {
            $exam = ExamScore::where('exam_session_id', $session->exam_session_id)->first();
            return response()->json(['success' => true, 'exam_id' => $exam?->id, 'score' => $exam?->score]);
        }

        $exam = $this->finalizeExam($session, $validated['answers'], $validated['time_taken'] ?? null);

        return response()->json(['success' => true, 'exam_id' => $exam->id, 'score' => $exam->score]);
    }

    public function exam_done(Request $request)
    {
        $title = "Exam Complete - " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        $examScore = ExamScore::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();

        return view('exam.dashboard.exam-done', compact('title', 'user', 'examScore'));
    }

    public function profile(Request $request)
    {
        $title = "My Profile | " . config('global.site_name');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        if ($request->isMethod('GET')) {
            return view('exam.dashboard.profile', compact('title', 'user'));
        }

        if ($request->isMethod('PUT')) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required|numeric',
            ]);

            $data = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
            ];

            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $imageName = time().'.'.$image->extension();
                $imageName = str_replace(' ', '-', $imageName);
                $image->move(public_path('uploads/profile'), $imageName);
                $data['profile_picture'] = $imageName;
            }

            DB::table('users')->where('user_id', $user_id)->update($data);

            return redirect("user/profile")->with('success', 'Profile updated successfully!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->flush();
        return redirect("login")->with('success', 'Successfully logged out');
    }

    /**
     * Randomly pick a pinned set of question ids (table + id) for a fresh
     * session. Persisted so the exact same questions, in the same order,
     * survive page reloads for the life of the session.
     */
    protected function pickQuestionIds(): array
    {
        $ids = [];

        foreach (self::EXAM_TABLES as $table) {
            foreach (DB::table($table)->inRandomOrder()->limit(self::QUESTIONS_PER_TABLE)->pluck('id') as $id) {
                $ids[] = ['table' => $table, 'id' => $id];
            }
        }

        return collect($ids)->shuffle()->values()->all();
    }

    /**
     * Resolve a pinned question_ids set back into full question rows,
     * preserving the original order (and therefore the answers[] index).
     */
    protected function resolveQuestions(array $questionIds)
    {
        $byTable = collect($questionIds)->groupBy('table');
        $rowsByTableAndId = [];

        foreach ($byTable as $table => $items) {
            $rowsByTableAndId[$table] = DB::table($table)
                ->whereIn('id', $items->pluck('id'))
                ->select('id', 'question', 'answer1', 'answer2', 'answer3', 'correct_answer')
                ->get()
                ->keyBy('id');
        }

        // Deliberately not filtered: every position must stay aligned with
        // question_ids / answers[], even if a question was later deleted.
        return collect($questionIds)
            ->map(fn ($q) => $rowsByTableAndId[$q['table']][$q['id']] ?? null);
    }

    /**
     * The only place a score is ever computed — always server-side, always
     * against the session's pinned question set. Client-submitted scores
     * are never trusted.
     */
    protected function scoreAnswers(array $questionIds, array $answers): int
    {
        $correctByIndex = $this->resolveQuestions($questionIds)->values()->map(fn ($q) => $q?->correct_answer);

        $score = 0;
        foreach ($answers as $index => $answer) {
            if ($answer !== null && $answer === ($correctByIndex[$index] ?? null)) {
                $score++;
            }
        }

        return $score;
    }

    /**
     * Score, persist, and mark complete — shared by manual submit, the
     * auto-submit-on-timeout path, and any retry.
     */
    protected function finalizeExam(ExamProgress $session, array $answers, ?int $timeTaken): ExamScore
    {
        $questionIds = $session->question_ids ?? [];
        $score = $this->scoreAnswers($questionIds, $answers);

        return DB::transaction(function () use ($session, $answers, $score, $questionIds, $timeTaken) {
            $exam = ExamScore::updateOrCreate(
                [
                    'user_id' => $session->user_id,
                    'exam_batch_id' => $session->exam_batch_id,
                ],
                [
                    'exam_session_id' => $session->exam_session_id,
                    'score' => $score,
                    'total_questions' => count($questionIds),
                    'answers' => json_encode($answers),
                    'time_taken' => $timeTaken,
                    'submitted_at' => now(),
                    'status' => 'pending',
                ]
            );

            $session->update([
                'answers' => $answers,
                'is_complete' => true,
                'completed_at' => now(),
            ]);

            DB::table('users')->where('user_id', $session->user_id)->update([
                'exam_taken' => 'yes',
                'updated_at' => now(),
            ]);

            return $exam;
        });
    }
}
