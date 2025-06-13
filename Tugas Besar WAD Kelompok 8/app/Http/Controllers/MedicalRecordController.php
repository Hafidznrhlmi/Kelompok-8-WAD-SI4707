<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalRecordController extends Controller
{
    public function __construct()
    {
        // Middleware sudah didefinisikan di routes/web.php
    }

    public function index()
    {
        $user = Auth::user();
        $records = MedicalRecord::when($user->role === 'patient', function ($query) use ($user) {
            return $query->where('patient_id', $user->id);
        })
        ->when($user->role === 'doctor', function ($query) use ($user) {
            return $query->where('doctor_id', $user->id);
        })
        ->with(['patient', 'doctor'])
        ->latest('record_date')
        ->paginate(10);

        return view('medical_records.index', compact('records'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'doctor') {
            abort(403, 'Only doctors can create medical records.');
        }

        $patients = User::where('role', 'patient')->get();
        return view('medical_records.create', compact('patients'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'doctor') {
            abort(403, 'Only doctors can create medical records.');
        }

        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'record_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $validated['doctor_id'] = Auth::id();

        MedicalRecord::create($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'Rekam medis berhasil dibuat.');
    }

    public function show(MedicalRecord $medical_record)
    {
        $user = Auth::user();
        if ($user->role === 'patient' && $medical_record->patient_id !== $user->id) {
            abort(403);
        }
        if ($user->role === 'doctor' && $medical_record->doctor_id !== $user->id) {
            abort(403);
        }

        return view('medical_records.show', compact('medical_record'));
    }

    public function edit(MedicalRecord $medical_record)
    {
        if (Auth::user()->role !== 'doctor' || $medical_record->doctor_id !== Auth::id()) {
            abort(403, 'Only the doctor who created this record can edit it.');
        }

        $patients = User::where('role', 'patient')->get();
        return view('medical_records.edit', compact('medical_record', 'patients'));
    }

    public function update(Request $request, MedicalRecord $medical_record)
    {
        if (Auth::user()->role !== 'doctor' || $medical_record->doctor_id !== Auth::id()) {
            abort(403, 'Only the doctor who created this record can update it.');
        }

        $validated = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'record_date' => 'required|date',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $medical_record->update($validated);

        return redirect()->route('medical-records.index')
            ->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy(MedicalRecord $medical_record)
    {
        if (Auth::user()->role !== 'doctor' || $medical_record->doctor_id !== Auth::id()) {
            abort(403, 'Only the doctor who created this record can delete it.');
        }

        $medical_record->delete();

        return redirect()->route('medical-records.index')
            ->with('success', 'Rekam medis berhasil dihapus.');
    }
} 