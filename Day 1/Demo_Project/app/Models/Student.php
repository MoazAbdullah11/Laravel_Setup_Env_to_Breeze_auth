<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Define the fields that are mass-assignable
    protected $fillable = ['name', 'email', 'age'];

    // Optional: Customize the table name if it's different
    // protected $table = 'students';
}
