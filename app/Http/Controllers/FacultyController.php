<?php

namespace App\Http\Controllers;
use App\Models\University;
use App\Models\Faculties;
use App\Models\FacultyPhone;
use Illuminate\Http\Request;


class FacultyController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dept_id' => 'required|integer',
            'uni_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'teaching_experience' => 'nullable|integer',
            'phone_numbers.*' => 'nullable|string|max:20'
        ]);

        $faculty = Faculties::create($validated);

        if ($request->has('phone_numbers')) {
            foreach ($request->input('phone_numbers') as $phone) {
                if (!empty($phone)) {
                    FacultyPhone::create([
                        'faculty_id' => $faculty->faculty_id,
                        'phone_number' => $phone
                    ]);
                }
            }
        }

        return redirect()->route('faculties.create')->with('success', 'Faculty created successfully.');
    }
    public function showFaculties()
    {
        // Perform the query with the correct column name 'dept_id'
        $faculties = \DB::table('faculties')
            ->join('departments', 'faculties.dept_id', '=', 'departments.dept_id')  // Corrected column names for join
            ->join('universities', 'departments.uni_id', '=', 'universities.uni_id')
            ->select('faculties.faculty_id', 'faculties.first_name', 'faculties.last_name', 
                     'faculties.designation', 'faculties.qualification', 'universities.uni_name', 'departments..dept_name')
            ->paginate(10);  // Paginate the results
    
        return view('faculties', compact('faculties'));
    }
    
    public function editFaculty($id)
{
    // Fetch the faculty record based on the ID
    $faculty = Faculties::findOrFail($id);
    
    return view('facultiesEdit', compact('faculty'));
}
public function updateFaculty(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'designation' => 'required|string',
        'qualification' => 'required|string',
    ]);

    $faculty = Faculties::findOrFail($id);

    // Update the faculty fields
    $faculty->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'designation' => $request->designation,
        'qualification' => $request->qualification,
    ]);

    // Redirect back to the list with a success message
    return redirect()->route('faculties.list')->with('status', 'Faculty updated successfully!');
}
// Inside FacultyController.php


public function facultyUniversities(Request $request)
{
    $universities = University::where('accreditation_status', 'accredited')->get();

    // If a university is selected
    if ($request->has('university')) {
        $selectedUniversity = University::with('faculties')->find($request->university);
    } else {
        $selectedUniversity = null;
    }
    
    return view('facultyUniversities', compact('universities', 'selectedUniversity'));
}


public function deleteFacultyPage(Request $request)
{
    $universities = University::where('accreditation_status', 'accredited')->get();

    $selectedUniversity = null;
    if ($request->has('university')) {
        $selectedUniversity = University::with('faculties')->find($request->university);
    }

    return view('deleteFaculty', compact('universities', 'selectedUniversity'));
}

public function destroyFaculty($id)
{
    $faculty = Faculties::findOrFail($id);

    // Delete related phone numbers first (if needed to maintain referential integrity)
    //$faculty->phones()->delete();

    $faculty->delete();

    return redirect()->route('faculties.delete.page')->with('status', 'Faculty deleted successfully!');
}
}