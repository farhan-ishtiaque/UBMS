<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,  // This will call the UserSeeder
            // Add other seeders here if needed
            UniversitiesTableSeeder::class,
            DepartmentTableSeeder::class,
            StudentsTableSeeder::class,
            ScholarshipsTableSeeder::class,
            CoursesTableSeeder::class,
            EnrollmentTableSeeder::class,

        
        ]);
    }
}
