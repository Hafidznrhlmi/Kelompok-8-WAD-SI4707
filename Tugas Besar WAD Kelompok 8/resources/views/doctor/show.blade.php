@extends('layouts.doctor')

@section('content')
<div class="container mt-4">
    <h2>Detail Rekam Medis</h2>
    <div class="row">
        <!-- Kiri -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr><th>Nomor Rekam Medis</th><td>{{ $rekamMedi->id }}</td></tr>
                <tr><th>Nama Pasien</th><td>{{ $rekamMedi->nama_pasien }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $rekamMedi->jenis_kelamin }}</td></tr>
                <tr><th>Usia</th><td>{{ $rekamMedi->usia }}</td></tr>
                <tr><th>Nomor Telepon</th><td>{{ $rekamMedi->no_telp }}</td></tr>
                <tr><th>Golongan Darah</th><td>{{ $rekamMedi->golongan_darah }}</td></tr>
                <tr><th>Riwayat Alergi</th><td>{{ $rekamMedi->riwayat_alergi }}</td></tr>
            </table>
        </div>

        <!-- Kanan -->
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr><th>Tanggal</th><td>{{ $rekamMedi->tanggal }}</td></tr>
                <tr><th>Keluhan</th><td>{{ $rekamMedi->keluhan }}</td></tr>
                <tr><th>Diagnosa</th><td>{{ $rekamMedi->diagnosa }}</td></tr>
                <tr><th>Tindakan</th><td>{{ $rekamMedi->tindakan }}</td></tr>
                <tr><th>Obat yang Diberikan</th><td>{{ $rekamMedi->obat_diberikan }}</td></tr>
                <tr><th>Catatan Dokter</th><td>{{ $rekamMedi->catatan_dokter }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection
