<?php

// app/Http/Controllers/AppointmentController.php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Http\Requests\AppointmentRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    // Read - List all appointments
    public function index()
    {
        $query = Appointment::with(['doctor', 'patient']);
        
        // If user is patient, only show their appointments
        if (auth()->user()->isPatient()) {
            $query->where('patient_id', auth()->id());
        }
        
        $appointments = $query->orderBy('appointment_date', 'asc')
                            ->orderBy('appointment_time', 'asc')
                            ->paginate(10);
                            
        return view('appointments.index', compact('appointments'));
    }

    // Create - Show form
    public function create()
    {
        $doctors = Doctor::where('status', 'active')->get();
        return view('appointments.create', compact('doctors'));
    }

    // Create - Store new appointment
    public function store(AppointmentRequest $request)
    {
        try {
            // Check if there's already an appointment for this doctor at this time
            $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->first();

            if ($existingAppointment) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Maaf, jadwal ini sudah dibooking. Silakan pilih waktu lain.');
            }

            // Get validated data
            $data = $request->validated();
            
            // Add patient_id and ensure patient_name is from authenticated user
            $data['patient_id'] = auth()->id();
            $data['patient_name'] = auth()->user()->name;
            
            // Set default status
            $data['status'] = 'scheduled';
            
            // Generate queue number
            $data['queue_number'] = $this->generateQueueNumber($data['doctor_id'], $data['appointment_date']);
            
            // Create appointment
            $appointment = Appointment::create($data);
            
            return redirect()->route('appointments.show', $appointment)
                           ->with('success', 'Janji temu berhasil dibuat! Nomor antrian Anda: ' . $data['queue_number']);
        } catch (\Exception $e) {
            Log::error('Appointment creation error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat membuat janji temu: ' . $e->getMessage());
        }
    }

    // Read - Show single appointment
    public function show(Appointment $appointment)
    {
        // Check if user is authorized to view this appointment
        if (auth()->user()->isPatient() && $appointment->patient_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('appointments.show', compact('appointment'));
    }

    // Update - Show edit form
    public function edit(Appointment $appointment)
    {
        // Check if user is authorized to edit this appointment
        if (auth()->user()->isPatient() && $appointment->patient_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $doctors = Doctor::where('status', 'active')->get();
        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    // Update - Process edit
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        try {
            // Check if user is authorized to update this appointment
            if (auth()->user()->isPatient() && $appointment->patient_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
            
            // Check if there's already an appointment for this doctor at this time (excluding current appointment)
            $existingAppointment = Appointment::where('doctor_id', $request->doctor_id)
                ->where('appointment_date', $request->appointment_date)
                ->where('appointment_time', $request->appointment_time)
                ->where('id', '!=', $appointment->id)
                ->first();

            if ($existingAppointment) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Maaf, jadwal ini sudah dibooking. Silakan pilih waktu lain.');
            }
            
            $data = $request->validated();
            
            // Ensure patient_id and name remain unchanged
            $data['patient_id'] = $appointment->patient_id;
            $data['patient_name'] = $appointment->patient_name;
            
            // Only allow admin or the assigned doctor to update status
            if (!auth()->user()->isAdmin() && 
                !(auth()->user()->isDoctor() && auth()->id() === $appointment->doctor_id)) {
                unset($data['status']);
            }
            
            // Only regenerate queue number if doctor or date changed
            if ($appointment->doctor_id != $data['doctor_id'] || $appointment->appointment_date != $data['appointment_date']) {
                $data['queue_number'] = $this->generateQueueNumber($data['doctor_id'], $data['appointment_date']);
            }
            
            $appointment->update($data);
            
            return redirect()->route('appointments.show', $appointment)
                           ->with('success', 'Janji temu berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Appointment update error: ' . $e->getMessage());
            return redirect()->back()
                           ->withInput()
                           ->with('error', 'Terjadi kesalahan saat memperbarui janji temu: ' . $e->getMessage());
        }
    }

    // Delete - Remove appointment
    public function destroy(Appointment $appointment)
    {
        try {
            // Check if user is authorized to delete this appointment
            if (auth()->user()->isPatient() && $appointment->patient_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }
            
            $appointment->delete();
            return redirect()->route('appointments.index')
                           ->with('success', 'Janji temu berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Appointment deletion error: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menghapus janji temu: ' . $e->getMessage());
        }
    }

    // Helper method to generate queue number
    private function generateQueueNumber($doctorId, $appointmentDate)
    {
        // Get the last appointment for this doctor and date
        $lastAppointment = Appointment::where('doctor_id', $doctorId)
                                    ->where('appointment_date', $appointmentDate)
                                    ->orderBy('queue_number', 'desc')
                                    ->first();

        if (!$lastAppointment) {
            // If no appointments exist for this doctor and date, start with 001
            return '001';
        }

        // Get the last queue number and increment it
        $nextNumber = intval($lastAppointment->queue_number) + 1;
        
        // Format back to 3 digits
        return str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    // API - Get all appointments
    public function apiIndex()
    {
        $appointments = Appointment::with(['doctor', 'patient'])->get();
        return response()->json($appointments);
    }

    // API - Get single appointment
    public function apiShow(Appointment $appointment)
    {
        return response()->json($appointment->load(['doctor', 'patient']));
    }

    // Update appointment status
    public function updateStatus(Request $request, Appointment $appointment)
    {
        try {
            // Check if user is authorized to update this appointment's status
            if (!auth()->user()->isDoctor() || auth()->id() !== $appointment->doctor_id) {
                abort(403, 'Unauthorized action.');
            }

            // Validate the status
            $request->validate([
                'status' => 'required|in:scheduled,completed,canceled'
            ]);

            $appointment->update([
                'status' => $request->status
            ]);

            return redirect()->back()
                           ->with('success', 'Status janji temu berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Appointment status update error: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat memperbarui status janji temu.');
        }
    }
}