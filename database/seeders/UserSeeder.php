<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{
    User, Trigger
};
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
            'email' => 'teacher1@gmail.com',
            'name' => 'Teacher 1',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
            'fingerprint_id' => 1
        ]);

        User::create([
            'email' => 'teacher2@gmail.com',
            'name' => 'Teacher 2',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
            'fingerprint_id' => 2
        ]);

        User::create([
            'email' => 'teacher3@gmail.com',
            'name' => 'Teacher 3',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
            'fingerprint_id' => 3
        ]);

        User::create([
            'email' => 'teacher4@gmail.com',
            'name' => 'Teacher 4',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
            'fingerprint_id' => 4
        ]);

        User::create([
            'email' => 'teacher5@gmail.com',
            'name' => 'Teacher 5',
            'user_type' => 'teacher',
            'password' => Hash::make('password'),
            'fingerprint_id' => 5
        ]);

        Trigger::create([
            'access_trigger' => 0
        ]);
    }
}
