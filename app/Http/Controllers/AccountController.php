<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;
use App\Mail\RegisterMail;
use App\Mail\PasswordMail;
use App\Models\User;
use Hash;
use Mail;

class AccountController extends Controller
{

    public function register_undergraduate(Request $request)
    {   
        $title = "STEP Undergraduate Registration -" . config('global.site_title');

        if ($request->isMethod('GET')) {
            return view('frontend.account.register-undergraduate', compact('title'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'school_name' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            
            $user_id = rand(0000,9999);
            $email = $request->input('email');
            $name = $request->input('first_name');
            $token = md5($request->input('email'));
            $details = [
                'user_id' => $user_id,
                'token' => $token,
                'name' => $name,
            ];


            try {
                Mail::to($email)->send(new RegisterMail($details));
                $user = User::create([
                    'title'=> $request->input('title'),
                    'first_name'=> $request->input('first_name'),
                    'last_name'=> $request->input('last_name'),
                    'phone'=> $request->input('phone'),
                    'email'=> $request->input('email'),
                    'user_id'=> $user_id,
                    'acc_status'=> 0,
                    'password'=> Hash::make($request->input('password')),
                    'school_name'=> $request->input('school_name'),
                    'user_type'=> "Undergraduate",
                    'member_status'=> "Pending",
                ]);
             
            
            return redirect("login")->with('status', ['text'=>'Great, you have successfully registered, Please verify your email','type'=>'success']);

            } catch (Throwable $e) {
                
                 return redirect("register")->with('status', ['text'=>'Error!, Your account could not be created, please contact admin','type'=>'danger']);
            }    

        }
    }


    public function register_young_professional(Request $request)
    {   
        $title = "STEP Registration -" . config('global.site_title');

        if ($request->isMethod('GET')) {
            return view('frontend.account.register', compact('title'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'profession' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            
            $user_id = rand(0000,9999);
            $email = $request->input('email');
            $name = $request->input('first_name');
            $token = md5($request->input('email'));
            $details = [
                'user_id' => $user_id,
                'token' => $token,
                'name' => $name,
            ];


            try {
                Mail::to($email)->send(new RegisterMail($details));
                $user = User::create([
                    'title'=> $request->input('title'),
                    'first_name'=> $request->input('first_name'),
                    'last_name'=> $request->input('last_name'),
                    'phone'=> $request->input('phone'),
                    'email'=> $request->input('email'),
                    'user_id'=> $user_id,
                    'acc_status'=> 0,
                    'password'=> Hash::make($request->input('password')),
                    'profession'=> $request->input('profession'),
                    'user_type'=> "Young Professional",
                    'member_status'=> "Pending",
                ]);
             
            
            return redirect("login")->with('status', ['text'=>'Great, you have successfully registered, Please verify your email','type'=>'success']);

            } catch (Throwable $e) {
                
                 return redirect("register")->with('status', ['text'=>'Error!, Your account could not be created, please contact admin','type'=>'danger']);
            }    

        }
    }

    public function register_corporate_professional(Request $request)
    {   
        $title = "STEP Registration -" . config('global.site_title');

        if ($request->isMethod('GET')) {
            return view('frontend.account.register-corporate-professional', compact('title'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'profession' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            
            $user_id = rand(0000,9999);
            $email = $request->input('email');
            $name = $request->input('first_name');
            $token = md5($request->input('email'));
            $details = [
                'user_id' => $user_id,
                'token' => $token,
                'name' => $name,
            ];


            try {
                Mail::to($email)->send(new RegisterMail($details));
                $user = User::create([
                    'title'=> $request->input('title'),
                    'first_name'=> $request->input('first_name'),
                    'last_name'=> $request->input('last_name'),
                    'phone'=> $request->input('phone'),
                    'email'=> $request->input('email'),
                    'user_id'=> $user_id,
                    'acc_status'=> 0,
                    'password'=> Hash::make($request->input('password')),
                    'profession'=> $request->input('profession'),
                    'user_type'=> "Corporate Professional",
                    'member_status'=> "Pending",
                ]);
             
            
            return redirect("login")->with('status', ['text'=>'Great, you have successfully registered, Please verify your email','type'=>'success']);

            } catch (Throwable $e) {
                
                 return redirect("register")->with('status', ['text'=>'Error!, Your account could not be created, please contact admin','type'=>'danger']);
            }    

        }
    }


    public function register_corporate_organization(Request $request)
    {   
        $title = "STEP Registration -" . config('global.site_title');

        if ($request->isMethod('GET')) {
            return view('frontend.account.register-corporate-organization', compact('title'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'company_name' => 'required',
                'phone' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);
            
            $user_id = rand(0000,9999);
            $email = $request->input('email');
            $name = $request->input('company_name');
            $token = md5($request->input('email'));
            $details = [
                'user_id' => $user_id,
                'token' => $token,
                'name' => $name,
            ];


            try {
                Mail::to($email)->send(new RegisterMail($details));
                $user = User::create([
                    'company_name'=> $request->input('company_name'),
                    'phone'=> $request->input('phone'),
                    'email'=> $request->input('email'),
                    'user_id'=> $user_id,
                    'acc_status'=> 0,
                    'password'=> Hash::make($request->input('password')),
                    'user_type'=> "Corporate Organisation",
                    'member_status'=> "Pending",
                ]);
             
            
            return redirect("login")->with('status', ['text'=>'Great, you have successfully registered, Please verify your email','type'=>'success']);

            } catch (Throwable $e) {
                
                 return redirect("register")->with('status', ['text'=>'Error!, Your account could not be created, please contact admin','type'=>'danger']);
            }    

        }
    }


    public function verifyaccount($user_id, $token)
    {       
        $user = User::where('user_id', $user_id)->first();
        $token2 = md5($user->email);
        if($token == $token2){
            $post = DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'acc_status'=> 1,
            ]);
            return redirect("login")->with('status',['text'=>'Email Verified, Please login','type'=>'success']);
        }else{

            return redirect("login")->with('status',['text'=>'Error!, the token does not match','type'=>'danger']);
        }
 
       
  
        
    }

    public function login(Request $request)
    {
        $title = "STEP Login - " . config('global.site_title');

        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:4',
            ]);
            
            $email = $request->email;
            $password = $request->password;

            $login = User::where('email', $email)
                        ->where('acc_status', 1)
                        ->first();
            if ($login) {
                if (Hash::check($password, $login->password)) {
                    $user_id = $login->user_id;
                    $request->session()->put('user_id', $user_id);

                   return redirect()->action([UserController::class, 'index']);
                }else{
                    return redirect("login")->with('status',['text'=>'Sorry, The password does not Match','type'=>'danger']);
                }
                
            }
      
            return redirect("login")->with('status',['text'=>'Opps! You have entered invalid credentials or account not Verified ','type'=>'danger']);
        }

        if ($request->isMethod('GET')) {
            return view('frontend.account.login', compact('title'));
        }
    }

    public function forgot_password(Request $request)
    {
        $title = "Forgot Password" . config('global.site_title');

        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required|email',
            ]);
            
            $email = $request->email;

            $login = User::where('email', $email)
                        ->first();
            if ($login) {
                $name = $login->first_name;
                $user_id = $login->user_id;
                $token = md5($email);

                $details = [
                    'user_id' => $user_id,
                    'token' => $token,
                    'name' => $name,
                ];

                try {
                    Mail::to($email)->send(new PasswordMail($details));
                    return redirect("login")->with('status',['text'=>'Please check your email for link to change password','type'=>'success']);

                } catch (Throwable $e) {
                
                    return redirect("login")->with('status',['text'=>'Sorry!, This email does not exit on our system, please register ','type'=>'danger']);
                }
      
            
            }
        }

        if ($request->isMethod('GET')) {
            return view('frontend.account.forgot-password', compact('title'));
        }
    }

    public function reset_password(Request $request, $user_id, $token)
    {    
        $title = "Reset Password" . config('global.site_title');
        $user = User::where('user_id', $user_id)->first();
        $token2 = md5($user->email);

        $post = [
                'user_id' => $user_id,
                'token' => $token,
            ];

        if ($request->isMethod('GET')) {

            if($token == $token2){
                return view('frontend.account.reset-password', compact('title','post'));
            }else{
                return redirect("login")->with('status',['text'=>'Sorry!, There was an error and token does not match, Please contact admin ','type'=>'danger']);
            }
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            
            $user = DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'password'=> Hash::make($request->input('password')),
            ]);
      
            return redirect("login")->with('status',['text'=>'Your password was successfully updated, Please Login ','type'=>'success']);
        }
       
    }


    public function adminlogin(Request $request)
    {
        $title = "Admin Login" . config('global.site_title');

        if ($request->isMethod('POST')) {
            $request->validate([
                'username' => 'required',
                'password' => 'required|min:4',
            ]);
            
            $username = $request->username;
            $password = $request->password;

            $login = Admin::where('username', $username)
               ->where('password', md5($password))
               ->first();
            if ($login) {
                $admin_id = $login->admin_id;
                $request->session()->put('admin_id', $admin_id);

               return redirect()->action([AdminController::class, 'index']);
            }
      
            return redirect("adminlogin")->with('status','Opps! You have entered invalid credentials');
        }

        if ($request->isMethod('GET')) {
            return view('frontend.admin', compact('title'));
        }
    }
}
