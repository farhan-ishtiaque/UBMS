<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Students;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        $students = [
            [
                'dept_id' => 1,
                'uni_id' => 1,
                'first_name' => 'Arif',
                'last_name' => 'Hossain',
                'email' => 'arif.hossain@du.ac.bd',
                'phone_number' => '+880 1712345678',
                'address' => 'Gulshan, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1999-05-12',
                'cgpa' => 3.85,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 2,
                'uni_id' => 2,
                'first_name' => 'Nusrat',
                'last_name' => 'Jahan',
                'email' => 'nusrat.jahan@buet.ac.bd',
                'phone_number' => '+880 1912345678',
                'address' => 'Dhanmondi, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '2000-01-18',
                'cgpa' => 3.90,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 3,
                'uni_id' => 3,
                'first_name' => 'Tahmid',
                'last_name' => 'Ahmed',
                'email' => 'tahmid.ahmed@northsouth.edu',
                'phone_number' => '+880 1812345678',
                'address' => 'Bashundhara, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1998-07-20',
                'cgpa' => 3.75,
                'graduation_status' => 'graduated',
            ],
            [
                'dept_id' => 4,
                'uni_id' => 4,
                'first_name' => 'Sumaiya',
                'last_name' => 'Rahman',
                'email' => 'sumaiya.rahman@bracu.ac.bd',
                'phone_number' => '+880 1712348765',
                'address' => 'Mohakhali, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '1999-11-15',
                'cgpa' => 3.68,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 5,
                'uni_id' => 5,
                'first_name' => 'Rafi',
                'last_name' => 'Khan',
                'email' => 'rafi.khan@juniv.edu',
                'phone_number' => '+880 1612345678',
                'address' => 'Savar, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1997-03-25',
                'cgpa' => 3.45,
                'graduation_status' => 'graduated',
            ],
            [
                'dept_id' => 1,
                'uni_id' => 1,
                'first_name' => 'Arif 2',
                'last_name' => 'Hossain',
                'email' => 'arif2.hossain@du.ac.bd',
                'phone_number' => '+880 1712345678',
                'address' => 'Gulshan, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1999-05-12',
                'cgpa' => 3.85,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 2,
                'uni_id' => 2,
                'first_name' => 'Nusrat 2',
                'last_name' => 'Jahan',
                'email' => 'nusrat2.jahan@buet.ac.bd',
                'phone_number' => '+880 1912345678',
                'address' => 'Dhanmondi, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '2000-01-18',
                'cgpa' => 3.90,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 3,
                'uni_id' => 3,
                'first_name' => 'Tahmid2',
                'last_name' => 'Ahmed',
                'email' => 'tahmid2.ahmed@northsouth.edu',
                'phone_number' => '+880 1812345678',
                'address' => 'Bashundhara, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1998-07-20',
                'cgpa' => 3.75,
                'graduation_status' => 'graduated',
            ],
            [
                'dept_id' => 4,
                'uni_id' => 4,
                'first_name' => 'Sumaiya2',
                'last_name' => 'Rahman',
                'email' => 'sumaiya2.rahman@bracu.ac.bd',
                'phone_number' => '+880 1712348765',
                'address' => 'Mohakhali, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '1999-11-15',
                'cgpa' => 3.68,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 5,
                'uni_id' => 5,
                'first_name' => 'Rafi2',
                'last_name' => 'Khan',
                'email' => 'rafi2.khan@juniv.edu',
                'phone_number' => '+880 1612345678',
                'address' => 'Savar, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1997-03-25',
                'cgpa' => 3.45,
                'graduation_status' => 'graduated',
            ],
            [
                'dept_id' => 6,
                'uni_id' => 1,
                'first_name' => 'Imran2',
                'last_name' => 'Mahmud',
                'email' => 'imran2.mahmud@du.ac.bd',
                'phone_number' => '+880 1712347654',
                'address' => 'Mohammadpur, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '2001-02-11',
                'cgpa' => 3.80,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 7,
                'uni_id' => 2,
                'first_name' => 'Fatima2',
                'last_name' => 'Chowdhury',
                'email' => 'fatima2.chowdhury@buet.ac.bd',
                'phone_number' => '+880 1912349812',
                'address' => 'Banani, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '1999-07-17',
                'cgpa' => 3.92,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 8,
                'uni_id' => 3,
                'first_name' => 'Shakib2',
                'last_name' => 'Hussain',
                'email' => 'shakib2.hussain@northsouth.edu',
                'phone_number' => '+880 1812349123',
                'address' => 'Bashundhara, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1998-03-05',
                'cgpa' => 3.67,
                'graduation_status' => 'graduated',
            ],
            [
                'dept_id' => 9,
                'uni_id' => 4,
                'first_name' => 'Mehnaz2',
                'last_name' => 'Islam',
                'email' => 'mehnaz2.islam@bracu.ac.bd',
                'phone_number' => '+880 1712349012',
                'address' => 'Mohakhali, Dhaka',
                'gender' => 'female',
                'date_of_birth' => '2000-10-21',
                'cgpa' => 3.65,
                'graduation_status' => 'not_graduated',
            ],
            [
                'dept_id' => 10,
                'uni_id' => 5,
                'first_name' => 'Adnan2',
                'last_name' => 'Kabir',
                'email' => 'adnan2.kabir@juniv.edu',
                'phone_number' => '+880 1612343245',
                'address' => 'Savar, Dhaka',
                'gender' => 'male',
                'date_of_birth' => '1997-08-14',
                'cgpa' => 3.50,
                'graduation_status' => 'graduated',
            ],
        ];

        foreach ($students as $student) {
            Students::create($student);
        }
    }
}
