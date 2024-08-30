<?php

// these are like import in javascript
use App\Http\Controllers\PostController;
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