<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// this root route targeting resources/views dir
Route::get('/', function () {
    return view('customwelcome');
});

// capture POST form request from root page
Route::post('/', function (Request $request) {
    // todo: validate the incoming request
    // then create a new post
    dd($request->all());
});

// capture PUT method request from root page, with id as parameter
Route::put('/{id}', function (Request $request, $id) {
    // dd($request->all());
    // return "PUT request successful";
    return $id;
});

// testing /test GET route with just return string
Route::get('/test', function () {
    $test = "if you see this page then the /test route is successful.";
    return "<h1>". $test ."</h1>";
});

// using delete route by id parameter
Route::delete('/{id}', function ($id) {
    return $id;
});