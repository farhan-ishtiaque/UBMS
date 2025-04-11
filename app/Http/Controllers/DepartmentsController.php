<?php
namespace App\Http\Controllers;
use App\Models\Departments;
use App\Models\University;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    
    public function index(Request $request)
    {
        $uni_id = $request->input('uni_id');

        // Only accredited universities
        $universities = University::where('accreditation_status', 'accredited')->get();

        // Fetch departments if university is selected
        $departments = [];
        if ($uni_id) {
            $departments = Departments::with('university')
                ->where('uni_id', $uni_id)
                ->get();
        }

        return view('departments.index', compact('universities', 'departments', 'uni_id'));
    }
    
    public function create()
    {
        $universities = University::all();  // Fetch all universities
        return view('departments.create', compact('universities'));
    }

    // Store a newly created department in the database
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'uni_id' => 'required|exists:universities,uni_id',
            'dept_name' => 'required|string|max:255',
            'email_address' => 'nullable|email',
            'programs' => 'required|in:Undergraduate,Postgraduate',
            'phone_number' => 'nullable|string|max:15',
        ]);

        // Create the department
        Departments::create($validated);

        // Redirect to the departments list with a success message
        return redirect()->route('departments.index')->with('success', 'Department created successfully!');
    }

    // Show the form for editing a department
    public function edit($id)
    {
        $universities = University::all();
        $department = Departments::findOrFail($id);  // Fetch the department by ID
        return view('departments.edit', compact('department', 'universities'));
    }
    public function manage(Request $request)
    {
        $universities = University::all();
        $uni_id = $request->input('uni_id');
        $departments = collect();
    
        if ($uni_id) {
            $departments = Departments::where('uni_id', $uni_id)->get();
        }
    
        return view('departments.manage', compact('universities', 'departments', 'uni_id'));
    }

    // Update the specified department in the database
    public function update(Request $request, $id)
    {
        // Validate the form data
        $validated = $request->validate([
            'dept_name' => 'required|string|max:255',
            'email_address' => 'nullable|email',
            'programs' => 'required|in:Undergraduate,Postgraduate',
            'phone_number' => 'nullable|string|max:15',
        ]);

        // Find the department and update it
        $department = Departments::findOrFail($id);
        $department->update($validated);

        // Redirect to the departments list with a success message
        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }
    public function deleteDepartment(Request $request)
{
    $universities = University::all();
    $uni_id = $request->input('uni_id');
    $departments = collect();

    if ($uni_id) {
        $departments = Departments::where('uni_id', $uni_id)->get();
    }

    return view('departments.delete', compact('universities', 'departments', 'uni_id'));
}
public function destroy($id)
{
    $department = Departments::findOrFail($id);
    $department->delete();

    return redirect()->route('departments.deletePage')->with('success', 'Department deleted successfully.');
}

}
