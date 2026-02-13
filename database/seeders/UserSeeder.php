<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Admin User',
                'employee_number' => 'EMP001',
                'nik' => 'NIK001',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => Hash::make('Admin123'),
            ],
            [
                'name' => 'Budi',
                'employee_number' => 'EMP002',
                'nik' => 'NIK002',
                'email' => 'employee@example.com',
                'department' => 'Sewing',
                'role' => 'employee',
                'password' => Hash::make('Budi123'),
            ],
            [
                'name' => 'Ayu',
                'employee_number' => 'EMP003',
                'nik' => 'NIK003',
                'email' => 'another@example.com',
                'department' => 'Cutting',
                'role' => 'employee',
                'password' => Hash::make('Ayu123'),
            ],

        ];

        foreach ($userData as $user) {
            User::create($user);
        }
    }
}
