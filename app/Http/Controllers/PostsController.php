<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
// use Illuminate\Support\Facades\File;
use App\Models\Post;
use Image;
// use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        // $posts = Post::all();
        // $posts = DB::select('select * from posts');
        // $posts = Post::where('title','laravel')->get();
        // $posts = Post::OrderBy('created_at','desc')->take(1)->get();
        $posts = Post::OrderBy('created_at','desc')->get();
        // $posts = Post::OrderBy('created_at','desc')->paginate();
        return view('posts.list')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'body'=>'required',
            'cover_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        // if ($request->hasFile('cover_image')) {
        //      $fileNameToStore = time().'-'.$request->file('cover_image')->getClientOriginalName();
        //     // $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        //     $request->cover_image->move(public_path('images'),$fileNameToStore);

        // }else {
        //     $fileNameToStore = 'noimage.jpg';
        // }
        
        $post = new Post();
        $post->title =  request('title');
        $post->body = request('body');
        $post->user_id = auth()->user()->id;
        
        //cover image
        $image_file = request('cover_image');
        $image = Image::make($image_file);
        Response::make($image->encode('jpeg'));

        $post->cover_image = $image;

        //save
        $post->save();
        return redirect('posts')->with(['alert-class'=>'alert alert-success','alert-msg'=>'Post Created Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    public function fetch_image($cover_image)
    {
    //<img src="data:image/jpeg;base64,{{ base64_encode($post->cover_image) }}" />
     $image_file = Image::make($cover_image);
     $response = Response::make($image_file->encode('jpeg'));
     $response->header('Content-Type', 'image/jpeg');
     return $response;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  = Post::findOrFail($id);
        
        if(!$post->postedBy( auth()->user() )){
            return redirect('/')->with(['alert-class'=>'alert alert-danger','alert-msg'=>'Unauthorized Access']);
        }
        return view('posts.edit')->with(['post'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if(!$post->postedBy( auth()->user() )){
            return redirect('/')->with(['alert-class'=>'alert alert-danger','alert-msg'=>'Unauthorized Access']);
        }

        $post->title = request('title');
        $post->body = request('body');

        // $imageName = time().'-'.$request->cover_image->getClientOriginalName();
        if($request->hasFile('cover_image')){
            $fileNameToStore = time().'-'.$request->file('cover_image')->getClientOriginalName();
            // $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            $request->cover_image->move(public_path('images'),$fileNameToStore);
            if ($post->cover_image !== 'noimage.jpg') {
                File::delete(public_path('images/'.$post->cover_image));
            }
            
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        return redirect('posts')->with(['alert-class'=>'alert alert-success','alert-msg'=>'Post updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if(!$post->postedBy( auth()->user() )){
            return redirect('/')->with(['alert-class'=>'alert alert-danger','alert-msg'=>'Unauthorized Access']);
        }
        // dd(public_path('images\\'.$post->cover_image));
        if ($post->cover_image !== 'noimage.jpg') {
            File::delete(public_path('images/'.$post->cover_image));
        }
        $post->delete();
        return redirect('/')->with(['alert-class'=>'alert alert-success','alert-msg'=>'Post deleted successfully']);

    }
}
