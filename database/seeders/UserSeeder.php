<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'emp_id' => '123',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(111),
                'role' => 'admin',
                'status' => 'active',
            
            ],
            [
                'username' => 'User',
                'emp_id' => '123',
                'email' => 'user@gmail.com',
                'password' => Hash::make(111),
                'role' => 'user',
                'status' => 'active',
            
            ]
        ]);
    }
}