@extends('layout')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Rekam Medis</h2>
        </div>
        <div class="col-md-6 text-end">
            @if(Auth::user()->role === 'doctor')
            <a href="{{ route('medical-records.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Buat Rekam Medis
            </a>
            @endif
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            @if(Auth::user()->role === 'doctor')
                                <th>Pasien</th>
                            @else
                                <th>Dokter</th>
                            @endif
                            <th>Diagnosis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($records as $record)
                        <tr>
                            <td>{{ $record->record_date->format('d/m/Y') }}</td>
                            @if(Auth::user()->role === 'doctor')
                                <td>{{ $record->patient->name }}</td>
                            @else
                                <td>{{ $record->doctor->name }}</td>
                            @endif
                            <td>{{ Str::limit($record->diagnosis, 50) }}</td>
                            <td>
                                <a href="{{ route('medical-records.show', $record) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if(Auth::user()->role === 'doctor' && Auth::id() === $record->doctor_id)
                                <a href="{{ route('medical-records.edit', $record) }}" class="btn btn-sm btn-warning text-white">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('medical-records.destroy', $record) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus rekam medis ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada rekam medis</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-4">
                {{ $records->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 