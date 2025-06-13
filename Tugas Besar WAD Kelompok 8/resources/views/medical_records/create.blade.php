@extends('layout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Buat Rekam Medis Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('medical-records.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="patient_id" class="form-label">Pasien</label>
                            <select name="patient_id" id="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                                <option value="">Pilih Pasien</option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="record_date" class="form-label">Tanggal Pemeriksaan</label>
                            <input type="date" class="form-control @error('record_date') is-invalid @enderror" 
                                   id="record_date" name="record_date" value="{{ old('record_date', date('Y-m-d')) }}" required>
                            @error('record_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" 
                                      id="diagnosis" name="diagnosis" rows="3" required>{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="treatment" class="form-label">Tindakan/Pengobatan</label>
                            <textarea class="form-control @error('treatment') is-invalid @enderror" 
                                      id="treatment" name="treatment" rows="3" required>{{ old('treatment') }}</textarea>
                            @error('treatment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prescription" class="form-label">Resep Obat</label>
                            <textarea class="form-control @error('prescription') is-invalid @enderror" 
                                      id="prescription" name="prescription" rows="3">{{ old('prescription') }}</textarea>
                            @error('prescription')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Catatan Tambahan</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('medical-records.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-1"></i>Simpan Rekam Medis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 