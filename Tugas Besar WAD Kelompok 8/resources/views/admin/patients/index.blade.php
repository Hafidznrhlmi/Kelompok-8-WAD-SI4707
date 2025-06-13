@extends('layout')

@section('title', 'Manajemen Pasien')

@section('content')
<div class="container py-4">
    <div class="row mb-4 align-items-center">
        <div class="col">
            <h1 class="h3 mb-0 text-gray-800">Manajemen Pasien</h1>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patients as $patient)
                            <tr>
                                <td>
                                    <img src="{{ $patient->profile_photo_url }}" 
                                         alt="{{ $patient->name }}" 
                                         class="rounded-circle"
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->phone_number ?? '-' }}</td>
                                <td>{{ $patient->gender ? ucfirst($patient->gender) : '-' }}</td>
                                <td>{{ $patient->date_of_birth ? $patient->date_of_birth->format('d/m/Y') : '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.patients.edit', $patient) }}" 
                                           class="btn btn-sm btn-custom-red"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.patients.destroy', $patient) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini? Semua data terkait pasien ini akan dihapus.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-sm btn-custom-red"
                                                    title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bi bi-person-x text-danger mb-2" style="font-size: 2rem;"></i>
                                        <h5 class="mb-0">Belum ada data pasien</h5>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.btn-custom-red {
    background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
    border: none;
    color: white;
    margin: 0 1px;
    transition: all 0.3s ease;
}

.btn-custom-red:hover {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
    transform: translateY(-2px);
    box-shadow: 0 3px 10px rgba(255, 65, 108, 0.2);
    color: white;
}

.btn-group .btn:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
}

.btn-group .btn:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 4px;
}
</style>
@endsection 