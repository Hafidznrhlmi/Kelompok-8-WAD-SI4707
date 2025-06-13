@extends('layout')

@section('title', 'Detail Janji Temu')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">Konfirmasi Janji Temu</h4>
        </div>
        <div class="card-body text-center">
            <div class="alert alert-success">
                <h5>Janji temu Anda dengan {{ $appointment->doctor->name }} telah dijadwalkan.</h5>
            </div>
            
            <div class="mb-4">
                <h2 class="display-1">{{ $appointment->queue_number }}</h2>
                <p class="text-muted">Nomor Antrian</p>
            </div>
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Dokter:</strong> {{ $appointment->doctor->name }}</p>
                    <p><strong>Spesialisasi:</strong> {{ $appointment->doctor->specialization }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tanggal & Waktu:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->isoFormat('dddd, D MMMM Y') }} - {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }} WIB</p>
                    <p><strong>Pasien:</strong> {{ $appointment->patient_name }}</p>
                </div>
            </div>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                </a>
                <a href="#" class="btn btn-custom-red">
                    <i class="bi bi-person-badge"></i> Lihat Profil Dokter
                </a>
            </div>
        </div>
    </div>
@endsection