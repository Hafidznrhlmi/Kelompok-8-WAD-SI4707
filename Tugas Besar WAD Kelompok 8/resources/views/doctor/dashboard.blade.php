@extends('layouts.doctor')
@section('content')
<h2>Rekam Medis Saya</h2>
<a href="{{ route('doctor.rekam-medis.create') }}" class="btn btn-primary">Tambah Rekam Medis</a>
<table class="table">
  <thead>
    <tr>
      <th>Nama Pasien</th>
      <th>Diagnosa</th>
      <th>Obat</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($rekamMedis as $data)
    <tr>
      <td>{{ $data->nama_pasien }}</td>
      <td>{{ $data->diagnosa }}</td>
      <td>{{ $data->obat_diberikan }}</td>
      <td>
        <a href="{{ route('doctor.rekam-medis.show', $data->id) }}">Detail</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
