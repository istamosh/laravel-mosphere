<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all posts from database
        $posts = Post::all();

        // create view for posts, accessed from views/posts/index.blade.php, hence it's using directoryname.filename
        // passing data array to the view
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // protects direct access to /posts/create from unauthorized users
        if (!Auth::check()) {
            return view('auth.login');
        }

        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate request first
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10']
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

    // handling route GET /posts/{id}
    public function show(Post $post)
    {
        // using Post $post will be working under the hood

        // if found display post, if not found display 404
        // $post = Post::findOrFail($id);

        // return view with found post
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // validate the revision first
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10']
        ]);

        // update the post in database
        $post->update($validated);

        // redirect back to /posts
        return to_route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // get the post title before deleting
        $title = $post->title;

        // delete the post
        $post->delete();

        // redirect back to /posts
        return redirect()->route('posts.index')->with('info', 'Post "' . $title . '" deleted successfully.');
    }
}
