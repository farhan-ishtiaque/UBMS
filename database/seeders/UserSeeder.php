<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
{
    $moderators = [
        [
            'FirstName' => 'Farhan',
            'LastName' => 'Ishtiaque',
            'PhoneNumber' => '1234567890',
            'email' => 'moderator1@example.com', // Use valid email format
            'password' => Hash::make('admin123'),
            'type' => 'moderators', // Add role if needed
        ],
        [
            'FirstName' => 'Asfiya',
            'LastName' => 'Rashid',
            'PhoneNumber' => '9876543210',
            'email' => 'moderator2@example.com',
            'password' => Hash::make('admin123'),
            'type' => 'moderators',
        ],
        [
            'FirstName' => 'Minhaj',
            'LastName' => 'Rashid',
            'PhoneNumber' => '9876543210',
            'email' => 'admin1@example.com',
            'password' => Hash::make('admin123'),
            'type' => 'university_admin',
        ],
        [
            'FirstName' => 'Tazrian',
            'LastName' => 'Rashid',
            'PhoneNumber' => '9876543210',
            'email' => 'umsb1@example.com',
            'password' => Hash::make('admin123'),
            'type' => 'umsb_personnel',
        ],
    ];

    foreach ($moderators as $mod) {
        User::updateOrCreate(
            ['email' => $mod['email']], // Unique identifier
            $mod // Data to insert/update
        );
    }
}
}
