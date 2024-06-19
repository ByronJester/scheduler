<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'school.admin@gmail.com',
            'name' => 'School Admin',
            'user_type' => 'school_admin',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'email' => 'teacher@gmail.com',
            'name' => 'Teacher',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
        ]);
    }
}
