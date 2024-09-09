<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminPostController extends Controller
{
    // edit method
    public function edit(Post $post)
    {
        // testing the gate (not working yet)
        //Gate::authorize('update', $post);

        return view('admin.posts.edit', [
            'post' => $post
        ]);
    }

    // update method
    public function update(Request $request, Post $post)
    {
        // validate the request
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:255'],
            'content' => ['required', 'min:10']
        ]);

        // update the post
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $post->user_id,
        ]);

        // return to the show page
        return to_route('admin', ['post' => $post])->with('info', 'Post "' . $post->title . '" has been updated.');
    }

    // destroy method
    public function destroy(Post $post)
    {
        // get the title for info message
        $title = $post->title;

        $post->delete();

        return to_route('admin')->with('info', 'Post "' . $title . '" has been deleted.');
    }
}
