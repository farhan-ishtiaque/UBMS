<?php

namespace App\Http\Controllers\ModeratorMenu\StudentMenu;

use App\Models\Departments;
use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentMenuViewController extends Controller
{
    public function viewStudents(Request $request)
    {
        $query = Students::with(['university', 'department', 'scholarship']);

        // Filters
        if ($request->filled('university_id')) {
            $query->where('uni_id', $request->university_id);
        }

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
        $universities = University::all();
        $departments = Departments::all();

        return view('ModeratorMenu.StudentMenu.mod_viewstudents', compact('students', 'universities', 'departments'));
    }
}