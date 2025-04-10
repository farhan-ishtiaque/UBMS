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
use App\Http\Controllers\UserController;

// Show all users
Route::get('/users', [UserController::class, 'showUsers'])->name('users.list');

// Search users
Route::get('/users/search', [UserController::class, 'showSearchedUsers'])->name('users.search');

// Show edit form
Route::get('/user/{id}/edit', [UserController::class, 'editUser'])->name('user.edit');

// Handle update
Route::put('/user/{id}/update', [UserController::class, 'updateUser'])->name('user.update');
// Delete user - confirmation page
Route::get('/user/{id}/delete', [UserController::class, 'confirmDelete'])->name('user.confirmDelete');

// Delete user - action
Route::delete('/user/{id}/delete', [UserController::class, 'deleteUser'])->name('user.delete');

// User delete page (list + search)
Route::get('/users/delete-page', [UserController::class, 'showDeleteUsers'])->name('users.delete.page');
Route::get('/users/delete-search', [UserController::class, 'showDeleteUsers'])->name('users.search.delete');