<?php
namespace App\Http\Controllers\AdminMenu\StudentMenu;
use App\Http\Controllers\Controller;

use App\Models\University;
use App\Models\Departments;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminStudentMenuAddController extends Controller
{
    public function create()
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        // Get the university and its departments
        $university = University::findOrFail($uni_id);
        $departments = Departments::where('uni_id', $uni_id)->get();
        
        return view('AdminMenu.StudentMenu.admin_addstudents', compact('university', 'departments'));
    }

    public function store(Request $request)
    {
        // Get university ID from session
        $uni_id = session('uni_id');
        
        $request->validate([
            'dept_id' => 'required|exists:departments,dept_id,uni_id,'.$uni_id, // Ensure department belongs to the university
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

        // Add the university ID to the request data
        $data = $request->all();
        $data['uni_id'] = $uni_id;

        Students::create($data);

        return redirect()->back()->with('success', 'Student registered successfully.');
    }

    // This might not be needed anymore since we're loading departments directly
    public function getDepartments($universityId)
    {
        $departments = Departments::where('uni_id', $universityId)->get();
        return response()->json($departments);
    }
}