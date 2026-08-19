<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\Event;
use App\Models\User;
use App\Models\Journal;
use App\Models\ConferenceRegistration;
use Mail;
use App\Rules\ReCaptcha;
use App\Mail\NotifyMail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ConferenceRegistrationNotification;
use App\Mail\ConferenceRegistrationConfirmation;

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

    public function about_coretep()
    {
        $title = "About CORETEP - " . config('global.site_title');
        return view('frontend.about-coretep', compact('title'));
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

    public function verifyMembership(Request $request)
    {
        $title = "Verify Membership - " . config('global.site_title');
        $search = trim((string) $request->input('q'));
        $results = collect();

        if ($search !== '') {
            $results = User::whereNotNull('reg_no')
                ->where(function ($query) use ($search) {
                    $query->where('reg_no', 'LIKE', '%'.$search.'%')
                        ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%'.$search.'%'])
                        ->orWhere('company_name', 'LIKE', '%'.$search.'%');
                })
                ->orderBy('first_name')
                ->limit(50)
                ->get();
        }

        return view('frontend.verify-membership', compact('title', 'search', 'results'));
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
        $journals = Journal::approved()
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('frontend.journal-publication', compact('title', 'journals'));
    }

    public function journal_details($id, $slug)
    {
        $journal = Journal::approved()->with('author')->findOrFail($id);

        if ($journal->slug !== $slug) {
            return redirect("/journal-publication/{$journal->id}/{$journal->slug}", 301);
        }

        $journal->increment('views');

        $title = $journal->title . " - " . config('global.site_title');
        $recent = Journal::approved()
            ->where('id', '!=', $journal->id)
            ->orderBy('published_at', 'desc')
            ->limit(4)
            ->get();

        return view('frontend.journal-details', compact('title', 'journal', 'recent'));
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

    public function conference(Request $request)
    {
        $title = "1st INTERNATIONAL CONFERENCE ON TECHNOLOGY, ENERGY & SUSTAINABILITY- ICTES 2025 - " . config('global.site_title');
        if ($request->isMethod('GET')) {
            return view('frontend.conference', compact('title'));
        }

         if ($request->isMethod('POST')) {
             $request->validate([
                'title' => 'required|in:Mr.,Ms.,Mrs.,Engr.,Dr.,Prof.',
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:150',
                'organization' => 'required|string|max:200',
                'country' => 'required|string|max:100',
                'category' => 'required|in:Delegate,Visitor,Volunteer,Govt Official,Speaker,Student,Exhibitor',
                'message' => 'nullable|string',
                'payment' => ['required','file', 'mimetypes:image/jpeg,image/png,image/gif,application/pdf','max:2048',],
                'g-recaptcha-response' => ['required', new ReCaptcha],
            ]);


            // Check if a registration with this email already exists
            $existingRegistration = ConferenceRegistration::where('email', $request->email)->first();

            if ($existingRegistration) {
                // Update existing registration
                $existingRegistration->update($request->all());
                $registration = $existingRegistration;

                $action = 'updated';
                $message = 'Your registration has been updated successfully! Your registration ID remains: ' . $registration->registration_id;
            } else {
                // Create new registration
                $registration = ConferenceRegistration::create($request->all());

                $action = 'confirmed';
                $message = 'Thank you for registering for ICTES 2025! Your registration ID is: ' . $registration->registration_id;
            }

            $imageName = rand(00000,99999).'-'.$request->file('payment')->getClientOriginalName();
            $request->file('payment')->move('uploads/payment', $imageName);
            // Prepare registration data for email
            $registrationData = [
                'title' => $registration->title,
                'first_name' => $registration->first_name,
                'last_name' => $registration->last_name,
                'phone' => $registration->phone,
                'email' => $registration->email,
                'organization' => $registration->organization,
                'country' => $registration->country,
                'category' => $registration->category,
                'message' => $registration->message,
                'registration_id' => $registration->registration_id,
                'payment' => $imageName,
                'action' => $action
            ];

            // Send confirmation email to registrant
            Mail::to($registration->email)->send(new ConferenceRegistrationConfirmation($registrationData));

            // Send notification email to admin
            Mail::to(config('global.site_email'))->send(new ConferenceRegistrationNotification($registrationData));

            return redirect()->back()
                ->with('status', [
                    'type' => 'success',
                    'text' => $message
                ]);
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

            $login = Admin::where('username', $username)->first();
            if ($login && Hash::check($password, $login->password)) {
                $admin_id = $login->admin_id;
                $request->session()->put('admin_id', $admin_id);

               return redirect()->action([AdminController::class, 'index']);
            }
      
            return redirect("adminlogin")->with('status', ['text'=>'Opps! You have entered invalid credentials','type'=>'danger']);
        }

        if ($request->isMethod('GET')) {
            return view('frontend.admin', compact('title'));
        }
    }
    



    public function email()
    {
        $title = "Email" . config('global.site_title');
        $details = [
                'amount' => '93244',
                'email'=>'noblesomto@gmail.com',
                'time' => '03:20',
                'ip' => 'hqn9223',
                'mobile' => '090434353',
                'postcode' => '093033',
                'city' => 'London',
                'bedrooms' => '2 bedrooms',
                'checkin' => '2025-02-14',
                'checkout' => '2025-03-01',
                'property' => 'Stunning Modern 2-Floor House with 3 Ensuite Rooms',
                'address' => 'Entire home in Greater London, United Kingdom',
                'token' => '093033',
                'name' => "noble",
                'user_id' => "5244",
                'book_id' => "GO5Ka244",
                'date' => "5-2-44",
                'otp'=>"049403",
                'currency'=>"USD",
                'email_subject'=>"049403",
                'email_body'=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis mattis vitae quam vel viverra. Etiam vitae orci sit amet quam euismod tincidunt. Cras eu porttitor nunc. Integer lacinia augue nibh, ac pretium nunc venenatis vitae. Fusce sapien elit, commodo vitae purus id, ultricies placerat lectus. Sed non sagittis augue. Donec in consequat turpis. Donec vel lectus tempor, fringilla dolor at, varius mi. Praesent a nulla maximus, blandit ex non, rutrum augue. Pellentesque sit amet turpis luctus, porta purus vitae, lobortis tellus. Aliquam erat volutpat. Ut eget quam euismod, feugiat eros in, venenatis quam. Nam vitae nibh in augue venenatis porta non in nunc. Vivamus iaculis ut enim nec egestas. Morbi tristique lectus in orci ultricies, id imperdiet massa consectetur. Donec semper diam in laoreet hendrerit.<br><br>

Morbi faucibus pulvinar lectus. Sed vehicula elit ac cursus porttitor. Aenean augue quam, vehicula iaculis vulputate sit amet, pretium et mauris. Maecenas ut scelerisque sem. Morbi in purus non eros ullamcorper placerat. Etiam semper sit amet ex non dictum. Phasellus facilisis mauris vitae tellus finibus, a semper justo bibendum.

Nunc justo velit, dictum sed est ut, porttitor semper odio. Fusce sit amet diam vitae lectus pretium mattis a a quam. Morbi dictum viverra metus. Donec sed lectus nec risus laoreet gravida ut non leo. Mauris sed tellus lorem. Pellentesque sit amet dolor a tortor viverra imperdiet ut sed metus. Vivamus venenatis sem risus, sed aliquet sem lobortis in. Nam quis erat vel tortor aliquam cursus eget id justo. Sed sollicitudin ex pellentesque libero feugiat mollis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Aenean rutrum volutpat placerat. Vestibulum sed congue lorem, sit amet posuere dui. Proin sagittis mi odio, id congue mi viverra at. Pellentesque sit amet tellus eget quam fringilla tincidunt. Morbi aliquam dolor ut nisl semper ultricies.",
            ];
        return view('email.paymentMail', compact('title','details'));
    }
}
