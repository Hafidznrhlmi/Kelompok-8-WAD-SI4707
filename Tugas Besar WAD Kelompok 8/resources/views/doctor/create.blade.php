@extends('layouts.doctor')

@section('content')
<div class="container mt-4">
    <h2>Input Rekam Medis</h2>
    <form action="{{ route('doctor.rekam-medis.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Kiri -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Nama Pasien</label>
                    <input type="text" name="nama_pasien" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Usia</label>
                    <input type="number" name="usia" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_telp" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Golongan Darah</label>
                    <select name="golongan_darah" class="form-control">
                        <option>A</option>
                        <option>B</option>
                        <option>AB</option>
                        <option>O</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Riwayat Alergi</label>
                    <input type="text" name="riwayat_alergi" class="form-control">
                </div>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Keluhan</label>
                    <textarea name="keluhan" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Diagnosa</label>
                    <input type="text" name="diagnosa" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Tindakan</label>
                    <textarea name="tindakan" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Obat yang Diberikan</label>
                    <textarea name="obat_diberikan" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label>Catatan Dokter</label>
                    <textarea name="catatan_dokter" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
