<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/about', function () {
    return view('about');
});