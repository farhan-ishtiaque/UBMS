<?php
namespace App\Http\Controllers\AdminMenu\StudentMenu;

use App\Models\Departments;
use App\Models\Scholarships;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminStudentMenuUpdateScholarshipController extends Controller
{
    public function viewScholarships(Request $request)
    {
        try {
            // Get university ID from session
            $uni_id = session('uni_id');
            
            $query = Scholarships::with(['student.university', 'student.department'])
                ->whereHas('student', function($q) use ($uni_id) {
                    $q->where('uni_id', $uni_id);
                });

            // Filters
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
            $university = University::findOrFail($uni_id);
            $departments = Departments::where('uni_id', $uni_id)->get();

            return view('AdminMenu.StudentMenu.admin_update_scholarships', 
                compact('scholarships', 'university', 'departments'));

        } catch (\Exception $e) {
            \Log::error('Error in viewScholarships: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading scholarships');
        }
    }

    public function updateScholarshipStatus(Request $request, $id)
    {
        try {
            // Get university ID from session
            $uni_id = session('uni_id');
            
            $request->validate([
                'status' => 'required|in:Recipient,Revoked'
            ]);

            $scholarship = Scholarships::whereHas('student', function($q) use ($uni_id) {
                    $q->where('uni_id', $uni_id);
                })
                ->findOrFail($id);
                
            $scholarship->update(['status' => $request->status]);

            return back()->with('success', 'Scholarship status updated successfully');

        } catch (\Exception $e) {
            \Log::error('Error updating scholarship status: ' . $e->getMessage());
            return back()->with('error', 'Failed to update scholarship status');
        }
    }
}