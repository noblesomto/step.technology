<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function users(Request $request)
    {
        $search = $request->input('search');

        $user = User::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'LIKE', '%'.$search.'%')
                      ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                      ->orWhere('email', 'LIKE', '%'.$search.'%')
                      ->orWhere('phone', 'LIKE', '%'.$search.'%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();

        $title = "Users -" . config('global.site_name');
        return view('backend.users.index', compact('title', 'user', 'search'));
    }

    public function createUser()
    {
        $title = "New User -" . config('global.site_name');
        return view('backend.users.create', compact('title'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:20',
            'phone' => 'required|string|max:255|unique:users,phone',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'user_type' => 'required|string|max:255',
            'acc_status' => 'required|in:0,1',
            'member_status' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);

        User::create([
            'user_id' => $this->generateUniqueUserId(),
            'title' => $request->input('title'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'gender' => $request->input('gender'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_type' => $request->input('user_type'),
            'acc_status' => $request->input('acc_status'),
            'member_status' => $request->input('member_status'),
            'profession' => $request->input('profession'),
            'company_name' => $request->input('company_name'),
            'school_name' => $request->input('school_name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
        ]);

        return redirect('/admin/users')->with('status', ['text' => 'User created successfully', 'type' => 'success']);
    }

    public function showUser($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $payment = Payment::where('user_id', $user_id)->first();
        $examScore = DB::table('exam_scores')->where('user_id', $user_id)->first();
        $title = "User Details -" . config('global.site_name');
        return view('backend.users.show', compact('title', 'user', 'payment', 'examScore'));
    }

    public function editUser($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $title = "Edit User -" . config('global.site_name');
        return view('backend.users.edit', compact('title', 'user'));
    }

    public function updateUser(Request $request, $user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();

        $request->validate([
            'title' => 'nullable|string|max:20',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'nullable|string|max:20',
            'phone' => 'required|string|max:255|unique:users,phone,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
            'user_type' => 'required|string|max:255',
            'acc_status' => 'required|in:0,1',
            'member_status' => 'nullable|string|max:255',
            'profession' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'school_name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);

        $data = $request->only([
            'title', 'first_name', 'last_name', 'gender', 'phone', 'email',
            'user_type', 'acc_status', 'member_status', 'profession',
            'company_name', 'school_name', 'address', 'city', 'state',
        ]);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return redirect('/admin/users/'.$user_id)->with('status', ['text' => 'User updated successfully', 'type' => 'success']);
    }

    public function updateUserStatus($user_id, $status)
    {
        User::where('user_id', $user_id)->update(['acc_status' => $status]);

        return redirect()->back()->with('status', ['text' => $status == 1 ? 'User verified' : 'User marked unverified', 'type' => 'success']);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    protected function generateUniqueUserId(): string
    {
        do {
            $id = (string) random_int(10000, 99999);
        } while (User::where('user_id', $id)->exists());

        return $id;
    }

    public function destroyUser($user_id)
    {
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();

        Payment::where('user_id', $user_id)->delete();

        return redirect('/admin/users')->with('status', ['text' => 'User deleted successfully', 'type' => 'success']);
    }

    public function logout(Request $request)
    {   
        $request->session()->forget('admin_id');
        return redirect("adminlogin")->with('status', ['text'=>'Successfully Logged Out','type'=>'success']);
    }
}
