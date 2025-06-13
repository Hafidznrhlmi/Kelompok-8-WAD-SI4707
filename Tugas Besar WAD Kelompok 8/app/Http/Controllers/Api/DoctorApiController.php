<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorApiController extends Controller
{
    public function getDoctors()
    {
        try {
            $doctors = [
                [
                    'name' => 'Dr. John Smith',
                    'email' => 'john.smith@hospital.com',
                    'picture' => 'https://randomuser.me/api/portraits/men/1.jpg',
                    'specialty' => 'Cardiologist',
                    'available' => true
                ],
                [
                    'name' => 'Dr. Sarah Johnson',
                    'email' => 'sarah.johnson@hospital.com',
                    'picture' => 'https://randomuser.me/api/portraits/women/1.jpg',
                    'specialty' => 'Pediatrician',
                    'available' => true
                ],
                [
                    'name' => 'Dr. Michael Brown',
                    'email' => 'michael.brown@hospital.com',
                    'picture' => 'https://randomuser.me/api/portraits/men/2.jpg',
                    'specialty' => 'Neurologist',
                    'available' => false
                ],
                [
                    'name' => 'Dr. Emily Davis',
                    'email' => 'emily.davis@hospital.com',
                    'picture' => 'https://randomuser.me/api/portraits/women/2.jpg',
                    'specialty' => 'Dermatologist',
                    'available' => true
                ],
                [
                    'name' => 'Dr. James Wilson',
                    'email' => 'james.wilson@hospital.com',
                    'picture' => 'https://randomuser.me/api/portraits/men/3.jpg',
                    'specialty' => 'Psychiatrist',
                    'available' => false
                ]
            ];

            return response()->json([
                'success' => true,
                'data' => $doctors
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
} 