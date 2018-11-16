<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;



class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts=Post::all();
        //return Post::where('title','Post two')->get();
        //$posts = Post::orderBy('title','desc')->take(2)->get();
        //$posts = Post::orderBy('title','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view ('posts.index')->with('posts',$posts);

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
       $this->validate($request, [
            'title' => 'required|min:5', 
             'body' => 'required',
            //'cover_image' => 'image|nullable|max:1999'
       ]);
           //file upload
         //if($request->hasFile('cover_image')){
            //Get File Name With Extension
            //$fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get The file name only
            // $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             //Get onlt the extension
            //  $extension = $request->file('cover_image')->getClientOriginalExtension();
              //FileName to store
             // $fileNameToStore= $fileName. '_' . time() . '.' .$extension;    
              //upload the image
             // $path = $request->file('cover_image')->storeAs('public/cover_image', $fileNameToStore);
            //} else{
             //$fileNameToStore = 'noimage.jpg';
        // }
          //Create Posts
          $post = new Post;
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          $post->user_id = auth()->user()->id;
          //$post->cover_image = $fileNameToStore;
          $post->save();

          return redirect('/posts')->with('success', 'Post Created');

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

       //check for right user
       if(auth()->user()->id !==$post->user_id){
        return redirect('/posts')->with('error', 'You are Not Authorized To View This Page');

       }
        return view('posts.edit')->with('post',$post);
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
        $this->validate($request, [
            'title' => 'required|min:10', 
             'body' => 'required'
       ]) ;

          //Create Posts
          $post = Post::find($id);
          $post->title = $request->input('title');
          $post->body = $request->input('body');
          $post->save();

          return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

         //check for right user
       if(auth()->user()->id !==$post->user_id){
        return redirect('/posts')->with('error', 'You are Not Authorized To View This Page');

       }
        
       $post->delete();
       
        return redirect('/posts')->with('success', 'Post Removed');

    }
}
