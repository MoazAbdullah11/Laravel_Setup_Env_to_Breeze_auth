<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Fetch all students from the database
        $students = Student::all();

        // Return the students as a JSON response
        return response()->json($students);
    }
}
