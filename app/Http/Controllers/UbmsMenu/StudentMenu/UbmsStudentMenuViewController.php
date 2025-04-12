<?php

namespace App\Http\Controllers\UbmsMenu\StudentMenu;

use App\Models\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UbmsStudentMenuViewController extends Controller
{
    public function showStudents(Request $request)
    {
        $search = $request->input('search');
        $statusFilter = $request->input('scholarship_status');

        $students = Students::with(['department', 'scholarships', 'department.university'])
            ->where(function ($query) use ($search) {
                $query->when($search, function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                        ->orWhere('middle_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhereHas('emails', fn($q) => $q->where('email', 'like', "%$search%"));
                });
            })
            ->get();

        // Apply scholarship filter manually
        if ($statusFilter) {
            $students = $students->filter(function ($student) use ($statusFilter) {
                if ($statusFilter === 'None') {
                    return $student->scholarships->isEmpty();
                }
                return $student->scholarships->contains('status', $statusFilter);
            });
        }

        return view('UbmsMenu.StudentsMenu.ubms_students_menu_view', compact('students', 'search', 'statusFilter'));
    }
}