<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin;
use App\Models\User;
use App\Models\Payment;
use App\Models\Blog;
use App\Models\Event;
use Carbon\CarbonInterval;
use App\Mail\PaymentMail;
use Mail;

class AdminController extends Controller
{
    public $site_title = " - STEP";


    public function index()
    {
        $title = "Admin Section -" . config('global.site_title');

        $count_users = User::count();
        $count_verified_users = User::where('acc_status', 1)->count();
        $count_pending_verification = User::where('acc_status', 0)->count();
        $count_blog = Blog::count();
        $count_events = Event::count();

        $paymentCounts = DB::table('payments')
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN payment_status = 1 THEN 1 ELSE 0 END) as confirmed, SUM(CASE WHEN payment_status = 0 THEN 1 ELSE 0 END) as pending')
            ->first();

        $examCounts = DB::table('exam_scores')
            ->selectRaw('COUNT(*) as total, SUM(CASE WHEN status = "approved" THEN 1 ELSE 0 END) as approved, SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending')
            ->first();

        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        $recentPendingPayments = DB::table('payments')
            ->join('users', 'users.user_id', '=', 'payments.user_id')
            ->where('payments.payment_status', 0)
            ->select('users.first_name', 'users.last_name', 'users.user_id', 'payments.payment_amount', 'payments.created_at')
            ->orderBy('payments.created_at', 'desc')
            ->take(5)
            ->get();

        $recentBlogPosts = Blog::orderBy('created_at', 'desc')->take(4)->get();

        return view('backend.index', compact(
            'title',
            'count_users',
            'count_verified_users',
            'count_pending_verification',
            'count_blog',
            'count_events',
            'paymentCounts',
            'examCounts',
            'recentUsers',
            'recentPendingPayments',
            'recentBlogPosts'
        ));
    }

    
    public function payment()
    {   
        $user = DB::table('users')
                ->leftJoin('payments', 'users.user_id', '=', 'payments.user_id')
                ->whereNotNull('payments.payment_picture')
                ->where('payments.payment_status', 0)
                ->paginate(20); 
        $title = "Confirm Payments";
        return view('backend.payment', compact('title', 'user'));
    }

    public function confirm_payment($user_id)
    {   
        $user = User::where('user_id', $user_id)->first();

        //dd($user->first_name);
         DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'member_status'=> "Confirmed",
                'step_id'=> "STEP".rand(000000,999999),
            ]);
            DB::table('payments')
            ->where('user_id', $user_id)
            ->update([
                'payment_status'=> "1",
            ]);

        $details = [
            'user_id' => $user_id,
            'name' => $user->first_name,
        ];
        Mail::to($user->email)->send(new PaymentMail($details));
        return redirect("admin/payment")->with('status', ['text'=>'User Payment Confirmed','type'=>'success']);
      
    }

    public function inactive_users()
    {   
        $show = User::orderBy('created_at', 'desc')->where('acc_status', 0)->paginate(20);
        $title = "Inactive Users";
        return view('backend.affiliate.users', compact('title', 'show'));
    }



    public function search(Request $request)
    {   
        $search = $request->input('search');
        $show = DB::table('users')
                ->where('first_name', 'LIKE', '%'.$search.'%')
                ->orwhere('last_name', 'LIKE', '%'.$search.'%')
                ->orwhere('email', 'LIKE', '%'.$search.'%')
                ->paginate(20);
        $title = "Active Users";
        return view('backend.search', compact('title', 'show'));
    }

    public function users()
    {   
        $user = User::orderBy('created_at', 'desc')->paginate(20);
        $title = "Active Users -" . config('global.site_name');
        return view('backend.users', compact('title', 'user'));
    }

    public function view_user(Request $request, $user_id)
    {   
        $user = User::where('user_id', $user_id)->first();
        $title = "User Details";
        return view('backend.view-user', compact('title', 'user'));
    }

    public function disable_user($user_id, $status)
    {   
        $show = DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'acc_status'=> $status,
            ]);
        return redirect("admin/view-user/".$user_id)->with('status', ['text'=>'User Disabled','type'=>'success']);
      
    }

    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function delete_user($user_id) 
    {
        $user = User::where('user_id', $user_id)->first();
        $user->delete();

        $client = Client::where('user_id', $user_id)->first();
        $client->delete();

        $pay = Payment::where('user_id', $user_id)->first();
        $pay->delete();

        return redirect("admin/active-users")->with('status', ['text'=>'A user was deleted','type'=>'success']);

    }

    public function logout(Request $request)
    {   
        $request->session()->forget('admin_id');
        return redirect("adminlogin")->with('status', ['text'=>'Successfully Logged Out','type'=>'success']);
    }
}
