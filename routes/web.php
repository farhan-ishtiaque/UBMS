<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route ::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('registration', [AuthController::class, 'registration'])->name('registration');


Route::get('/universities/accredited', [UniversityController::class, 'showAccredited'])->name('universities.accredited');