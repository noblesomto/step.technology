<?php

namespace App\Http\Controllers\Exam\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ExamScoresExport;
use App\Mail\ExamResultApprovedMail;
use App\Models\Admin;
use App\Models\ExamBatch;
use App\Models\ExamScore;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Admin Section - " . config('global.site_name');
        $counts = DB::table('exam_scores')
            ->selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN score > 20 THEN 1 ELSE 0 END) as above_20,
                SUM(CASE WHEN score < 20 THEN 1 ELSE 0 END) as below_20,
                SUM(CASE WHEN score = 20 THEN 1 ELSE 0 END) as equal_20
            ')
            ->first();

            // Access the counts
            $count_above_20 = $counts->above_20;
            $count_below_20 = $counts->below_20;
            $count_equal_20 = $counts->equal_20;
            $total_count = $counts->total;
            //dd($total_count);
        return view('exam.backend.index', compact('title','total_count','count_above_20','count_below_20'));
    }

    public function enrollments(Request $request)
    {
        $title = "Exam Enrollments - " . config('global.site_name');

        $batches = ExamBatch::withCount('scores')->orderBy('starts_at', 'desc')->get();

        // Default to the active sitting if there is one and the admin
        // hasn't explicitly asked for a specific batch (or "all").
        $batchId = $request->input('batch');
        if ($batchId === null) {
            $batchId = ExamBatch::active()?->id;
        }

        $query = DB::table('users')
            ->join('exam_scores', 'users.user_id', '=', 'exam_scores.user_id')
            ->leftJoin('exam_batches', 'exam_scores.exam_batch_id', '=', 'exam_batches.id')
            ->select(
                'exam_scores.id as score_id',
                'users.user_id as user_id',
                'users.first_name',
                'users.last_name',
                'users.email',
                'exam_scores.score',
                'exam_scores.total_questions',
                'exam_scores.status',
                'exam_scores.exam_batch_id',
                'exam_batches.name as batch_name',
                'exam_scores.updated_at as exam_updated_at'
            );

        if ($batchId !== '' && $batchId !== null) {
            $query->where('exam_scores.exam_batch_id', $batchId);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('users.first_name', 'like', "%{$searchTerm}%")
                  ->orWhere('users.last_name', 'like', "%{$searchTerm}%")
                  ->orWhere('users.email', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('exam_scores.status', $request->status);
        }

        $usersWithScores = $query->orderBy('exam_scores.updated_at', 'desc')
            ->paginate(30)
            ->withQueryString();

        return view('backend.exam.enrollments', compact('title', 'usersWithScores', 'batches', 'batchId'));
    }

    public function exam_status($id, $status)
    {
        $score = ExamScore::findOrFail($id);
        $score->update(['status' => $status]);

        DB::table('users')
            ->where('user_id', $score->user_id)
            ->update([
                'exam_taken' => $status === 'pending' ? 'no' : 'yes',
                'updated_at' => Carbon::now(),
            ]);

        if ($status === 'approved') {
            $this->notifyUserOfApproval($score);
        }

        return redirect()->back()->with('status', ['text' => 'Exam result updated', 'type' => 'success']);
    }

    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'score_ids' => 'required|array',
            'score_ids.*' => 'integer|exists:exam_scores,id',
            'bulk_status' => 'required|in:approved,pending',
        ]);

        $scores = ExamScore::whereIn('id', $request->input('score_ids'))->get();

        foreach ($scores as $score) {
            $score->update(['status' => $request->input('bulk_status')]);

            DB::table('users')
                ->where('user_id', $score->user_id)
                ->update([
                    'exam_taken' => $request->input('bulk_status') === 'pending' ? 'no' : 'yes',
                    'updated_at' => Carbon::now(),
                ]);

            if ($request->input('bulk_status') === 'approved') {
                $this->notifyUserOfApproval($score);
            }
        }

        return redirect()->back()->with('status', [
            'text' => count($scores) . ' result(s) updated',
            'type' => 'success',
        ]);
    }

    protected function notifyUserOfApproval(ExamScore $score): void
    {
        $user = User::where('user_id', $score->user_id)->first();

        if ($user && $user->email) {
            try {
                Mail::to($user->email)->send(new ExamResultApprovedMail($user, $score));
            } catch (\Throwable $e) {
                \Log::error('Exam approval email failed: ' . $e->getMessage());
            }
        }
    }

    public function editScore($id)
    {
        $score = ExamScore::findOrFail($id);
        $user = User::where('user_id', $score->user_id)->first();
        $title = "Edit Exam Result - " . config('global.site_name');

        return view('backend.exam.edit-score', compact('title', 'score', 'user'));
    }

    public function updateScore(Request $request, $id)
    {
        $score = ExamScore::findOrFail($id);

        $request->validate([
            'score' => 'required|integer|min:0',
            'status' => 'required|in:pending,approved',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $wasApproved = $score->status === 'approved';

        $score->update([
            'score' => $request->input('score'),
            'status' => $request->input('status'),
            'admin_notes' => $request->input('admin_notes'),
        ]);

        DB::table('users')
            ->where('user_id', $score->user_id)
            ->update(['exam_taken' => $request->input('status') === 'pending' ? 'no' : 'yes']);

        if (!$wasApproved && $request->input('status') === 'approved') {
            $this->notifyUserOfApproval($score);
        }

        return redirect('/admin/enrollments')->with('status', ['text' => 'Exam result updated', 'type' => 'success']);
    }

    public function exportExcel(Request $request)
    {
        $batchId = $request->input('batch');
        $batch = $batchId ? ExamBatch::find($batchId) : null;
        $filename = ($batch ? \Illuminate\Support\Str::slug($batch->name) : 'all-batches') . '-exam-results.xlsx';

        return Excel::download(new ExamScoresExport($batchId), $filename);
    }

    public function exportPdf(Request $request)
    {
        $batchId = $request->input('batch');
        $batch = $batchId ? ExamBatch::find($batchId) : null;

        $results = DB::table('users')
            ->join('exam_scores', 'users.user_id', '=', 'exam_scores.user_id')
            ->when($batchId, fn ($q) => $q->where('exam_scores.exam_batch_id', $batchId))
            ->select('users.first_name', 'users.last_name', 'users.email', 'exam_scores.score', 'exam_scores.status', 'exam_scores.updated_at')
            ->orderBy('users.last_name')
            ->get();

        $pdf = Pdf::loadView('backend.exam.export-pdf', [
            'results' => $results,
            'batch' => $batch,
        ]);

        $filename = ($batch ? \Illuminate\Support\Str::slug($batch->name) : 'all-batches') . '-exam-results.pdf';

        return $pdf->download($filename);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->flush();
        return redirect("admin")->with('status', ['text'=>'Logged out Successfully','type'=>'success']);
    }
}
