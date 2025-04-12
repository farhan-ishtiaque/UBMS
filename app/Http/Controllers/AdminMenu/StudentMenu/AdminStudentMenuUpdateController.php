<?php

namespace App\Http\Controllers\AdminMenu\StudentMenu;

use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\University;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStudentMenuUpdateController extends Controller
{
    public function index()
    {
        $uni_id = session('uni_id');
        $university = University::findOrFail($uni_id);
        $departments = Departments::where('uni_id', $uni_id)->get();
        
        return view('AdminMenu.StudentMenu.admin_updatestudents', compact('university', 'departments'));
    }

    public function search(Request $request)
    {
        $uni_id = session('uni_id');
        
        $query = Students::with(['university', 'department'])
            ->where('uni_id', $uni_id);
            
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $query->orderBy('first_name')->paginate(10);
        return response()->json($students);
    }

    public function getStudent($id)
    {
        $uni_id = session('uni_id');
        
        $student = Students::with(['university', 'department'])
            ->where('uni_id', $uni_id)
            ->findOrFail($id);
        
        if ($student->date_of_birth) {
            $student->date_of_birth = \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d');
        }
        
        return response()->json($student);
    }

    public function update(Request $request, $id)
    {
        $uni_id = session('uni_id');
        
        $student = Students::where('uni_id', $uni_id)
            ->findOrFail($id);
        
        $validated = $request->validate([
            'dept_id' => 'required|exists:departments,dept_id,uni_id,'.$uni_id,
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

        $validated['uni_id'] = $uni_id;
        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Student updated successfully'
        ]);
    }
}