<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts from database
        $name = 'Istamosh';
        $age = 25;
        $posts = ['Post 1', 'Post 2', 'Post 3', 'Post Mortem'];

        // create view for posts, accessed from views/posts/index.blade.php, hence it's using directoryname.filename
        // passing data array to the view
        return view('posts.index', ['username' => $name, 'age' => $age, 'posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request first
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required']
        ]);

        // process POST request to /posts
        // catching the request params of title and content from csrf just like Tinker query
        Post::create($validated);

        // redirect back to /posts
        return to_route('posts.index');
    }

    /**
     * Display the specified resource.
     * Already injected with Post model as parameter
     */
    public function show()
    {
        // pass in post object to view
        return view('posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('posts.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
