<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $title = "User Dashboard" . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
        
        return view('dashboard.index', compact('title','user'));
    }

    public function profile(Request $request)
    {   
        $title = "User Profile" . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();


        if ($request->isMethod('GET')) {
            return view('dashboard.profile', compact('title','user'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([

                'phone' => 'required|numeric',
                'address' => 'required',
                'city' => 'required',
                'state' => 'required',

            ]);
            
            try {
                $user = DB::table('users')
                    ->where('user_id', $user_id)
                    ->update([
                        'title'=> $request->input('title'),
                        'first_name'=> $request->input('first_name'),
                        'last_name'=> $request->input('last_name'),
                        'phone'=> $request->input('phone'),
                        'email'=> $request->input('email'),
                        'address'=> $request->input('address'),
                        'city'=> $request->input('city'),
                        'state'=> $request->input('state'),
                        'company_name'=> $request->input('company_name'),
                        'school_name'=> $request->input('school_name'),
                        'school_faculty'=> $request->input('school_faculty'),
                        'school_dept'=> $request->input('school_dept'),
                        'profession'=> $request->input('profession'),
                        'referee_name'=> $request->input('referee_name'),
                        'referee_phone'=> $request->input('referee_phone'),
                        'referee_email'=> $request->input('referee_email'),
                        'referee_address'=> $request->input('referee_address'),
                    ]);
             
            
            return redirect("user/profile")->with('status', ['text'=>'Your Profile has been updated','type'=>'success']);

            } catch (Throwable $e) {
                
                 return redirect("user/profile")->with('status', ['text'=>'Sorry! There was an error while updating profile','type'=>'danger']);
            }
        }
    }

    public function membership(Request $request)
    {   
        $title = "Proof of Payment" . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();

        if ($request->isMethod('GET')) {
            $proof = Payment::where('user_id', $user_id)->first();
            return view('dashboard.membership', compact('title','proof','user'));
        }

        if ($request->isMethod('POST')) {

            $request->validate([
                'payment_picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        
               ]);
            
            $imageName = rand(00000,99999).'-'.$request->file('payment_picture')->getClientOriginalName();
            $request->file('payment_picture')->move('uploads/payment', $imageName);
          
            
            $user = Payment::where('user_id', $user_id)->first();
  
            if (!is_null($user)) {
                DB::table('payments')
                    ->where('user_id', $user_id)
                    ->update([
                        'payment_picture'=> $imageName,
                    ]);
            }else{
                $user= Payment::create([
                    'user_id'=> $user_id,
                    'payment_amount'=> "5000",
                    'payment_status'=> "0",
                    'payment_picture'=> $imageName,
                ]);
            }


            return redirect('/user/membership')->with('status', ['text'=>'Payment Proof Successfully Uploaded','type'=>'success']);
        }
        
    }


    public function logout(Request $request)
    {   
        $request->session()->forget('user_id');
        return redirect("login")->with('status', ['text'=>'Logged out Successfully','type'=>'success']);
    }
}
