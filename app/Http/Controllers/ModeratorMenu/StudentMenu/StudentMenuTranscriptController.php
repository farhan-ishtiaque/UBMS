<?php

namespace App\Http\Controllers\ModeratorMenu\StudentMenu;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;

class StudentMenuTranscriptController extends Controller
{
    public function index()
    {
        $universities = University::all();
        return view('ModeratorMenu.StudentMenu.mod_transcript', compact('universities'));
    }

    public function search(Request $request)
    {
        $query = Students::query()->with(['university', 'department', 'courses' => function($q) {
            $q->orderBy('pivot_year')->orderBy('pivot_semester');
        }]);
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('university_id')) {
            $query->where('uni_id', $request->university_id);
        }

        if ($request->filled('department_id')) {
            $query->where('dept_id', $request->department_id);
        }

        $students = $query->orderBy('first_name')->paginate(10);
        return response()->json($students);
    }

    public function show($id)
    {
        $student = Students::with([
            'university',
            'department',
            'courses' => function($q) {
                $q->orderBy('pivot_year')->orderBy('pivot_semester');
            }
        ])->findOrFail($id);

        // Organize courses by semester and year
        $transcript = [];
        foreach ($student->courses as $course) {
            $key = "Year {$course->pivot->year} - Semester {$course->pivot->semester}";
            if (!isset($transcript[$key])) {
                $transcript[$key] = [];
            }
            $transcript[$key][] = $course;
        }

        return response()->json([
            'student' => $student,
            'transcript' => $transcript
        ]);
    }
}