<?php

namespace App\Http\Controllers\Exam\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ExamScore;
use App\Models\Admin;
use Carbon\Carbon;

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
        $query = DB::table('users')
        ->join('exam_scores', 'users.user_id', '=', 'exam_scores.user_id')
        ->select(
            'users.user_id as user_id',
            'users.first_name',
            'users.last_name',
            'users.email',
            'exam_scores.score',
            'exam_scores.status',
            'exam_scores.updated_at as exam_updated_at'
        );

    // Search functionality
    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('users.first_name', 'like', "%{$searchTerm}%")
              ->orWhere('users.last_name', 'like', "%{$searchTerm}%")
              ->orWhere('users.email', 'like', "%{$searchTerm}%");
        });
    }

    // Status filter
    if ($request->has('status') && !empty($request->status)) {
        $query->where('exam_scores.status', $request->status);
    }

    $usersWithScores = $query->orderBy('exam_scores.updated_at', 'desc')
                            ->paginate(30);
        //dd($usersWithScores);
        return view('exam.backend.enrollments', compact('title','usersWithScores'));
    }

    public function exam_status($id, $status)
    {
        DB::table('exam_scores')
                ->where('user_id', $id)
                ->update([
                    'status'=> $status,
                    'updated_at' => Carbon::now(),
                ]);

        if($status=="pending"){
            DB::table('users')
                ->where('user_id', $id)
                ->update([
                    'exam_taken' => "no",
                    'updated_at' => Carbon::now(),
                ]);
        }else{
            DB::table('users')
                ->where('user_id', $id)
                ->update([
                    'exam_taken' => "yes",
                    'updated_at' => Carbon::now(),
                ]);
        }


        return redirect()->back()->with('status', ['text'=>'Exam Score Approved','type'=>'success']);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->flush();
        return redirect("admin")->with('status', ['text'=>'Logged out Successfully','type'=>'success']);
    }
}
