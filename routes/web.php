<?php

use App\Http\Controllers\CoursesController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuUpdateScholarshipController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UmsbDashboardController;
use App\Http\Controllers\UniRegistrationController;
use App\Http\Controllers\UniAdminDashboardController;
use App\Http\Controllers\ModeratorDashboardController;
use App\Http\Controllers\UbmsMenu\UbmsUniMenuController;
use App\Http\Controllers\ModeratorMenu\ModUniMenuController;
use App\Http\Controllers\UbmsMenu\UbmsFacultyMenuController;
use App\Http\Controllers\ModeratorMenu\ModUserMenuController;
use App\Http\Controllers\UbmsMenu\UbmsStudentsMenuController;
use App\Http\Controllers\AdminMenu\AdminCoursesMenuController;
use App\Http\Controllers\AdminMenu\AdminFacultyMenuController;
use App\Http\Controllers\AdminMenu\AdminStudentsMenuController;
use App\Http\Controllers\UbmsMenu\UbmsJobpostingMenuController;
use App\Http\Controllers\UbmsMenu\UbmsUniFundingMenuController;
use App\Http\Controllers\ModeratorMenu\ModCoursesMenuController;
use App\Http\Controllers\ModeratorMenu\ModFacultyMenuController;
use App\Http\Controllers\AdminMenu\AdminJobpostingMenuController;
use App\Http\Controllers\AdminMenu\AdminUniFundingMenuController;
use App\Http\Controllers\ModeratorMenu\ModStudentsMenuController;
use App\Http\Controllers\AdminMenu\AdminDepartmentsMenuController;
use App\Http\Controllers\ModeratorMenu\ModJobpostingMenuController;
use App\Http\Controllers\ModeratorMenu\ModUniFundingMenuController;
use App\Http\Controllers\ModeratorMenu\ModDepartmentsMenuController;
use App\Http\Controllers\UbmsMenu\UbmsFacultyDevelopmentMenuController;
use App\Http\Controllers\AdminMenu\AdminFacultyDevelopmentMenuController;
use App\Http\Controllers\AdminMenu\AdminFacultyRecruitmentMenuController;
use App\Http\Controllers\ModeratorMenu\ModFacultyDevelopmentMenuController;
use App\Http\Controllers\ModeratorMenu\ModFacultyRecruitmentMenuController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuAddController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuViewController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuDeleteController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuUpdateController;
use App\Http\Controllers\ModeratorMenu\StudentMenu\StudentMenuTranscriptController;

// Homepage Route
Route::get('/', function () {
    return view('homepage');
})->name('homepage');


// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthController::class, 'registration'])->name('registration');
Route::post('/registration', [AuthController::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// AJAX route for getting university admins
Route::get('/get-university-admins', [AuthController::class, 'getUniversityAdmins'])->name('get.university.admins');

// About Page Route
Route::get('/about', [AboutController::class, 'index'])->name('about');



// dashboard data for cards
Route::get('/dashboard-data', [ModeratorDashboardController::class, 'getDashboardData']);
Route::get('/dashboard-data2', [UniAdminDashboardController::class, 'getDashboardData']);
Route::get('/dashboard-data3', [UmsbDashboardController::class, 'getDashboardData']);


// Dashboard Route
Route::get('/moderator/dashboard', [ModeratorDashboardController::class, 'runDashboard'])->name('moderator.dashboard');
Route::get('/ubms/dashboard', [UmsbDashboardController::class, 'runDashboard'])->name('ubms.dashboard');
Route::get('/uni-admin/dashboard', [UniAdminDashboardController::class, 'show'])->name('uniAdmin.dashboard');

//Moderator dashboard menu routes
Route::get('moderator/dashboard/mod_uni_menu', [ModUniMenuController::class, 'showMenu'])->name('mod_uni_menu');
Route::get('mmoderator/dashboard/university-list', [UniversityController::class, 'showAccredited'])->name('universities.accredited');
Route::get('moderator/dashboard/university-registration', [UniRegistrationController::class, 'showRegistrationForm'])->name('university.registration');
Route::post('moderator/dashboard/university/registration', [UniRegistrationController::class, 'register'])->name('university.registration.post');


Route::get('moderator/dashboard/mod_users_menu', [ModUserMenuController::class, 'showMenu'])->name('mod_users_menu');

Route::get('moderator/dashboard/mod_faculties_menu', [ModFacultyMenuController::class, 'showMenu'])->name('mod_faculties_menu');

Route::get('moderator/dashboard/mod_students_menu', [ModStudentsMenuController::class, 'showMenu'])->name('mod_students_menu');
Route::get('moderator/dashboard/mod_students_menu/student-list', [StudentMenuViewController::class, 'viewStudents'])->name('mod_view_students');
Route::get('moderator/dashboard/mod_students_menu/students-register', [StudentMenuAddController::class, 'create'])->name('mod_add_students');
Route::post('moderator/dashboard/mod_students_menu/students/register', [StudentMenuAddController::class, 'store'])->name('students.store');
// AJAX for dynamic department dropdown
Route::get('/departments/by-university/{uni_id}', [StudentMenuAddController::class, 'getDepartments']);

Route::prefix('moderator/dashboard/mod_students_menu/students-update')->group(function () {
    Route::get('/', [StudentMenuUpdateController::class, 'index'])->name('mod_update_students');
    Route::post('/update/search', [StudentMenuUpdateController::class, 'search'])->name('students.update.search');
    Route::get('/update/{id}', [StudentMenuUpdateController::class, 'getStudent'])->name('students.update.get');
    Route::put('/update/{id}', [StudentMenuUpdateController::class, 'update'])->name('students.update.submit');
});

Route::prefix('moderator/dashboard/mod_students_menu/students-delete')->group(function () {
    Route::get('/', [StudentMenuDeleteController::class, 'index'])
        ->name('mod_delete_students');
    Route::post('/search', [StudentMenuDeleteController::class, 'search'])
        ->name('moderator.students.delete.search');
    Route::delete('/{id}', [StudentMenuDeleteController::class, 'destroy'])
        ->name('moderator.students.delete.destroy');
});

Route::prefix('moderator/dashboard/mod_students_menu')->group(function() {
    Route::get('/students-transcript', [StudentMenuTranscriptController::class, 'index'])->name('mod_students_transcript');
    Route::post('/students-transcript/search', [StudentMenuTranscriptController::class, 'search'])->name('moderator.students.transcript.search');
    Route::get('/students-transcript/{id}', [StudentMenuTranscriptController::class, 'show'])->name('moderator.students.transcript.show');
});

Route::group(['prefix' => 'moderator/dashboard/mod_students_menu'], function() {
    Route::get('/scholarships', [StudentMenuUpdateScholarshipController::class, 'viewScholarships'])
        ->name('mod_update_scholarships');
    
    Route::patch('/scholarships/{id}/update-status', [StudentMenuUpdateScholarshipController::class, 'updateScholarshipStatus'])
        ->name('mod_update_scholarship_status');
});

Route::get('moderator/dashboard/mod_departments_menu', [ModDepartmentsMenuController::class, 'showMenu'])->name('mod_departments_menu');

Route::get('moderator/dashboard/mod_courses_menu', [ModCoursesMenuController::class, 'showMenu'])->name('mod_courses_menu');

Route::get('moderator/dashboard/mod_jobpostings_menu', [ModJobpostingMenuController::class, 'showMenu'])->name('mod_jobposting_menu');

Route::get('moderator/dashboard/mod_facultydevelopment_menu', [ModFacultyDevelopmentMenuController::class, 'showMenu'])->name('mod_facultydevelopment_menu');

Route::get('moderator/dashboard/mod_facultyrecruitment_menu', [ModFacultyRecruitmentMenuController::class, 'showMenu'])->name('mod_facultyrecruitment_menu');

Route::get('moderator/dashboard/mod_unifunding_menu', [ModUniFundingMenuController::class, 'showMenu'])->name('mod_unifunding_menu');



// UBMS dashboard menu routes
Route::get('ubms/dashboard/ubms_uni_menu', [UbmsUniMenuController::class, 'showMenu'])->name('ubms_uni_menu');
Route::get('ubms/dashboard/ubms_faculties_menu', [UbmsFacultyMenuController::class, 'showMenu'])->name('ubms_faculties_menu');
Route::get('ubms/dashboard/ubms_students_menu', [UbmsStudentsMenuController::class, 'showMenu'])->name('ubms_students_menu');
Route::get('ubms/dashboard/ubms_jobpostings_menu', [UbmsJobpostingMenuController::class, 'showMenu'])->name('ubms_jobposting_menu');
Route::get('ubms/dashboard/ubms_facultydevelopment_menu', [UbmsFacultyDevelopmentMenuController::class, 'showMenu'])->name('ubms_facultydevelopment_menu');
Route::get('ubms/dashboard/ubms_unifunding_menu', [UbmsUniFundingMenuController::class, 'showMenu'])->name('ubms_unifunding_menu');


// University admin dashboard menu routes

Route::get('uni-admin/dashboard/admin_faculties_menu', [AdminFacultyMenuController::class, 'showMenu'])->name('admin_faculties_menu');
Route::get('uni-admin/dashboard/admin_students_menu', [AdminStudentsMenuController::class, 'showMenu'])->name('admin_students_menu');
Route::get('uni-admin/dashboard/admin_departments_menu', [AdminDepartmentsMenuController::class, 'showMenu'])->name('admin_departments_menu');
Route::get('uni-admin/dashboard/admin_courses_menu', [AdminCoursesMenuController::class, 'showMenu'])->name('admin_courses_menu');
Route::get('uni-admin/dashboard/admin_jobpostings_menu', [AdminJobpostingMenuController::class, 'showMenu'])->name('admin_jobposting_menu');
Route::get('uni-admin/dashboard/admin_facultydevelopment_menu', [AdminFacultyDevelopmentMenuController::class, 'showMenu'])->name('admin_facultydevelopment_menu');
Route::get('uni-admin/dashboard/admin_facultyrecruitment_menu', [AdminFacultyRecruitmentMenuController::class, 'showMenu'])->name('admin_facultyrecruitment_menu');
Route::get('uni-admin/dashboard/admin_unifunding_menu', [AdminUniFundingMenuController::class, 'showMenu'])->name('admin_unifunding_menu');




Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect(route('homepage'));
})->name('logout');


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