<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::where('role', 'patient')
                       ->orderBy('name')
                       ->paginate(10);
        return view('admin.patients.index', compact('patients'));
    }

    public function edit(User $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, User $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $patient->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'bio' => 'nullable|string|max:1000',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')
                        ->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(User $patient)
    {
        // Delete profile photo if exists
        if ($patient->profile_photo) {
            Storage::disk('public')->delete($patient->profile_photo);
        }

        // Delete related appointments
        $patient->appointments()->delete();

        // Delete the patient
        $patient->delete();

        return redirect()->route('admin.patients.index')
                        ->with('success', 'Pasien berhasil dihapus!');
    }
} 