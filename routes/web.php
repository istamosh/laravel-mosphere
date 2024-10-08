<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

// using route view instead of above code, works the same
Route::view('/', 'customwelcome');

// middleware for all routes of authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // only original poster can edit posts
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->can('update', 'post')->name('posts.edit');
    
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // add route for logout, logout will not show any page
    Route::post('/logout', [LoginUserController::class, 'logout'])->name('logout');

    // add gate middleware is-admin from AppServiceProvider as group
    Route::middleware('is-admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    });
});
// and these routes are excepted from the auth middleware
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// ->middleware('can-view-post') is not used for now so guest can view posts
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// add routes for registration and login
// prevent authenticated user from registering and login again, by using guest middleware group
Route::middleware('guest')->group(function () {
    // add routes for registration and login
    Route::get('/register', [RegisterUserController::class, 'register'])->name('register');
    Route::post('/register', [RegisterUserController::class, 'store'])->name('register.store');

    Route::get('/login', [LoginUserController::class, 'login'])->name('login');
    Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');
});