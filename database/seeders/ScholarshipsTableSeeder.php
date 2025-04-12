<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScholarshipsTableSeeder extends Seeder
{
    public function run()
    {
        $scholarships = [
            [
                'student_id' => 1, // Arif Hossain (University of Dhaka)
                'amount' => '50000',
                'status' => 'Recepient',
                'scholarship_type' => 'University Provided Aid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2, // Nusrat Jahan (BUET)
                'amount' => '75000',
                'status' => 'Recepient',
                'scholarship_type' => 'UBMS Merit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 3, // Tahmid Ahmed (North South University)
                'amount' => '100000',
                'status' => 'Revoked',
                'scholarship_type' => 'University Provided Aid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4, // Sumaiya Rahman (BRAC University)
                'amount' => '60000',
                'status' => 'Recepient',
                'scholarship_type' => 'UBMS Merit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 5, // Rafi Khan (Jahangirnagar University)
                'amount' => '70000',
                'status' => 'Recepient',
                'scholarship_type' => 'University Provided Aid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 1, // Arif Hossain (University of Dhaka)
                'amount' => '30000',
                'status' => 'Revoked',
                'scholarship_type' => 'UBMS Merit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 2, // Nusrat Jahan (BUET)
                'amount' => '85000',
                'status' => 'Recepient',
                'scholarship_type' => 'University Provided Aid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 3, // Tahmid Ahmed (North South University)
                'amount' => '50000',
                'status' => 'Recepient',
                'scholarship_type' => 'UBMS Merit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 4, // Sumaiya Rahman (BRAC University)
                'amount' => '45000',
                'status' => 'Revoked',
                'scholarship_type' => 'University Provided Aid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 5, // Rafi Khan (Jahangirnagar University)
                'amount' => '60000',
                'status' => 'Recepient',
                'scholarship_type' => 'UBMS Merit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('scholarships')->insert($scholarships);
    }
}