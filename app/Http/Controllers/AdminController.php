<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\User;
use App\Models\Payment;
use Carbon\CarbonInterval;

class AdminController extends Controller
{
    public $site_title = " - STEP";


    public function index()
    {   
        $title = "Admin Section" . config('global.site_title');
        $count_users = "4";
        $count_tvshow = "7";

        return view('backend.index', compact('title','count_users','count_tvshow'));
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
        $user = DB::table('users')
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
