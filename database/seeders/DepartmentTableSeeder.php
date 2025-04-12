<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'dept_name' => 'Computer Science and Engineering',
                'uni_id' => 1, // University of Dhaka
                'email_address' => 'cse@du.ac.bd',
                'phone_number' => '+880 2 9661920',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Electrical and Electronic Engineering',
                'uni_id' => 2, // BUET
                'email_address' => 'eee@buet.ac.bd',
                'phone_number' => '+880 2 55167120',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Business Administration',
                'uni_id' => 3, // North South University
                'email_address' => 'business@northsouth.edu',
                'phone_number' => '+880 2 55668220',
                'programs' => 'Postgraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Economics',
                'uni_id' => 4, // BRAC University
                'email_address' => 'economics@bracu.ac.bd',
                'phone_number' => '+880 2 222264061',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'English Literature',
                'uni_id' => 5, // Jahangirnagar University
                'email_address' => 'english@juniv.edu',
                'phone_number' => '+880 2 7791055',
                'programs' => 'Postgraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Physics',
                'uni_id' => 1, // University of Dhaka
                'email_address' => 'physics@du.ac.bd',
                'phone_number' => '+880 2 9671920',
                'programs' => 'Postgraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Civil Engineering',
                'uni_id' => 2, // BUET
                'email_address' => 'civil@buet.ac.bd',
                'phone_number' => '+880 2 55167130',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Law',
                'uni_id' => 3, // North South University
                'email_address' => 'law@northsouth.edu',
                'phone_number' => '+880 2 55668300',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'Sociology',
                'uni_id' => 4, // BRAC University
                'email_address' => 'sociology@bracu.ac.bd',
                'phone_number' => '+880 2 222265061',
                'programs' => 'Postgraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'dept_name' => 'History',
                'uni_id' => 5, // Jahangirnagar University
                'email_address' => 'history@juniv.edu',
                'phone_number' => '+880 2 7791065',
                'programs' => 'Undergraduate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('departments')->insert($departments);
    }
}