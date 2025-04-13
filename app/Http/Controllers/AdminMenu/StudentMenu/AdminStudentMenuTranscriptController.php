<?php
namespace App\Http\Controllers\AdminMenu\StudentMenu;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\University;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStudentMenuTranscriptController extends Controller
{
    public function index()
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        // Get the university and its departments
        $university = University::findOrFail($uni_id);
        $departments = Departments::where('uni_id', $uni_id)->get();
        
        return view('AdminMenu.StudentMenu.admin_transcript', compact('university', 'departments'));
    }

    public function search(Request $request)
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        $query = Students::query()
            ->with(['university', 'department', 'courses' => function($q) {
                $q->orderBy('pivot_year')->orderBy('pivot_semester');
            }])
            ->where('uni_id', $uni_id); // Only show students from this university
            
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('department_id')) {
            $query->where('dept_id', $request->department_id);
        }

        $students = $query->orderBy('first_name')->paginate(10);
        return response()->json($students);
    }

    public function show($id)
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        $student = Students::where('uni_id', $uni_id)
            ->with([
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