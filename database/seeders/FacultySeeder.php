<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Faculty::create([
            'name' => 'Computer Science',
            'description' => 'focuses on the development and testing of software and software systems',
            'status' => 'active',
        ]);
        Faculty::create([
            'name' => 'Electrical Engineering',
            'description' => 'The department of Electrical Engineering offers courses related to electrical circuits,
             systems, and electrical devices.',
            'status' => 'active',
        ]);

        Faculty::create([
            'name' => 'Mechanical Engineering',
            'description' => 'The department of Mechanical Engineering specializes in the design,
            analysis, and manufacturing of machines and mechanical systems.',
            'status' => 'inactive',
        ]);

        Faculty::create([
            'name' => 'Civil Engineering',
            'description' => 'The department of Civil Engineering focuses on infrastructure,
            building projects, and urban planning.',
            'status' => 'active',
        ]);
    }
}
