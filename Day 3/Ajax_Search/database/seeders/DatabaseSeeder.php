<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    

public function run()
{
    User::factory()->create(['name' => 'Alice Johnson', 'email' => 'alice@example.com']);
    User::factory()->create(['name' => 'Bob Smith', 'email' => 'bob@example.com']);
    User::factory()->create(['name' => 'Charlie Brown', 'email' => 'charlie@example.com']);
    User::factory()->create(['name' => 'Diana Ross', 'email' => 'diana@example.com']);
    User::factory()->create(['name' => 'Ethan Hunt', 'email' => 'ethan@example.com']);
    User::factory()->create(['name' => 'Fiona Apple', 'email' => 'fiona@example.com']);
    User::factory()->create(['name' => 'George Clooney', 'email' => 'george@example.com']);
    User::factory()->create(['name' => 'Hannah Montana', 'email' => 'hannah@example.com']);
    User::factory()->create(['name' => 'Ian Somerhalder', 'email' => 'ian@example.com']);
    User::factory()->create(['name' => 'Jack Sparrow', 'email' => 'jack@example.com']);
    User::factory()->create(['name' => 'Karen Page', 'email' => 'karen@example.com']);
    User::factory()->create(['name' => 'Leo Messi', 'email' => 'leo@example.com']);
    User::factory()->create(['name' => 'Mona Lisa', 'email' => 'mona@example.com']);
    User::factory()->create(['name' => 'Nathan Drake', 'email' => 'nathan@example.com']);
    User::factory()->create(['name' => 'Olivia Wilde', 'email' => 'olivia@example.com']);
    User::factory()->create(['name' => 'Peter Parker', 'email' => 'peter@example.com']);
    User::factory()->create(['name' => 'Quinn Fabray', 'email' => 'quinn@example.com']);
    User::factory()->create(['name' => 'Rachel Green', 'email' => 'rachel@example.com']);
    User::factory()->create(['name' => 'Steve Rogers', 'email' => 'steve@example.com']);
    User::factory()->create(['name' => 'Tony Stark', 'email' => 'tony@example.com']);
    User::factory()->create(['name' => 'Uma Thurman', 'email' => 'uma@example.com']);
    User::factory()->create(['name' => 'Victor Stone', 'email' => 'victor@example.com']);
    User::factory()->create(['name' => 'Wanda Maximoff', 'email' => 'wanda@example.com']);
    User::factory()->create(['name' => 'Xander Cage', 'email' => 'xander@example.com']);
    User::factory()->create(['name' => 'Yara Greyjoy', 'email' => 'yara@example.com']);
    User::factory()->create(['name' => 'Zack Taylor', 'email' => 'zack@example.com']);
}

}
