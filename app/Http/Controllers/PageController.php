<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Event;
use Mail;
use App\Rules\ReCaptcha;
use App\Mail\NotifyMail;

class PageController extends Controller
{
    public function index()
    {   
        $title = "Home - " . config('global.site_title');
        $blogpost = Blog::orderBy('created_at', 'desc')->paginate(3);
        return view('frontend.index', compact('title','blogpost'));
    }

    public function about()
    {   
        $title = "About Us - " . config('global.site_title');
        return view('frontend.about', compact('title'));
    }

    public function support()
    {   
        $title = "STEP Support - " . config('global.site_title');
        return view('frontend.step-support', compact('title'));
    }

    public function membership()
    {   
        $title = "Memberships - " . config('global.site_title');
        return view('frontend.membership', compact('title'));
    }

    public function trainings()
    {   
        $title = "Trainings - " . config('global.site_title');
        return view('frontend.trainings', compact('title'));
    }

    public function certifications()
    {   
        $title = "Certifications - " . config('global.site_title');
        return view('frontend.certifications', compact('title'));
    }

    public function journal_publication()
    {   
        $title = "Journals & Publications - " . config('global.site_title');
        return view('frontend.journal-publication', compact('title'));
    }

    public function contact(Request $request)
    {   
        $title = "Contact Us - " . config('global.site_title');
        if ($request->isMethod('GET')) {
            return view('frontend.contact', compact('title'));
        }

         if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'g-recaptcha-response' => ['required', new ReCaptcha],
            ]);
          
            
            $details = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' =>  $request->input('subject'),
                'message' => $request->input('message'),
            ];

            $admin_email = config('global.site_email');
            try {
                Mail::to($admin_email)->send(new NotifyMail($details));
                return redirect("contact")->with('status', ['text'=>'Great! Your message was successfully sent, We will get back to you ASAP ','type'=>'success']);
            } catch (Throwable $e) {
                
                return redirect("contact")->with('status', ['text'=>'Error!, Email could not be sent now ','type'=>'danger']);
            }
                  

        }
    }

    public function blog()
    {   
        $title = "Our Blog - " . config('global.site_title');
        $blog = Blog::select("*")
                    ->where("blog_status", 1)
                    ->orderBy("created_at", "asc")
                    ->paginate(24);
        return view('frontend.blog.blog', compact('title','blog'));
    }

    public function blog_detials(Request $request, $blog_id, $slug)
    {   
        \DB::table('blogs')
               ->where('blog_id', $blog_id)
               ->increment('blog_views', 1);

        $blog = Blog::where('blog_id', $blog_id)->first();
        $title = $blog->blog_title ." - ". config('global.site_title');
        dd($title);
        //$num_comments = Comment::where('news_id', $news_id)->count();
        //$comments = Comment::where('news_id', $news_id)->get(); 

        if ($request->isMethod('GET')) {
            $recent = Blog::select("*")
                    ->where("blog_status", 1)
                    ->orderBy("id", "asc")
                    ->limit(8)
                    ->get();
          
            return view('frontend.blog.blog-details', compact('title','blog','recent'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
              ]);

            $com_id = rand(00000,99999);
            
            $post = Comment::create([
                'news_id'=> $news_id,
                'com_id'=> $com_id,
                'name'=> $request->input('name'),
                'email'=> $request->input('email'),
                'message'=> $request->input('message'),
            ]);

           
            return redirect("/blog/".$news_id."/".$slug)->with('status', ['text'=>'Thank you for your Comment','type'=>'success']);

        }
    }


    public function event()
    {   
        $title = "Events - " . config('global.site_title');
        $event = Event::select("*")
                    ->where("event_status", 1)
                    ->orderBy("created_at", "asc")
                    ->paginate(24);
        return view('frontend.events.events', compact('title','event'));
    }

    public function event_detials(Request $request, $event_id, $slug)
    {   

        $event = Event::where('event_id', $event_id)->first();
        $title = $event->event_title ." - ". config('global.site_title');
        //$num_comments = Comment::where('news_id', $news_id)->count();
        //$comments = Comment::where('news_id', $news_id)->get(); 

        if ($request->isMethod('GET')) {
            $recent = Blog::select("*")
                    ->where("blog_status", 1)
                    ->orderBy("id", "desc")
                    ->limit(8)
                    ->get();
          
            return view('frontend.events.event-details', compact('title','event','recent'));
        }

        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
              ]);

            $com_id = rand(00000,99999);
            
            $post = Comment::create([
                'news_id'=> $news_id,
                'com_id'=> $com_id,
                'name'=> $request->input('name'),
                'email'=> $request->input('email'),
                'message'=> $request->input('message'),
            ]);

           
            return redirect("/event/".$news_id."/".$slug)->with('status', ['text'=>'Thank you for your Comment','type'=>'success']);

        }
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
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
    

    public function ckeditor(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('upload')->move(public_path('uploads/ckimages/'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('uploads/ckimages/'.$fileName); 
            $msg = 'Image successfully uploaded'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }
}
