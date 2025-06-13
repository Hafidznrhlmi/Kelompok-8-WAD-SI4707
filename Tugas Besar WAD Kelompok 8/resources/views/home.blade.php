@extends('layout')

@section('title', 'Selamat Datang di TELKOMEDIKA')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section bg-light rounded-3 p-4 p-md-5 mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold text-danger mb-4">Layanan Kesehatan Terpercaya</h1>
                <p class="lead mb-4">Buat janji temu dengan dokter spesialis terbaik kami untuk pelayanan kesehatan yang optimal.</p>
                @if(Auth::check() && Auth::user()->role === 'patient')
                    <a href="{{ route('appointments.create') }}" class="btn btn-custom-red btn-lg">
                        <i class="bi bi-calendar-plus"></i> Buat Janji Temu
                    </a>
                @endif
            </div>
            <div class="col-md-6 text-center mt-4 mt-md-0">
                <img src="{{ asset('images/telmed.png') }}" 
                     alt="Telkomedika Illustration" 
                     class="img-fluid rounded-3 shadow-sm" 
                     style="max-width: 400px;">
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="border-bottom pb-2 mb-4">Layanan Kami</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-danger border-top-0 border-end-0 border-bottom-0 border-4">
                <div class="card-body">
                    <div class="text-danger mb-3">
                        <i class="bi bi-calendar-check display-5"></i>
                    </div>
                    <h5 class="card-title">Janji Temu Online</h5>
                    <p class="card-text">Buat janji temu dengan dokter secara online tanpa perlu antri di tempat.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-danger border-top-0 border-end-0 border-bottom-0 border-4">
                <div class="card-body">
                    <div class="text-danger mb-3">
                        <i class="bi bi-person-badge display-5"></i>
                    </div>
                    <h5 class="card-title">Dokter Spesialis</h5>
                    <p class="card-text">Konsultasi dengan dokter spesialis berpengalaman sesuai kebutuhan Anda.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-danger border-top-0 border-end-0 border-bottom-0 border-4">
                <div class="card-body">
                    <div class="text-danger mb-3">
                        <i class="bi bi-clock-history display-5"></i>
                    </div>
                    <h5 class="card-title">Jam Praktik Fleksibel</h5>
                    <p class="card-text">Tersedia layanan dari pukul 09:00 hingga 20:00 setiap hari.</p>
                </div>
            </div>
        </div>
    </div>


    <!-- CTA Section -->
    <div class="bg-danger bg-opacity-10 rounded-3 p-4 p-md-5 text-center mb-4">
        <h2 class="text-danger mb-4">Butuh Konsultasi Kesehatan?</h2>
        <p class="lead mb-4">Jangan ragu untuk membuat janji temu dengan dokter spesialis kami.</p>
        @if(Auth::check() && Auth::user()->role === 'patient')
            <a href="{{ route('appointments.create') }}" class="btn btn-custom-red btn-lg">
                <i class="bi bi-calendar-plus"></i> Buat Janji Temu Sekarang
            </a>
        @endif
    </div>

    <!-- Emergency Contact -->
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <i class="bi bi-telephone-fill me-2"></i>
        <div>
            <strong>Nomor Darurat:</strong> (237) 681-892-255 - Tersedia 24 Jam
        </div>
    </div>

    <div class="d-flex flex-wrap gap-3 justify-content-center my-4">
        <a href="{{ route('medical-records.index') }}" class="btn btn-custom-red btn-lg d-flex align-items-center" style="min-width: 250px;">
            <i class="bi bi-journal-medical me-2" style="font-size: 2rem;"></i>
            Rekam Medis
        </a>
        <!-- Tambahkan tombol lain sesuai kebutuhan dokter -->
    </div>
@endsection 