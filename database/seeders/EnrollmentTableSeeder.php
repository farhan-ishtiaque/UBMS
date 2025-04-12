<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EnrollmentTableSeeder extends Seeder
{
    public function run()
    {
        $student_id = 1; // Assuming the student you mentioned is ID 1
        $courses = DB::table('courses')->where('dept_id', 1)->pluck('course_id');

        $grades = ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'D', 'F'];
        $semesters = ['Spring', 'Summer', 'Fall'];
        $years = ['2022', '2023', '2024'];

        $enrollments = [];
        $i = 0;

        foreach ($courses as $courseId) {
            $enrollments[] = [
                'student_id' => $student_id,
                'course_id' => $courseId,
                'semester' => $semesters[$i % count($semesters)],
                'year' => $years[$i % count($years)],
                'grade' => $grades[$i % count($grades)],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $i++;
        }

        DB::table('enrollment')->insert($enrollments);
    }
}
