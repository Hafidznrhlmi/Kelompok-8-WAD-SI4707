<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create sample users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'phone_number' => '08123456789',
                'address' => 'Jl. Contoh No. 123',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'phone_number' => '08987654321',
                'address' => 'Jl. Sample No. 456',
                'date_of_birth' => '1992-05-15',
                'gender' => 'female',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'phone_number' => '081111111111',
                'address' => 'Jl. Admin No. 1',
                'date_of_birth' => '1985-12-31',
                'gender' => 'male',
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }

        // Call other seeders
        $this->call([
            AdminSeeder::class,
            DoctorSeeder::class,
            DoctorUserSeeder::class,
        ]);
    }
}
