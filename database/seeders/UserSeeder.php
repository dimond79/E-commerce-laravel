<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone' => '9965525656',
            'password'=> 'admin1234', //for hashing Hash:: make('admin1234')
            'role' => 'admin',
            'status' => 1
        ]);
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'phone' => '9965525656',
            'password'=> 'admin1234', //for hashing Hash:: make('admin1234')
            'role' => 'manager',
            'status' => 1
        ]);

    }
}
