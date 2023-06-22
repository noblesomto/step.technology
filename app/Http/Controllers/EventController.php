<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Image;

class EventController extends Controller
{
    public function new_post(Request $request)
    {   
        $title = "New Event Post" . config('global.site_title') ;

        if ($request->isMethod('POST')) {

            $event_id = rand(00000,99999);

         
        $request->validate([
            'event_title' => 'required',
            'event_body' => 'required',
            'event_date' => 'required',
            'event_picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
    
           ]);

        
        $image = $request->file('event_picture');
        $imageName = time().'.'.$image->extension();
     
        $filePath = public_path('/uploads/thumbnails');
        $img = Image::make($image->path());
        $img->resize(600, 600, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$imageName);
   
        $filePath = public_path('/uploads/event');
        $image->move($filePath, $imageName);
      
        
        $event = Event::create([
            'event_title'=> $request->input('event_title'),
            'event_date'=> $request->input('event_date'),
            'event_body'=> $request->input('event_body'),
            'event_id'=> $event_id,
            'event_status'=> "1",
            'event_picture'=> $imageName,
        ]);


        return redirect('/event/new-post')->with('status', ['text'=>'Event Successfully published','type'=>'success']);
        }
        
        if ($request->isMethod('GET')) {
            return view('backend.event.new-post', compact('title'));
        }
    }

    public function all_post()
    {   
        $post = Event::orderBy('created_at', 'desc')->paginate(20);
        $title = "All Event Post";
        return view('backend.event.posts', compact('title', 'post'));
    }

 
    public function post_status($event_id, $status)
    {   
        $post = DB::table('events')
            ->where('event_id', $event_id)
            ->update([
                'event_status'=> $status,
            ]);
            return redirect("event/all-events")->with('status',['text'=>'Event Status Changed','type'=>'success']);
      
    }


    public function edit_post(Request $request, $event_id)
    {   
        $title = "Edit Property" . config('global.site_title') ;

        if ($request->isMethod('PUT')) {

         
            $request->validate([
                'event_title' => 'required',
                'event_body' => 'required',
                       
               ]);
            
            if(!empty($request->file('event_picture'))) {

                $image = $request->file('event_picture');
                $imageName = time().'.'.$image->extension();
             
                $filePath = public_path('/uploads/thumbnails');
                $img = Image::make($image->path());
                $img->resize(600, 600, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$imageName);
           
                $filePath = public_path('/uploads/event');
                $image->move($filePath, $imageName);

                $post = DB::table('events')
                    ->where('event_id', $event_id)
                    ->update([
                        'event_title'=> $request->input('event_title'),
                        'event_body'=> $request->input('event_body'),
                        'event_picture'=> $imageName,
                    ]);


            } else {
                $post = DB::table('events')
                    ->where('event_id', $event_id)
                    ->update([
                        'event_title'=> $request->input('event_title'),
                        'event_body'=> $request->input('event_body'),             
                    ]);

            }
            

        return redirect('/event/edit-post/'.$event_id)->with('status', ['text'=>'Event Successfully Edited','type'=>'success']);
        }
        
        if ($request->isMethod('GET')) {

            $post = Event::where('event_id', $event_id)->first();
            return view('backend.event.edit-post', compact('title','post'));
        }
    }



    public function delete_post($event_id) 
    {
        $post = Event::where('event_id', $event_id)->first();
        $post->delete();
        return redirect('/event/all-events');

    }
}
