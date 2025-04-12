<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesTableSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            [
                'dept_id' => 1, // Computer Science and Engineering (University of Dhaka)
                'course_name' => 'Data Structures and Algorithms',
                'course_code' => 'CSE101',
                
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Computer Science and Engineering (University of Dhaka)
                'course_name' => 'Artificial Intelligence',
                'course_code' => 'CSE102',
                
                'credits' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Electrical and Electronic Engineering (BUET)
                'course_name' => 'Circuit Theory',
                'course_code' => 'EEE101',
                
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Electrical and Electronic Engineering (BUET)
                'course_name' => 'Power Systems Engineering',
                'course_code' => 'EEE102',
                'credits' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Business Administration (North South University)
                'course_name' => 'Principles of Marketing',
                'course_code' => 'BUS101',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' =>1, // Business Administration (North South University)
                'course_name' => 'Financial Management',
                'course_code' => 'BUS102',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Economics (BRAC University)
                'course_name' => 'Microeconomics',
                'course_code' => 'ECO101',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // Economics (BRAC University)
                'course_name' => 'Macroeconomics',
                'course_code' => 'ECO102',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 1, // English Literature (Jahangirnagar University)
                'course_name' => 'Shakespearean Studies',
                'course_code' => 'ENG101',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_id' => 5, // English Literature (Jahangirnagar University)
                'course_name' => 'Contemporary Literature',
               'course_code' => 'ENG102',
                'credits' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}