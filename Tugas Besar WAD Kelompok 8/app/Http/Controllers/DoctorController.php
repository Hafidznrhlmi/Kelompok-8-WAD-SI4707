<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
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

        // Filter doctors if search term is provided
        $search = $request->input('search');
        if ($search) {
            $doctors = array_filter($doctors, function($doctor) use ($search) {
                return str_contains(strtolower($doctor['name']), strtolower($search)) ||
                       str_contains(strtolower($doctor['specialty']), strtolower($search));
            });
        }

        return view('doctors.index', compact('doctors', 'search'));
    }

    public function show(Doctor $doctor)
    {
        return view('doctorss.show', compact('doctor'));
    }
} 