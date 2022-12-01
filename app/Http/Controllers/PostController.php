<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $approved_userPosts = Post::whereRelation('author','is_admin','=',1)->get();
        $unapproved_userPosts = Post::whereRelation('author','is_admin','=',0)->get();
        return view('posts.list',compact('approved_userPosts','unapproved_userPosts'));
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
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());
        return redirect()->route('posts.index')->with(['status','Post Added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'publish_date' => $request->get('publish_date'),
            'approved' => $request->get('approved'),
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('posts.index')->with(['status','Post Deleted']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with(['status','Post Deleted']);
    }

    public function duplicate(Post $post) {
        $copyPost = $post->replicate();
        $copyPost->save();
        return redirect()->route('posts.index')->with(['status','Post Duplicated']);
    }
}
