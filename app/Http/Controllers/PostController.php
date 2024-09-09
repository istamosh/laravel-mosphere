<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewPostMailJob;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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
            'content' => ['required', 'min:10'],
            // make the thumbnail not required (can empty), but it should be image
            'thumbnail' => ['nullable', 'image'],
        ]);

        // store the thumbnail file, check the filesystems.php
        // if the request has a thumbnail included
        if ($request->hasFile('thumbnail')) {
            // place the new thumbnail in storage
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }

        // authenticated user will create a new post (why is it showing red error?)
        Auth::user()->posts()->create($validated);

        // dispatch a job to send email
        dispatch(new SendNewPostMailJob([
            'email' => Auth::user()->email,
            'title' => $validated['title'], 
            'content' => $validated['content'],
            'name' => Auth::user()->name]));

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
        // check if the post's user id is not matched with authenticated user id
        // if ($post->user_id !== Auth::user()->id) {
        //     abort(403);
        // }

        // Only authorized users can edit posts (logged user = post user_id)
        // Commented because being handled by the route middleware (update: added gate for maximizing security)
        Gate::authorize('update', $post);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // add Gate
        Gate::authorize('update', $post);

        // validate the revision first
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10'],
            'thumbnail' => ['sometimes', 'image']
        ]);

        // if update request has a thumbnail included
        if ($request->hasFile('thumbnail')) {
            // if the post entry has a thumbnail and the file exists in storage, delete the old one
            if ($post->thumbnail && File::exists(storage_path('app/public/' . $post->thumbnail))) {
                File::delete(storage_path('app/public/' . $post->thumbnail));
            }

            // place the new thumbnail in storage
            $validated['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
        }

        // update the post in database, but retain the user_id so they can still edit the post even after the admin touched it
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            // make the thumbnail stays if nothing is uploaded, even if it's null
            'thumbnail' => $validated['thumbnail'] ?? $post->thumbnail,
            'user_id' => $post->user_id,
        ]);

        // redirect back to show post
        return to_route('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Only authorized users can delete posts (logged user = post user_id)
        Gate::authorize('delete', $post);

        // get the post title before deleting
        $title = $post->title;

        // also delete the image from the public storage
        // check if db has a thumbnail entry and if the file exists in storage, delete it
        if ($post->thumbnail && File::exists(storage_path('app/public/' . $post->thumbnail))) {
            File::delete(storage_path('app/public/' . $post->thumbnail));
        }
        // delete the post
        $post->delete();

        // redirect back to /posts
        return redirect()->route('posts.index')->with('info', 'Post "' . $title . '" deleted successfully.');
    }
}
