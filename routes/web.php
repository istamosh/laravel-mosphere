<?php

// these are like import in javascript

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;

// this root route targeting resources/views dir
// Route::get('/', function () {
//     return view('customwelcome');
// });

// using route view instead of above code, works the same
Route::view('/', 'customwelcome');

// get all Posts resources capabilities as one route (more cleaner)
Route::resource('/posts', PostController::class);

// // add GET route to /posts with PostController class with index method
// // this is for tabulating all posts
// // Add route name to the route
// Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// // add creation of new post
// Route::get('/posts/create', [PostController::class, 'create']);

// // add POST route to /posts with PostController class with store method
// // instead of using anonymous function
// // this is for storing new post
// Route::post('/posts', [PostController::class, 'store']);

// // show a single post
// Route::get('/posts/{id}', [PostController::class, 'show']);

// // edit a single post
// Route::get('/posts/{id}/edit', [PostController::class, 'edit']);

// // add PUT route to modify /posts/{id} page with PostController class with update method
// Route::put('/posts/{id}', [PostController::class, 'update']);

// // delete a single post
// Route::delete('/posts/{id}', [PostController::class, 'destroy']);

// add routes for registration and login
Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

Route::get('/login', [LoginUserController::class, 'login'])->name('login');
Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');