<?php

namespace App\Http\Controllers\Exam;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Exam\Admin\AdminController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\ReCaptcha;
use Mail;
use Hash;
use App\Mail\RegisterMail;
use App\Mail\RegisterReferredMail;
use App\Mail\Exam\NotifyMail;
use App\Mail\PasswordMail;
use App\Models\User;
use App\Models\Admin;


class AccountController extends Controller
{
    public function login(Request $request)
    {
        $title =  "Login  | " . config('global.site_name');

        if ($request->isMethod('POST')) {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:4',
            ]);
            
            $email = $request->email;
            $password = $request->password;
            $ip = $this->getIp();

            
            $login = User::where('email', $email)->first();
            

            if ($login) {
                if($login->acc_status==1){
                    if (Hash::check($password, $login->password)) {
                        $user_id = $login->user_id;
                        $name = $login->first_name;
                        $user = $login->acc_type;
                        $request->session()->put('user_id', $user_id);
                        $request->session()->put('name', $name);
                        $request->session()->put('email', $email);
                        
                        if ($request->session()->has('previous_url')) {
                            $previous_url = $request->session()->get('previous_url');

                            return redirect($previous_url);
                        } else {
                                return redirect()->action([UserController::class, 'index']);
                        }
                    }else{
                        return redirect("/login")->with('error','Sorry, The password does not Match');
                    }
                }else{
                    return redirect()->back()->with('error','Check your Email and Verify your account');
                }
                
            }else{
                return redirect("/login")->with('error','Sorry, The Email address does not exit');
            }
      
            return redirect("/login")->with('error','Opps! You have entered invalid credentials or account not Verified ');
        }

        if ($request->isMethod('GET')) {
            return view('exam.frontend.account.login', compact('title'));
        }
    }

    public function authenticate(Request $request)
    {
        $title = "OTP Authentication | " . config('global.site_name');
        

        if ($request->isMethod('POST')) {
            $request->validate([
                'otp' => 'required|numeric|min:4',
            ]);
            
            $user_id = $request->session()->get('user_id');
            if($user_id ==''){
                return redirect("/login")->with('error','Sorry, Your Session has expired. Refresh');
            }

            $otp = $request->otp;

            $login = User::where('otp', $otp)
                        ->where('user_id', $user_id)
                        ->first();
            $user= $login->acc_type;

            if ($login) {
                return redirect()->action([UserController::class, 'index']);
                        
            }else{
                return redirect("/authenticate")->with('error','Opps! You have entered invalid OTP ');
            }
      
            
        }

        if ($request->isMethod('GET')) {
            return view('exam.frontend.account.authenticate', compact('title'));
        }
    }


    public function account_status(Request $request)
    {   
        $title = "Account Status  " . config('global.site_title');
        $user_id = $request->session()->get('user_id');
        $user = User::where('user_id', $user_id)->first();
               
        return view('exam.frontend.account-status', compact('title','user'));
    }


    public function resend_otp(Request $request)
    {
         
        $user_id = $request->session()->get('user_id');
        $login = User::where('user_id', $user_id)
                        ->first();
        $otp = rand(111111,999999);
        $email = $login->email;
        $name = $login->first_name;

        DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'otp'=> $otp,
            ]);

        $details = [
            'user_id' => $user_id,
            'otp' => $otp,
            'name' => $name,
            'ip' => $this->getIp(),
        ];

        try {
            Mail::to($email)->send(new NotifyMail($details));
            return redirect("/authenticate")->with('status', ['text'=>'Check your email for OTP to login','type'=>'success']);
        } catch (Throwable $e) {
             return redirect("/")->with('status', ['text'=>'Error!, OTP could not be sent, please try again or contact admin','type'=>'danger']);
        }
      
            
    }

    public function register(Request $request, $ref_id = null)
    {   
        $title = "Create an Account | " . config('global.site_name');

        if ($request->isMethod('GET')) {
            return view('exam.frontend.account.register', compact('title', 'ref_id'));
        }

         if ($request->isMethod('POST')) {

            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|unique:users',
                'password' => 'required|min:6',
                'g-recaptcha-response' => ['required', new ReCaptcha],
            ]);


            $name = $request->input('first_name');
            $user_id = rand(11111,99999);
            $email = $request->input('email');
            $token  = Str::random(40);

            User::create([
                'first_name'=> $request->input('first_name'),
                'last_name'=> $request->input('last_name'),
                'email'=> $request->input('email'),
                'phone'=> $request->input('phone'),
                'user_id'=> $user_id,
                'ref_id'=> $ref_id,
                'token'=> $token,
                'acc_status'=> 0,
                'acc_type'=> "User",
                'password'=> Hash::make($request->input('password')),
            ]);


            $details = [
                'user_id' => $user_id,
                'token' => $token,
                'name' => $name,
            ];
            
            try {
                if($ref_id == null){
                    Mail::to($email)->send(new RegisterMail($details));
                }else{
                    Mail::to($email)->send(new RegisterMail($details));
                }
                
                
                return redirect("register")->with('success', 'Great, you have successfully registered, Please verify your email');

            } catch (Throwable $e) {
                
                 return redirect("register")->with('error', 'Error!, Your account details could not be sent, please contact admin');
            }    

        }
    }


    public function verifyaccount($user_id, $token)
    {       
        $user = User::where('user_id', $user_id)->first();
        $token2 = $user->token;
        if($token == $token2){
            $post = DB::table('users')
            ->where('user_id', $user_id)
            ->update([
                'acc_status'=> 1,
            ]);
            return redirect("/login")->with('success','Your Email Is verified, Pease Login!');
        }else{

            return redirect("/login")->with('error','Error!, the token does not match');
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
                $token = $login->token;

                $details = [
                    'user_id' => $user_id,
                    'token' => $token,
                    'name' => $name,
                ];

                try {
                    Mail::to($email)->send(new PasswordMail($details));
                    return redirect()->back()->with('success','Please check your email for link to change password');

                } catch (Throwable $e) {
                
                    return redirect()->back()->with('error','Sorry!, This email does not exit on our system, please register');
                }
      
            
            }
        }

        if ($request->isMethod('GET')) {
            return view('exam.frontend.account.forgot-password', compact('title'));
        }
    }

    public function reset_password(Request $request, $user_id, $token)
    {    
        $title = "Reset Password" . config('global.site_title');
        $user = User::where('user_id', $user_id)->first();
        $token2 = $user->token;

        $post = [
                'user_id' => $user_id,
                'token' => $token,
            ];

        if ($request->isMethod('GET')) {

            if($token == $token2){
                return view('exam.frontend.account.reset-password', compact('title','post'));
            }else{
                return redirect("login")->with('error','Sorry!, There was an error and token does not match, Please contact admin');
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
      
            return redirect("login")->with('success','Your password was successfully updated, Please Login');
        }
       
    }


    public function adminlogin(Request $request)
    {
        $title = "Admin Section - " . config('global.site_name');

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
      
            return redirect("admin")->with('status',['text'=>'Sorry! you enter wrong credentials ','type'=>'danger']);
        }

        if ($request->isMethod('GET')) {
            return view('exam.frontend.admin', compact('title'));
        }
    }

    public function getIp(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}
