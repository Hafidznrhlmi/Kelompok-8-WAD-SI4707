@extends('layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Rekam Medis</h4>
                    @if(Auth::user()->role === 'doctor' && Auth::id() === $medical_record->doctor_id)
                    <a href="{{ route('medical-records.edit', $medical_record) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Edit
                    </a>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="text-muted">Informasi Pasien</h5>
                            <p class="mb-1"><strong>Nama:</strong> {{ $medical_record->patient->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $medical_record->patient->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted">Informasi Dokter</h5>
                            <p class="mb-1"><strong>Nama:</strong> {{ $medical_record->doctor->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $medical_record->doctor->email }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Tanggal Pemeriksaan</h5>
                        <p>{{ $medical_record->record_date->format('d F Y') }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Diagnosis</h5>
                        <p>{{ $medical_record->diagnosis }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-muted">Tindakan/Pengobatan</h5>
                        <p>{{ $medical_record->treatment }}</p>
                    </div>

                    @if($medical_record->prescription)
                    <div class="mb-4">
                        <h5 class="text-muted">Resep Obat</h5>
                        <p>{{ $medical_record->prescription }}</p>
                    </div>
                    @endif

                    @if($medical_record->notes)
                    <div class="mb-4">
                        <h5 class="text-muted">Catatan Tambahan</h5>
                        <p>{{ $medical_record->notes }}</p>
                    </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('medical-records.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                        @if(Auth::user()->role === 'doctor' && Auth::id() === $medical_record->doctor_id)
                        <form action="{{ route('medical-records.destroy', $medical_record) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rekam medis ini?')">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 