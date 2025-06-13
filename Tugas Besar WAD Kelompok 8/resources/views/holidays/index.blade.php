@extends('layout')

@section('title', 'Daftar Hari Libur')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="mb-1">Daftar Hari Libur</h2>
            <p class="text-muted mb-0">Informasi hari libur klinik</p>
        </div>
        @if(auth()->user()->isAdmin())
            <div class="col-md-6 text-md-end">
                <a href="{{ route('holidays.create') }}" class="btn btn-custom-red">
                    <i class="bi bi-plus-circle"></i> Tambah Hari Libur
                </a>
            </div>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($holidays->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-calendar-x display-1 text-danger"></i>
            <p class="mt-3 text-muted">Belum ada hari libur yang terdaftar</p>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('holidays.create') }}" class="btn btn-custom-red mt-2">
                    <i class="bi bi-plus-circle"></i> Tambah Hari Libur
                </a>
            @endif
        </div>
    @else
        <div class="row">
            @foreach($holidays as $holiday)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="calendar-icon bg-danger bg-opacity-10 text-danger rounded p-2 me-3">
                                    <i class="bi bi-calendar-event fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-title mb-0">{{ $holiday->title }}</h6>
                                    <small class="text-muted">{{ $holiday->date->isoFormat('dddd, D MMMM Y') }}</small>
                                </div>
                            </div>
                            
                            @if($holiday->description)
                                <p class="card-text text-muted mb-3">{{ $holiday->description }}</p>
                            @endif

                            @if(auth()->user()->isAdmin())
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('holidays.edit', $holiday) }}" 
                                       class="btn btn-outline-warning btn-sm">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('holidays.destroy', $holiday) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus hari libur ini?');"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $holidays->links() }}
        </div>
    @endif
</div>

<style>
.calendar-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
}
</style>
@endsection 