<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // make admin-only page with all posts served from the database
    public function index()
    {
        $posts = Post::all();

        // view/admin/index.blade.php
        return view('admin.index', ['posts' => $posts]);
    }
}
