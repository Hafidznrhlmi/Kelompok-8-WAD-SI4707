@extends('layout')

@section('content')
<style>
.btn-pink {
    color: #fff;
    background-color: #FF69B4;
    border-color: #FF69B4;
}

.btn-pink:hover {
    color: #fff;
    background-color: #FF1493;
    border-color: #FF1493;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Dokter</h5>
                    <a href="{{ route('admin.doctorss.create') }}" class="btn btn-danger">Tambah Dokter</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Spesialisasi</th>
                                    <th>Status</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($doctors as $doctor)
                                    <tr>
                                        <td>{{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}</td>
                                        <td>{{ $doctor->name }}</td>
                                        <td>{{ $doctor->specialization }}</td>
                                        <td>
                                            <span class="badge bg-{{ $doctor->status === 'active' ? 'success' : 'danger' }}">
                                                {{ $doctor->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td>{{ $doctor->joined_date }}</td>
                                        <td>
                                            <a href="{{ route('admin.doctorss.edit', $doctor) }}" class="btn btn-sm btn-pink">Edit</a>
                                            <form action="{{ route('admin.doctorss.destroy', $doctor) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dokter ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data dokter</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>
                            Menampilkan {{ $doctors->firstItem() ?? 0 }} sampai {{ $doctors->lastItem() ?? 0 }} dari {{ $doctors->total() }} data
                        </div>
                        <div>
                            {{ $doctors->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 