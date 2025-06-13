<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'patient_name' => 'required|string|max:255',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i|after:08:59|before:20:01',
            'notes' => 'nullable|string',
        ];

        // Only allow status to be changed if user is admin
        if (auth()->user()->isAdmin()) {
            $rules['status'] = 'nullable|in:scheduled,completed,canceled';
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'patient_name.required' => 'Nama pasien harus diisi',
            'doctor_id.required' => 'Silakan pilih dokter',
            'doctor_id.exists' => 'Dokter yang dipilih tidak valid',
            'appointment_date.required' => 'Tanggal appointment harus diisi',
            'appointment_date.after_or_equal' => 'Tanggal appointment tidak boleh di masa lalu',
            'appointment_time.required' => 'Waktu appointment harus diisi',
            'appointment_time.date_format' => 'Format waktu tidak valid. Gunakan format 24 jam (contoh: 14:30)',
            'appointment_time.after' => 'Waktu appointment harus setelah jam 09:00',
            'appointment_time.before' => 'Waktu appointment harus sebelum jam 20:00',
            'status.in' => 'Status yang dipilih tidak valid'
        ];
    }
} 