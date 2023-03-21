<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'name' => 'Duong Minh Tri',
                'email' => 'tri@student.com',
                'student_id' => '1911066414',
                'faculty_id' => 1,
            ],
            [
                'name' => 'To Hoang Phuc',
                'email' => 'phuc@student.com',
                'student_id' => '1911066285',
                'faculty_id' => 1,
            ]
        ]);
    }
}