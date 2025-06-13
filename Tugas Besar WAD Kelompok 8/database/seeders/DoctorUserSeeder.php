<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DoctorUserSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'dr. Ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => 'password123',
            ],
            [
                'name' => 'dr. Siti',
                'email' => 'siti@gmail.com',
                'password' => 'password123',
            ],
            [
                'name' => 'dr. Budi',
                'email' => 'budi@gmail.com',
                'password' => 'password123',
            ],
        ];

        foreach ($doctors as $doctorData) {
            // Create user account for doctor
            $user = User::create([
                'name' => $doctorData['name'],
                'email' => $doctorData['email'],
                'password' => Hash::make($doctorData['password']),
                'role' => 'doctor',
            ]);

            // Find existing doctor profile or create new one
            $doctor = Doctor::where('name', $doctorData['name'])->first();
            
            if (!$doctor) {
                // If no existing profile, create new one
                Doctor::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'specialization' => 'Belum ditentukan',
                    'short_description' => 'Profil dokter belum lengkap',
                    'full_description' => 'Profil dokter belum lengkap',
                    'status' => 'active',
                    'joined_date' => Carbon::now(),
                ]);
            } else {
                // If profile exists, link it to the user
                $doctor->update(['user_id' => $user->id]);
            }
        }
    }
} 