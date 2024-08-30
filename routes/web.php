<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// this root route targeting resources/views dir
Route::get('/', function () {
    return view('customwelcome');
});

// capture POST form request from root page
Route::post('/', function (Request $request) {
    dd($request->all());
});

// testing /test GET route with just return string
Route::get('/test', function () {
    $test = "if you see this page then the /test route is successful.";
    return "<h1>". $test ."</h1>";
});
