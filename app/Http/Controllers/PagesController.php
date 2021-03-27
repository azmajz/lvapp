<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;

class PagesController extends Controller
{
    public function index(){
        // $name = 'This is index page';
        // $posts = Post::OrderBy('created_at','desc')->get();
        $user_id = auth()->user()->id;
        $posts = User::find($user_id)->posts()->OrderBy('created_at','desc')->get();
        return view('index')->with('posts',$posts);
    }

    
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        // public/images/file.png

        // $request->image->storeAs('images', $imageName);
        // storage/app/images/file.png

        /* Store $imageName name in DATABASE from HERE */
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 

    }

    public function login(Request $request)
    {
            // $this->validate($request,[
            //    'body'=>'required',
            // ]);
        $post = new Post();
        $username=request('username');
        $password=request('password');
        if($username=='admin'&&$password=='admin'){
        $posts = Post::OrderBy('created_at','desc')->get();
        return view('pages.dashboard')->with(['name'=>$username,'posts'=>$posts]);
    }else{
         return redirect('/')->with('msg','Invalid Credentials');

    }
        // $post->title = $username;
        // $post->body = $password;
        // $post->save();
        // error_log($username);
        // error_log($password);
    }

    public function about(){
        $title = 'This is about page';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title'=>'This is Services example page',
            'services'=>['Web Designing','Web Development','SEO','Digital Marketing']
        );
        return view('pages.services')->with($data);
    }

}
