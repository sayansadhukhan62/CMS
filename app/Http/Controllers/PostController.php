<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

use App\Category;

use App\Tag;

use App\Http\Requests\Posts\CreatePostsRequest;

use App\Http\Requests\Posts\UpdatePostRequest;

use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only('create','store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $category= Post::with('category')->get();
    return view('post.index')->with('posts',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
       $image= $request->image->store('posts');
       // dd($request->category);
       $post=Post::Create([

        'title' => $request->title,
        'description' => $request->description,
        'content' => $request->content,
        'image'=> $image,
        'category_id' => $request->category,
        'published_at' => $request->published_at,

       ]);
       if ($request->tag) {
         $post->tags()->attach($request->tag);
       }

    session()->flash('success','Post Created Succesfully');

    return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $post=Post::findOrFail($id);
        // dd($post);
        $category=Category::all();
        $tags=Tag::all();
        return view('post.create')->with([
            'post'=>$post,
            'categories'=>$category,
            'tags'=>$tags,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post=Post::findOrFail($id);

        
        if($request->has('image')){
            $image=$request->image->store('posts');
            storage::delete($post->image);
        }
        $post=Post::findOrFail($id);
        $post->title=$request->title;
        $post->description=$request->description;
        $post->content=$request->content;
        if($request->has('image')){
        $post->image=$image;
        }
        $post->category_id=$request->category;
        $post->published_at=$request->published_at;

        if ($request->tag) {
            $post->tags()->sync($request->tag);
        }


        $post->update();

        session()->flash('success','Post updated succesfully');
        return redirect(route ('post.index'));
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
        $post -> delete();
        return redirect(route ('post.index'));
        session()->flash('success','Post Deleted Succesfully');
    }

    public function Trash()

    {
        $posts = Post::onlyTrashed()->get();

        return view('recycle')->with('posts',$posts); 
    }

    public function Restore($id)

    {
        // dd($id);
        $post = Post::onlyTrashed()->find($id)->restore();
        return redirect( route ('trash') );
    }
    public function delete($id)

    {

        $post = Post::onlyTrashed()->find($id);
        storage::delete($post->image);
        $post->forceDelete();
        return redirect( route ('trash') );
    }

    
    public function emptyTrash()
    {
        $posts = Post::onlyTrashed()->get();
        foreach($posts as $post){
        $post->forceDelete();
        storage::delete($post->image);
        }
        return redirect(route('trash'));
    }


    public function hasTag($tagId)
    {
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

}
