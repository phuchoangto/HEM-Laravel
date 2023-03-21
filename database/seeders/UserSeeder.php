<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Duong Minh Tri',
                'email' => 'tri@duck.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'To Hoang Phuc',
                'email' => 'phuc@duck.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Nguyen Dang Minh Nhat',
                'email' => 'nhat@duck.com',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}