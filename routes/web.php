<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UniversityController;


// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

Route ::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthController::class, 'registration'])->name('univeersity.registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])->name('university.registration.post');


Route::get('/universities/accredited', [UniversityController::class, 'showAccredited'])->name('universities.accredited');

// About Page Route (using controller)
Route::get('/about', [AboutController::class, 'index'])->name('about');


Route::get('/mod/dashboard', [ModeratorDashboardController::class, 'runDashboard'])->name('moderator.dashboard');




// web.php
Route::get('/dashboard-data', [ModeratorDashboardController::class, 'getDashboardData']);
