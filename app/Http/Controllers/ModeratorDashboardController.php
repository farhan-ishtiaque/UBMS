<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Students;
use App\Models\Faculties;
use App\Models\University;
use App\Models\JobPostings;
use Illuminate\Http\Request;
use App\Models\FacultyDevelopment;

class ModeratorDashboardController extends Controller
{
    public function runDashboard()
    {
        $totalUniversities = 100;
        $totalUsers = 100;
        $jobPosts = 100;
        $totalStudents = 100;
        $totalCourses = 100;
        $errorCount = 100;

        return view('moderator_dashboard', compact(
            'totalUniversities',
            'totalUsers',
            'jobPosts',
            'totalStudents',
            'totalCourses',
            'errorCount'
        ));
    }

    // app/Http/Controllers/ModeratorDashboardController.php

    public function getDashboardData()
    {
        return response()->json([
            // Universities data (unchanged)
            'totalUniversities' => University::count(),
            'publicUniversities' => University::where('uni_type', 'public')->count(),
            'privateUniversities' => University::where('uni_type', 'private')->count(),
    
            // Faculties data (updated with join)
            'totalFaculties' => Faculties::count(),
            'publicFaculties' => Faculties::join('universities', 'faculties.uni_id', '=', 'universities.uni_id')
                                    ->where('universities.uni_type', 'public')
                                    ->count(),
            'privateFaculties' => Faculties::join('universities', 'faculties.uni_id', '=', 'universities.uni_id')
                                    ->where('universities.uni_type', 'private')
                                    ->count(),
    
            // Students data (assuming similar structure)
            'totalStudents' => Students::count(),
            'publicStudents' => Students::join('universities', 'students.uni_id', '=', 'universities.uni_id')
                                    ->where('universities.uni_type', 'public')
                                    ->count(),
            'privateStudents' => Students::join('universities', 'students.uni_id', '=', 'universities.uni_id')
                                    ->where('universities.uni_type', 'private')
                                    ->count(),
    
            // Other counts (unchanged)
            'jobPostings' => JobPostings::count(),
            'facultyPrograms' => FacultyDevelopment::count()
        ]);
    }

}
