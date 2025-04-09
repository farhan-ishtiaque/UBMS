<?php

namespace App\Http\Controllers;

use App\Models\Departments;
use App\Models\Faculties;
use App\Models\Students;
use App\Models\Courses;
use App\Models\JobPostings;
use App\Models\FacultyRecruitment;
use App\Models\FacultyDevelopment;
use App\Models\UniFunding;
use App\Models\University;

class UniAdminDashboardController extends Controller
{
    public function show()
    {
        // Get university ID from session
        $uniId = session('uni_id');

        // Fetch university-specific data
        $university = University::find($uniId);
        $faculties = Faculties::where('uni_id', $uniId)->get();
        $students = Students::where('uni_id', $uniId)->get();
        $jobs = JobPostings::where('uni_id', $uniId)->get();
        $facultyRecruitments = FacultyRecruitment::select('faculty_recruitments.*')
            ->join('job_postings', 'faculty_recruitments.job_id', '=', 'job_postings.job_id')
            ->where('job_postings.uni_id', $uniId)
            ->get();
        $departments = Departments::where('uni_id', $uniId)->get();
        $courses = Courses::select('courses.*')
            ->join('departments', 'courses.dept_id', '=', 'departments.dept_id')
            ->where('departments.uni_id', $uniId)
            ->get();

        // Return the view with data
        return view('uniAdmin_dashboard', [
            'university' => $university,
            'faculties' => $faculties,
            'students' => $students,
            'jobs' => $jobs,
            'facultyRecruitments' => $facultyRecruitments,
            'departments' => $departments,
            'courses' => $courses,

        ]);
    }

    public function getDashboardData()
{
    $uniId = session('uni_id'); // Get university ID from session

    return response()->json([
        // Core educational metrics (now university-specific)
        'totalDepartments' => Departments::where('uni_id', $uniId)->count(),
        'totalFaculties' => Faculties::where('uni_id', $uniId)->count(),
        'totalStudents' => Students::where('uni_id', $uniId)->count(),
        'totalCourses' => Courses::join('departments', 'courses.dept_id', '=', 'departments.dept_id')
            ->where('departments.uni_id', $uniId)
            ->count(),

        // Employment and development
        'jobPostings' => JobPostings::where('uni_id', $uniId)->count(),
        'facultyRecruitment' => FacultyRecruitment::join('job_postings', 'faculty_recruitments.job_id', '=', 'job_postings.job_id')
            ->where('job_postings.uni_id', $uniId)
            ->count(),
        'facultyPrograms' => FacultyDevelopment::count(), // Assuming this is university-specific
        'facultyDevelopment' => FacultyDevelopment::join('faculties', 'faculty_developments.faculty_id', '=', 'faculties.faculty_id')
            ->where('faculties.uni_id', $uniId)
            ->count(),


    ]);
}
}