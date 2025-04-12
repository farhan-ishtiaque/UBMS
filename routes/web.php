<?php
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniRegistrationController;
use App\Http\Controllers\RecruitmentController;


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
use App\Http\Controllers\DepartmentsController;

Route::get('departments', [DepartmentsController::class, 'index'])->name('departments.index'); // View all departments
Route::get('departments/create', [DepartmentsController::class, 'create'])->name('departments.create');
Route::post('departments', [DepartmentsController::class, 'store'])->name('departments.store');
Route::get('/departments/manage', [DepartmentsController::class, 'manage'])->name('departments.manage');
Route::get('departments/{id}/edit', [DepartmentsController::class, 'edit'])->name('departments.edit');
Route::put('departments/{id}', [DepartmentsController::class, 'update'])->name('departments.update');
Route::get('/departments/delete', [DepartmentsController::class, 'deleteDepartment'])->name('departments.deletePage');
Route::delete('/departments/{id}', [DepartmentsController::class, 'destroy'])->name('departments.destroy');
Route::get('courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CoursesController::class, 'create'])->name('courses.create');
Route::post('/courses', [CoursesController::class, 'store'])->name('courses.store');
Route::get('/courses/{id}/edit', [CoursesController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{id}', [CoursesController::class, 'update'])->name('courses.update');
Route::get('/courses/select', [CoursesController::class, 'selectPage'])->name('courses.select');
Route::get('courses/list', [CoursesController::class, 'list'])->name('courses.list');

// Confirm Delete Route
Route::get('courses/{id}/delete', [CoursesController::class, 'confirmDelete'])->name('courses.delete.confirm');

// Actual Delete Route
Route::delete('courses/{id}', [CoursesController::class, 'delete'])->name('courses.delete');

use App\Http\Controllers\JobPostingsController;

// Show the form
Route::get('/job-postings/create', [JobPostingsController::class, 'create'])->name('job_postings.create');

Route::post('/job-postings', [JobPostingsController::class, 'store'])->name('job-postings.store');
Route::get('/job-postings/list', [JobPostingsController::class, 'index'])->name('job-postings.index');
use App\Http\Controllers\FacultyRecruitmentController;
Route::get('/faculty-recruitment/create/{job_id}', [FacultyRecruitmentController::class, 'create'])->name('faculty-recruitment.create');
Route::post('/faculty-recruitment/store', [FacultyRecruitmentController::class, 'store'])->name('faculty-recruitment.store');
Route::get('/update-status', [RecruitmentController::class, 'showUpdateForm'])->name('update-status');
Route::post('/update-status/save', [RecruitmentController::class, 'saveStatusUpdates'])->name('update-status.save');

use App\Http\Controllers\FacultyDevelopmentController;

Route::get('/faculty-development/create', [FacultyDevelopmentController::class, 'create'])->name('faculty_development.create');
Route::post('/faculty-development', [FacultyDevelopmentController::class, 'store'])->name('faculty_development.store');
Route::get('/faculty-development', [FacultyDevelopmentController::class, 'index'])->name('faculty_development.index');
Route::prefix('faculty/{faculty}')->group(function () {
    Route::get('/assign-courses', [FacultyCourseAssignmentController::class, 'create'])
         ->name('faculty.assign-courses.create');
         
    Route::post('/assign-courses', [FacultyCourseAssignmentController::class, 'store'])
         ->name('faculty.assign-courses.store');
         
    Route::delete('/assign-courses/{course}', [FacultyCourseAssignmentController::class, 'destroy'])
         ->name('faculty.assign-courses.destroy');
});