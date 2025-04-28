<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        // Create 5 student records for testing
        Student::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'age' => 20
        ]);

        Student::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'age' => 22
        ]);

        // Add more students as needed
    }
}
