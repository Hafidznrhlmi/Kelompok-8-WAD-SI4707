@extends('layout')

@section('title', 'Daftar Janji Temu')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Daftar Janji Temu</h2>
            <p class="text-muted mb-0">Kelola semua janji temu pasien</p>
        </div>
        <div>
            <a href="{{ route('appointments.create') }}" class="btn btn-custom-red">
                <i class="bi bi-calendar-plus"></i> Buat Janji Temu
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($appointments->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x display-1 text-danger"></i>
                    <p class="mt-3">Belum ada janji temu yang terdaftar</p>
                </div>
            @else
                @php
                    $currentDate = null;
                @endphp

                @foreach($appointments as $appointment)
                    @if($currentDate !== $appointment->appointment_date->format('Y-m-d'))
                        @php
                            $currentDate = $appointment->appointment_date->format('Y-m-d');
                        @endphp
                        <div class="date-header mt-4 mb-3">
                            <h5 class="border-bottom pb-2">
                                <i class="bi bi-calendar-date text-danger"></i>
                                {{ \Carbon\Carbon::parse($currentDate)->isoFormat('dddd, D MMMM Y') }}
                            </h5>
                        </div>
                    @endif

                    <div class="appointment-card mb-3 border-start border-4 border-danger rounded p-3 bg-light">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <span class="badge bg-danger">{{ $appointment->queue_number }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>{{ $appointment->patient_name }}</strong>
                                <br>
                                <small class="text-muted">
                                    <i class="bi bi-clock"></i> 
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }} WIB
                                </small>
                            </div>
                            <div class="col-md-3">
                                <i class="bi bi-person-badge"></i> {{ $appointment->doctor->name }}
                                <br>
                                <small class="text-muted">{{ $appointment->doctor->specialization }}</small>
                            </div>
                            <div class="col-md-3">
                                @if(auth()->user()->isDoctor() && auth()->id() === $appointment->doctor_id)
                                    <form action="{{ route('appointments.update-status', $appointment) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm status-select" 
                                                onchange="this.form.submit()" 
                                                style="width: auto; display: inline-block;">
                                            <option value="scheduled" {{ $appointment->status === 'scheduled' ? 'selected' : '' }}>
                                                Terjadwal
                                            </option>
                                            <option value="completed" {{ $appointment->status === 'completed' ? 'selected' : '' }}>
                                                Selesai
                                            </option>
                                            <option value="canceled" {{ $appointment->status === 'canceled' ? 'selected' : '' }}>
                                                Dibatalkan
                                            </option>
                                        </select>
                                    </form>
                                @else
                                    @if($appointment->status === 'scheduled')
                                        <span class="badge bg-danger">Terjadwal</span>
                                    @elseif($appointment->status === 'completed')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($appointment->status === 'canceled')
                                        <span class="badge bg-secondary">Dibatalkan</span>
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-2 text-end">
                                <div class="btn-group">
                                    <a href="{{ route('appointments.show', $appointment) }}" 
                                       class="btn btn-sm btn-outline-custom-red" 
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('appointments.edit', $appointment) }}" 
                                       class="btn btn-sm btn-outline-custom-red"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('appointments.destroy', $appointment) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-custom-red" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus janji temu ini?')"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-end mt-4">
                    {{ $appointments->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .status-select {
            background: transparent;
            border: 1px solid #ff416c;
            color: #ff416c;
            padding: 0.25rem 2rem 0.25rem 0.5rem;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .status-select:hover {
            background: rgba(255, 65, 108, 0.1);
        }
        .status-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(255, 65, 108, 0.25);
            border-color: #ff416c;
            outline: none;
        }
    </style>
@endsection