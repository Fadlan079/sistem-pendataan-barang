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
            User::updateOrCreate(
                [
                    'email' => 'admin@test.com'
                ],
                [
                    'name' => 'Testing Administrator',
                    'role' => 'admin',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            User::updateOrCreate(
                [
                    'email' => 'staff@test.com'
                ],
                [
                    'name' => 'Testing Staff',
                    'role' => 'staff',
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }

    }
