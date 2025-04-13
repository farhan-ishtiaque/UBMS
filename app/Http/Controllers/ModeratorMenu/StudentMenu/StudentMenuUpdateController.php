<?php

namespace App\Http\Controllers\ModeratorMenu\StudentMenu;
use App\Http\Controllers\Controller;

use App\Models\Students;
use App\Models\University;
use App\Models\Departments;
use Illuminate\Http\Request;

class StudentMenuUpdateController extends Controller
{
    public function index()
{
    $universities = University::all(); // Fetch all universities
    return view('ModeratorMenu.StudentMenu.mod_updatestudents', compact('universities'));
}

    public function search(Request $request)
    {
        $query = Students::query();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->with(['university', 'department'])
                         ->orderBy('first_name')
                         ->paginate(10);

        return response()->json($students);
    }

    public function getStudent($id)
{
    $student = Students::with(['university', 'department'])->findOrFail($id);
    
    // Ensure date_of_birth is in proper format
    if ($student->date_of_birth) {
        $student->date_of_birth = \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d');
    }
    
    return response()->json($student);
}

    public function update(Request $request, $id)
    {
        $student = Students::findOrFail($id);
        
        $validated = $request->validate([
            'uni_id' => 'required|exists:universities,uni_id',
            'dept_id' => 'required|exists:departments,dept_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,'.$id.',student_id',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'cgpa' => 'nullable|numeric|min:0|max:4',
            'graduation_status' => 'required|in:graduated,not_graduated',
        ]);

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully'
        ]);
    }
}