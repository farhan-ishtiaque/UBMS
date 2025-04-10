<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use App\Http\Controllers\UmsbDashboardController;
use App\Http\Controllers\UniAdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniRegistrationController;

// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

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
Route::get('/ubms/dashboard', [UmsbDashboardController::class, 'runDashboard'])->name('ubms.dashboard');




// dashboard data for cards
Route::get('/dashboard-data', [ModeratorDashboardController::class, 'getDashboardData']);
Route::get('/dashboard-data2', [UniAdminDashboardController::class, 'getDashboardData']);
Route::get('/dashboard-data3', [UmsbDashboardController::class, 'getDashboardData']);



// Moderator dashboard
/*Route::middleware(['auth', 'moderators'])->group(function () {
    Route::get('/mod/dashboard', [ModeratorDashboardController::class, 'runDashboard'])->name('moderator.dashboard');
    Route::get('/dashboard-data', [ModeratorDashboardController::class, 'getDashboardData']);
});

// UMSB dashboard
Route::middleware(['auth', 'umsb'])->group(function () {
    Route::get('/ubms/dashboard', [UmsbDashboardController::class, 'runDashboard'])->name('ubms.dashboard');
    Route::get('/dashboard-data3', [UmsbDashboardController::class, 'getDashboardData']);
});

// University admin dashboard (already exists)
Route::middleware(['auth', 'university.admin'])->group(function () {
    Route::get('/admin/dashboard', [UniAdminDashboardController::class, 'show'])->name('uniAdmin.dashboard');
    Route::get('/dashboard-data2', [UniAdminDashboardController::class, 'getDashboardData']);
});*/

Route::get('/moderator/dashboard', [ModeratorDashboardController::class, 'runDashboard'])->name('moderator.dashboard');
Route::get('/ubms/dashboard', [UmsbDashboardController::class, 'runDashboard'])->name('ubms.dashboard');
Route::get('/uni-admin/dashboard', [UniAdminDashboardController::class, 'show'])->name('uniAdmin.dashboard');




Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect(route('homepage'));
})->name('logout');

