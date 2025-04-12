<?php

namespace App\Http\Controllers\ModeratorMenu\StudentMenu;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;

class StudentMenuDeleteController extends Controller
{
    public function index()
    {
        $universities = University::all();
        return view('ModeratorMenu.StudentMenu.mod_deletestudents', compact('universities'));
    }

    public function search(Request $request)
    {
        $query = Students::query()->with(['university', 'department']);
        
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

    public function destroy($id)
    {
        try {
            $student = Students::findOrFail($id);
            $student->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting student: ' . $e->getMessage()
            ], 500);
        }
    }
}