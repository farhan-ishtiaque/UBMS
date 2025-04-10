<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Faculties;
use App\Models\Students;
use App\Models\University;
use App\Models\JobPostings;
use Illuminate\Http\Request;
use App\Models\FacultyDevelopment;

class UmsbDashboardController extends Controller
{
    public function rundashboard()
    {
        return view('umsb_dashboard');
    }

    public function getDashboardData()
    {
        return response()->json([
            // Universities data
            'totalUniversities' => University::count(),
            'publicUniversities' => University::where('uni_type', 'public')->count(),
            'privateUniversities' => University::where('uni_type', 'private')->count(),

            // Faculties data
            'totalFaculties' => Faculties::count(),
            'publicFaculties' => Faculties::join('universities', 'faculties.uni_id', '=', 'universities.uni_id')
                ->where('universities.uni_type', 'public')
                ->count(),
            'privateFaculties' => Faculties::join('universities', 'faculties.uni_id', '=', 'universities.uni_id')
                ->where('universities.uni_type', 'private')
                ->count(),

            // Students data
            'totalStudents' => Students::count(),
            'publicStudents' => Students::join('universities', 'students.uni_id', '=', 'universities.uni_id')
                ->where('universities.uni_type', 'public')
                ->count(),
            'privateStudents' => Students::join('universities', 'students.uni_id', '=', 'universities.uni_id')
                ->where('universities.uni_type', 'private')
                ->count(),

            // Other counts
            'jobPostings' => JobPostings::count(),
            'facultyPrograms' => FacultyDevelopment::count()
        ]);
    }
}