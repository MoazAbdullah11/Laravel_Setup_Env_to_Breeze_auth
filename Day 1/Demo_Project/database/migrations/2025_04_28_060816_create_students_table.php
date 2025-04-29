<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
{
    Schema::create('students', function (Blueprint $table) {
        $table->id();              // Primary key (id)
        $table->string('name');     // Name of the student
        $table->string('email')->unique(); // Email (unique)
        $table->integer('age');    // Age of the student
        $table->timestamps();      // Created_at and updated_at timestamps
    });
}


    public function down()
    {
        // Drop the students table if we need to rollback
        Schema::dropIfExists('students');
    }
}
