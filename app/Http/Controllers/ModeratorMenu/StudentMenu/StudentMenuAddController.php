<?php
namespace App\Http\Controllers\ModeratorMenu\StudentMenu;
use App\Http\Controllers\Controller;

use App\Models\University;
use App\Models\Departments;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentMenuAddController extends Controller
{
    public function create()
    {
        $universities = University::all();
        return view('ModeratorMenu.StudentMenu.mod_addstudents', compact('universities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'uni_id' => 'required|exists:universities,uni_id',
            'dept_id' => 'required|exists:departments,dept_id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'cgpa' => 'nullable|numeric|min:0|max:4',
            'graduation_status' => 'required|in:graduated,not_graduated'
        ]);

        Students::create($request->all());

        return redirect()->back()->with('success', 'Student registered successfully.');
    }

    public function getDepartments($universityId)
    {
        $departments = Departments::where('uni_id', $universityId)->get();
        return response()->json($departments);
    }
}
