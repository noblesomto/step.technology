<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Blog;
use Image;

class BlogController extends Controller
{
    public function new_post(Request $request)
    {   
        $title = "New Blog Post" . config('global.site_title') ;

        if ($request->isMethod('POST')) {

            $blog_id = rand(00000,99999);

         
        $request->validate([
            'blog_title' => 'required',
            'blog_body' => 'required',
            'blog_picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
    
           ]);

        
        $image = $request->file('blog_picture');
        $imageName = time().'.'.$image->extension();
     
        $filePath = public_path('/uploads/thumbnails');
        $img = Image::make($image->path());
        $img->resize(600, 600, function ($const) {
            $const->aspectRatio();
        })->save($filePath.'/'.$imageName);
   
        $filePath = public_path('/uploads/blog');
        $image->move($filePath, $imageName);
      
        
        $blog = Blog::create([
            'blog_title'=> $request->input('blog_title'),
            'blog_body'=> $request->input('blog_body'),
            'blog_views'=> "0",
            'blog_id'=> $blog_id,
            'blog_status'=> "1",
            'blog_picture'=> $imageName,
        ]);


        return redirect('/blogpost/new-post')->with('status', ['text'=>'Blog Post Successfully published','type'=>'success']);
        }
        
        if ($request->isMethod('GET')) {
            return view('backend.blog.new-post', compact('title'));
        }
    }

    public function all_post()
    {   
        $post = Blog::orderBy('created_at', 'desc')->paginate(20);
        $title = "All Blog Post";
        return view('backend.blog.posts', compact('title', 'post'));
    }

 
    public function post_status($blog_id, $status)
    {   
        $post = DB::table('blogs')
            ->where('blog_id', $blog_id)
            ->update([
                'blog_status'=> $status,
            ]);
            return redirect("blogpost/all-post")->with('status',['text'=>'Blog Status Changed','type'=>'success']);
      
    }


    public function edit_post(Request $request, $blog_id)
    {   
        $title = "Edit Post" . config('global.site_title') ;

        if ($request->isMethod('PUT')) {

            $request->validate([
                'blog_title' => 'required',
                'blog_body' => 'required',
                       
               ]);
            
            if(!empty($request->file('blog_picture'))) {

                $image = $request->file('blog_picture');
                $imageName = time().'.'.$image->extension();
             
                $filePath = public_path('/uploads/thumbnails');
                $img = Image::make($image->path());
                $img->resize(600, 600, function ($const) {
                    $const->aspectRatio();
                })->save($filePath.'/'.$imageName);
           
                $filePath = public_path('/uploads/blog');
                $image->move($filePath, $imageName);

                $post = DB::table('posts')
                    ->where('blog_id', $blog_id)
                    ->update([
                        'blog_title'=> $request->input('blog_title'),
                        'blog_body'=> $request->input('blog_body'),
                        'blog_picture'=> $imageName,
                    ]);


            } else {
                $post = DB::table('blogs')
                    ->where('blog_id', $blog_id)
                    ->update([
                        'blog_title'=> $request->input('blog_title'),
                        'blog_body'=> $request->input('blog_body'),             
                    ]);

            }
            

        return redirect('/blogpost/edit-post/'.$blog_id)->with('status', ['text'=>'Blog Post Successfully Edited','type'=>'success']);
        }
        
        if ($request->isMethod('GET')) {

            $post = Blog::where('blog_id', $blog_id)->first();
            return view('backend.blog.edit-post', compact('title','post'));
        }
    }



    public function delete_post($blog_id) 
    {
        $post = Blog::where('blog_id', $blog_id)->first();
        $post->delete();
        return redirect('/blogpost/all-post');

    }


}
