@extends('layout')

@section('title', $doctor->name)

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Doctor Profile Header -->
                <div class="col-md-12 text-center mb-4">
                    <div class="rounded-circle bg-danger bg-opacity-10 mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px;">
                        <i class="bi bi-person-badge text-danger display-3"></i>
                    </div>
                    <h2 class="mb-1">{{ $doctor->name }}</h2>
                    <p class="text-danger mb-3">{{ $doctor->specialization }}</p>
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                            <i class="bi bi-clock-fill me-1"></i>
                            Praktik: 09:00 - 20:00
                        </span>
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                            <i class="bi bi-calendar-check-fill me-1"></i>
                            Bergabung sejak {{ \Carbon\Carbon::parse($doctor->joined_date)->format('Y') }}
                        </span>
                    </div>
                </div>

                <!-- Doctor Description -->
                <div class="col-md-12">
                    <div class="card border-0 bg-danger bg-opacity-10">
                        <div class="card-body">
                            <h5 class="card-title text-danger mb-3">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Tentang Dokter
                            </h5>
                            <p class="card-text">{{ $doctor->full_description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    @auth
                        <a href="{{ route('appointments.create') }}" class="btn btn-danger me-2">
                            <i class="bi bi-calendar-plus me-1"></i>
                            Buat Janji Temu
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-danger me-2">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Login untuk Buat Janji
                        </a>
                    @endauth
                    
                    <a href="{{ route('doctorss.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali ke Daftar Dokter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 