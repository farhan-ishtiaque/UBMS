<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UniversityController;


Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route ::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('homepage/registration', [AuthController::class, 'registration'])->name('univeersity.registration');
Route::post('homepage/registration', [AuthController::class, 'registrationPost'])->name('university.registration.post');

