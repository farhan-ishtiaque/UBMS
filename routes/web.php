<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniRegistrationController;

// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// Authentication Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthController::class, 'registration'])->name('univeersity.registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])->name('university.registration.post');

Route::get('/university-registration', [UniRegistrationController::class, 'showRegistrationForm'])->name('university.registration');
Route::post('/university-registration', [UniRegistrationController::class, 'register'])->name('university.registration.post');

// About Page Route
Route::get('/about', [AboutController::class, 'index'])->name('about');

// University Controller Routes
Route::get('/universities/accredited', [UniversityController::class, 'showAccredited'])->name('universities.accredited');

Route::get('/mod/dashboard', [ModeratorDashboardController::class, 'runDashboard'])->name('moderator.dashboard');

Route::get('/dashboard-data', [ModeratorDashboardController::class, 'getDashboardData']);

