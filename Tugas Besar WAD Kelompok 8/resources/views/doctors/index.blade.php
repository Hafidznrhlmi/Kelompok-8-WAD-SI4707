@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('doctors.index') }}" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           value="{{ $search ?? '' }}"
                           placeholder="Cari dokter berdasarkan nama atau spesialisasi...">
                    <button type="submit" class="btn btn-primary">
                        Cari
                    </button>
                    @if($search)
                        <a href="{{ route('doctors.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @if(count($doctors) > 0)
            @foreach($doctors as $doctor)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <img src="{{ $doctor['picture'] }}" 
                                 class="card-img-top" 
                                 alt="{{ $doctor['name'] }}" 
                                 style="height: 200px; object-fit: cover;">
                            <span class="position-absolute top-0 end-0 m-2 badge {{ $doctor['available'] ? 'bg-success' : 'bg-danger' }}">
                                {{ $doctor['available'] ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $doctor['name'] }}</h5>
                            <p class="card-text">
                                <span class="d-block mb-2">
                                    <i class="bi bi-hospital me-2"></i>
                                    <strong>Spesialisasi:</strong> {{ $doctor['specialty'] }}
                                </span>
                                <span class="d-block mb-3">
                                    <i class="bi bi-envelope me-2"></i>
                                    <strong>Email:</strong> {{ $doctor['email'] }}
                                </span>
                            </p>
                            @if($doctor['available'])
                                <a href="{{ route('appointments.create', ['doctor' => $doctor['name']]) }}" 
                                   class="btn btn-primary w-100">
                                    <i class="bi bi-calendar-plus me-2"></i>Buat Janji
                                </a>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    <i class="bi bi-x-circle me-2"></i>Tidak Tersedia
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    @if($search)
                        Tidak ada dokter yang sesuai dengan pencarian "{{ $search }}".
                    @else
                        Tidak ada dokter yang tersedia saat ini.
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 