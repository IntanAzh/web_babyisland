<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [

                'role' => 'admin',
                'username' => 'admin1',
                'email' => 'admin1@gmail.com',
                'phonenumber' => '081000000001',
                'password' => Hash::make('admin1'),
            ],
            [
                'role' => 'user',
                'username' => 'user1',
                'email' => 'user1@gmail.com',
                'phonenumber' => '080000000001',
                'password' => Hash::make('user1'),
            ]
        ]);
    }
}
