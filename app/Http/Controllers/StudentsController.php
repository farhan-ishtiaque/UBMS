<?php

use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $students = Students::when($search, function ($query, $search) {
            return $query->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
        })
        ->with('university')
        ->paginate(10);

        return view('student', compact('students', 'search'));
    }

    public function create()
    {
        $universities = University::all();
        return view('studentCreate', compact('universities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'cgpa' => 'nullable|numeric|between:0,4.00',
            'graduation_status' => 'required|in:graduated,not_graduated',
            'graduation_date' => 'nullable|date',
            'dept_id' => 'required|exists:departments,dept_id',
            'uni_id' => 'required|exists:universities,uni_id'
        ]);

        Students::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    public function edit(Students $student)
    {
        $universities = University::all();
        return view('studentEdit', [
            'student' => $student,
            'universities' => $universities
        ]);
    }

    public function update(Request $request, Students $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female,other',
            'date_of_birth' => 'required|date',
            'cgpa' => 'nullable|numeric|between:0,4.00',
            'graduation_status' => 'required|in:graduated,not_graduated',
            'graduation_date' => 'nullable|date',
            'dept_id' => 'required|exists:departments,dept_id',
            'uni_id' => 'required|exists:universities,uni_id'
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    public function show(Students $student)
    {
        return view('studentShow', compact('student'));
    }

    public function destroy(Students $student)
    {
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
