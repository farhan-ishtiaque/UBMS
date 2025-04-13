<?php

namespace App\Http\Controllers\AdminMenu;

use App\Http\Controllers\Controller;
use App\Models\Faculties;
use App\Models\FacultyPhone;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UniFacultyController extends Controller
{
    // View all faculties for the university in session
    public function index()
    {
        $uni_id = session('uni_id');
        $faculties = DB::table('faculties')
            ->join('universities', 'faculties.uni_id', '=', 'universities.uni_id')
            ->join('departments', 'faculties.dept_id', '=', 'departments.dept_id')
            ->where('faculties.uni_id', $uni_id)
            ->select(
                'faculties.faculty_id',
                'faculties.first_name',
                'faculties.last_name',
                'faculties.email',
                'faculties.designation',
                'faculties.qualification',
                'universities.uni_name',
                'departments.dept_name'
            )
            ->paginate(10);

        return view('AdminMenu.faculties-view', compact('faculties'));
    }

    // Show registration form
    public function create()
    {
        $uni_id = session('uni_id');
        $university = University::find($uni_id);
        $departments = DB::table('departments')
                        ->where('uni_id', $uni_id)
                        ->get();

        return view('AdminMenu.faculties-register', compact('university', 'departments'));
    }

    // Store new faculty
    public function store(Request $request)
    {
        $uni_id = session('uni_id');
        
        $validated = $request->validate([
            'dept_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:faculties,email',
            'qualification' => 'required|string|max:255',
            'teaching_experience' => 'nullable|integer',
            'phone_numbers.*' => 'nullable|string|max:20'
        ]);

        $validated['uni_id'] = $uni_id;

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

        return redirect()->route('admin_faculties_menu')->with('success', 'Faculty created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $faculty = Faculties::findOrFail($id);
        $uni_id = session('uni_id');
        $departments = DB::table('departments')
                        ->where('uni_id', $uni_id)
                        ->get();

        return view('AdminMenu.faculties-edit', compact('faculty', 'departments'));
    }

    // Update faculty
    public function update(Request $request, $id)
    {
        $request->validate([
            'dept_id' => 'required|integer',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'designation' => 'required|string',
            'email' => 'required|email|unique:faculties,email,'.$id.',faculty_id',
            'qualification' => 'required|string',
            'teaching_experience' => 'nullable|integer',
            'phone_numbers.*' => 'nullable|string|max:20'
        ]);

        $faculty = Faculties::findOrFail($id);
        $faculty->update($request->all());

        // Update phone numbers
        if ($request->has('phone_numbers')) {
            // First delete existing numbers
            FacultyPhone::where('faculty_id', $id)->delete();
            
            // Add new numbers
            foreach ($request->input('phone_numbers') as $phone) {
                if (!empty($phone)) {
                    FacultyPhone::create([
                        'faculty_id' => $id,
                        'phone_number' => $phone
                    ]);
                }
            }
        }

        return redirect()->route('admin_faculties_menu')->with('success', 'Faculty updated successfully!');
    }

    // Show delete confirmation
    public function showDelete($id)
    {
        $faculty = Faculties::findOrFail($id);
        return view('AdminMenu.faculties-delete', compact('faculty'));
    }

    // Delete faculty
    public function destroy($id)
    {
        $faculty = Faculties::findOrFail($id);
        
        // Delete related phone numbers first
        FacultyPhone::where('faculty_id', $id)->delete();
        
        $faculty->delete();

        return redirect()->route('admin_faculties_menu')->with('success', 'Faculty deleted successfully!');
    }
}