@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $user->profile_photo_url }}" 
                             alt="{{ $user->name }}" 
                             class="rounded-circle img-thumbnail"
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h3 class="mt-3">{{ $user->name }}</h3>
                        <span class="badge bg-danger">{{ ucfirst($user->role) }}</span>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Informasi Pribadi</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ $user->email }}</dd>

                                <dt class="col-sm-4">No. Telepon</dt>
                                <dd class="col-sm-8">{{ $user->phone_number ?? '-' }}</dd>

                                <dt class="col-sm-4">Jenis Kelamin</dt>
                                <dd class="col-sm-8">{{ $user->gender ? ucfirst($user->gender) : '-' }}</dd>

                                <dt class="col-sm-4">Tanggal Lahir</dt>
                                <dd class="col-sm-8">
                                    {{ $user->date_of_birth ? $user->date_of_birth->format('d F Y') : '-' }}
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h5 class="border-bottom pb-2">Informasi Tambahan</h5>
                            <dl class="row">
                                <dt class="col-sm-4">Alamat</dt>
                                <dd class="col-sm-8">{{ $user->address ?? '-' }}</dd>

                                <dt class="col-sm-4">Bio</dt>
                                <dd class="col-sm-8">{{ $user->bio ?? '-' }}</dd>
                            </dl>
                        </div>
                    </div>

                    @if($user->isDoctor() && $user->doctor)
                        <div class="mt-4">
                            <h5 class="border-bottom pb-2">Informasi Dokter</h5>
                            <dl class="row">
                                <dt class="col-sm-3">Spesialisasi</dt>
                                <dd class="col-sm-9">{{ $user->doctor->specialization }}</dd>

                                <dt class="col-sm-3">Pengalaman</dt>
                                <dd class="col-sm-9">{{ $user->doctor->experience }} tahun</dd>

                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9">
                                    <span class="badge bg-{{ $user->doctor->status === 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($user->doctor->status) }}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    @endif

                    <div class="text-center mt-4">
                        <a href="{{ route('profile.edit') }}" class="btn btn-danger">
                            <i class="bi bi-pencil-square me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 