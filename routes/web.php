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
use App\Http\Controllers\FacultyController;

Route::get('/faculties/create', [FacultyController::class, 'create'])->name('faculties.create');
Route::post('/faculties/store', [FacultyController::class, 'store'])->name('faculties.store');
Route::get('/faculties', [FacultyController::class, 'showFaculties'])->name('faculties.list');
Route::get('/facUniversities', [FacultyController::class, 'facultyUniversities'])->name('universities.list');
Route::get('/faculties/{id}/edit', [FacultyController::class, 'editFaculty'])->name('faculties.edit');
Route::post('/faculties/{id}/update', [FacultyController::class, 'updateFaculty'])->name('faculties.update');
Route::get('/faculties/delete', [FacultyController::class, 'deleteFacultyPage'])->name('faculties.delete.page');
Route::delete('/faculties/{id}/delete', [FacultyController::class, 'destroyFaculty'])->name('faculties.delete');
Route::get('/mod/universities/update', [UniversityController::class, 'showUpdateForm'])->name('universities.update');
Route::post('/mod/universities/{id}/update', [UniversityController::class, 'updateAccreditation'])->name('universities.update.accreditation');

use App\Http\Controllers\StudentsController;

Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentsController::class, 'create'])->name('students.create');
Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentsController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentsController::class, 'update'])->name('students.update');
