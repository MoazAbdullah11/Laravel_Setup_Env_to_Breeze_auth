<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name follows the convention)
    protected $table = 'form_data';

    // Define which attributes are mass assignable
    protected $fillable = ['name', 'email', 'file'];

    // If you want to specify the timestamps explicitly
    public $timestamps = true;
}
