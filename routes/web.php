<?php

use Illuminate\Support\Facades\Route;

// this root route targeting resources/views dir
Route::get('/', function () {
    return view('customwelcome');
});

// testing /test route with just return string
Route::get('/test', function () {
    return "if you see this page then the /test route is successful.";
});
