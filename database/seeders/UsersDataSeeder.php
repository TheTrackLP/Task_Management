<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class UsersDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(111),
                'contact' => '123123',
                'address' => 'Banica',
                'role' => 'admin',
                'status' => 'active',
            ],

            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make(111),
                'contact' => '123123',
                'address' => 'Cavite',
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}