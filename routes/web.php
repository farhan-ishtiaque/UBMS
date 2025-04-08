<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// About Page Route (using controller)
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Authentication Routes
Route::get('/login', function () {
    return view('auth.login'); // Recommended to put auth views in auth folder
})->name('login');

Route::get('/registration', function () {
    return view('auth.registration');
})->name('registration');
use App\Http\Controllers\UniversityController;

Route::post('/universities/store', [UniversityController::class, 'store'])->name('universities.store');



Route::get('/universities/accredited', [UniversityController::class, 'showAccredited'])->name('universities');
