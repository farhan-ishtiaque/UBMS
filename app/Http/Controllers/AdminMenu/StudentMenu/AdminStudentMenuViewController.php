<?php
namespace App\Http\Controllers\AdminMenu\StudentMenu;

use App\Models\Departments;
use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminStudentMenuViewController extends Controller
{
    public function viewStudents(Request $request)
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        // Get the university and its departments
        $university = University::findOrFail($uni_id);
        $departments = Departments::where('uni_id', $uni_id)->get();

        $query = Students::with(['university', 'department', 'scholarship'])
            ->where('uni_id', $uni_id); // Only show students from this university

        // Filters (removed university filter)
        if ($request->filled('department_id')) {
            $query->where('dept_id', $request->department_id);
        }

        if ($request->filled('scholarship_status')) {
            $query->whereHas('scholarship', function ($q) use ($request) {
                $q->where('status', $request->scholarship_status);
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('graduation_status')) {
            $query->where('graduation_status', $request->graduation_status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%")
                  ->orWhere('phone_number', 'like', "%{$request->search}%");
            });
        }

        $students = $query->orderBy('student_id', 'desc')->paginate(15);

        return view('AdminMenu.StudentMenu.admin_viewstudents', compact('students', 'university', 'departments'));
    }
}