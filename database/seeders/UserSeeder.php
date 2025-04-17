<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $users = [
                [
                    'name' => 'Muhamad Rasya Yoga Firmansyah',
                    'email' => 'rasyayoga@gmail.com',
                    'password' => Hash::make('firmansyah'),
                    'role' => 'admin'
                ],
                [
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'password' => Hash::make('user'),
                    'role' => 'employee'
                ],
            ];
    
            foreach ($users as $user) {
                User::create($user);
            }
        }
    }
}
