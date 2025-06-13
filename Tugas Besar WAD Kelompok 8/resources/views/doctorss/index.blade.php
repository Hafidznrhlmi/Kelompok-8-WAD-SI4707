@extends('layout')

@section('title', 'Daftar Dokter')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="border-bottom pb-2 mb-4">Daftar Dokter Spesialis</h2>
        </div>
    </div>

    <div class="row">
        @foreach($doctors as $doctor)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="rounded-circle bg-danger bg-opacity-10 mx-auto mb-3 d-flex align-items-center justify-content-center" 
                             style="width: 80px; height: 80px;">
                            <i class="bi bi-person-badge text-danger display-6"></i>
                        </div>
                        <h5 class="card-title">{{ $doctor->name }}</h5>
                        <p class="text-danger mb-2">{{ $doctor->specialization }}</p>
                    </div>
                    
                    <div class="text-center mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 mb-2 d-block">
                            <i class="bi bi-clock-fill me-1"></i>
                            Jam Praktik: {{ $doctor->formatted_practice_hours }}
                        </span>
                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 d-block">
                            <i class="bi bi-calendar-check-fill me-1"></i>
                            Hari Praktik: {{ $doctor->practice_days }}
                        </span>
                    </div>
                    
                    <p class="card-text text-muted mb-4">{{ $doctor->short_description }}</p>
                    
                    <div class="text-center">
                        <a href="{{ route('doctorss.show', $doctor) }}" class="btn btn-outline-danger">
                            <i class="bi bi-info-circle"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($doctors->isEmpty())
    <div class="alert alert-info text-center">
        <i class="bi bi-info-circle me-2"></i>Tidak ada dokter yang tersedia saat ini.
    </div>
    @endif
</div>
@endsection 