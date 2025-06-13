<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'full_description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'joined_date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama dokter harus diisi',
            'specialization.required' => 'Spesialisasi harus diisi',
            'short_description.required' => 'Deskripsi singkat harus diisi',
            'full_description.required' => 'Deskripsi lengkap harus diisi',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status tidak valid',
            'joined_date.required' => 'Tanggal bergabung harus diisi',
            'joined_date.date' => 'Format tanggal tidak valid'
        ];
    }
} 