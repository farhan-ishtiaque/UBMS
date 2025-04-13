<?php

namespace App\Http\Controllers\ModeratorMenu\StudentMenu;

use App\Models\Departments;
use App\Models\Scholarships;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentMenuUpdateScholarshipController extends Controller
{
    public function viewScholarships(Request $request)
    {
        try {
            $query = Scholarships::with(['student.university', 'student.department']);

            // Filters
            if ($request->filled('university_id')) {
                $query->whereHas('student', function($q) use ($request) {
                    $q->where('uni_id', $request->university_id);
                });
            }

            if ($request->filled('department_id')) {
                $query->whereHas('student', function($q) use ($request) {
                    $q->where('dept_id', $request->department_id);
                });
            }

            if ($request->filled('scholarship_status')) {
                $query->where('status', $request->scholarship_status);
            }

            if ($request->filled('search')) {
                $query->whereHas('student', function($q) use ($request) {
                    $q->where(function($subQuery) use ($request) {
                        $subQuery->where('first_name', 'like', "%{$request->search}%")
                              ->orWhere('last_name', 'like', "%{$request->search}%")
                              ->orWhere('email', 'like', "%{$request->search}%");
                    });
                });
            }

            $scholarships = $query->orderBy('created_at', 'desc')->paginate(15);
            $universities = University::all();
            $departments = Departments::all();

            return view('ModeratorMenu.StudentMenu.mod_update_scholarships', 
                compact('scholarships', 'universities', 'departments'));

        } catch (\Exception $e) {
            \Log::error('Error in viewScholarships: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading scholarships');
        }
    }

    public function updateScholarshipStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:Recepient,Revoked'
            ]);

            $scholarship = Scholarships::findOrFail($id);
            $scholarship->update(['status' => $request->status]);

            return back()->with('success', 'Scholarship status updated successfully');

        } catch (\Exception $e) {
            \Log::error('Error updating scholarship status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update scholarship status');
        }
    }
}