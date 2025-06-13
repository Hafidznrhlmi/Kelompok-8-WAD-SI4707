@extends('layout')

@section('title', 'Buat Janji Temu')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Book an Appointment</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="patient_name" class="form-label">Nama Pasien</label>
                    <input type="text" 
                           class="form-control @error('patient_name') is-invalid @enderror" 
                           id="patient_name" 
                           name="patient_name" 
                           value="{{ auth()->user()->name }}"
                           readonly>
                    @error('patient_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="doctor_id" class="form-label">Pilih Dokter</label>
                    <select class="form-select @error('doctor_id') is-invalid @enderror" 
                            id="doctor_id" 
                            name="doctor_id" 
                            required>
                        <option value="">-- Pilih Dokter Spesialis --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }} - {{ $doctor->specialization }}
                            </option>
                        @endforeach
                    </select>
                    @error('doctor_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="appointment_date" class="form-label">Tanggal</label>
                        <input type="date" 
                               class="form-control @error('appointment_date') is-invalid @enderror" 
                               id="appointment_date" 
                               name="appointment_date" 
                               min="{{ date('Y-m-d') }}" 
                               value="{{ old('appointment_date') }}"
                               required>
                        @error('appointment_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="appointment_time" class="form-label">Waktu</label>
                        <input type="time" 
                               class="form-control @error('appointment_time') is-invalid @enderror" 
                               id="appointment_time" 
                               name="appointment_time" 
                               min="09:00" 
                               max="20:00" 
                               value="{{ old('appointment_time') }}"
                               required>
                        @error('appointment_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="notes" class="form-label">Catatan (Opsional)</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" 
                              name="notes" 
                              rows="3">{{ old('notes') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom-red">
                        <i class="bi bi-calendar-check"></i> Buat Janji Temu
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection