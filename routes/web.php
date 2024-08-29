<?php

use Illuminate\Support\Facades\Route;

// this root route targeting resources/views dir
Route::get('/', function () {
    return view('customwelcome');
});
