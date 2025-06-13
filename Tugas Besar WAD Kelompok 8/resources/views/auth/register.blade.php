@extends('layout')

@section('title', 'Register')

@section('content')
<style>
.auth-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
    padding: 50px 15px;
}

.auth-card {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.auth-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
}

.auth-header {
    background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    padding: 20px;
    text-align: center;
    font-size: 24px;
    font-weight: 600;
    letter-spacing: 1px;
}

.auth-form {
    padding: 30px;
}

.form-control {
    border-radius: 10px;
    padding: 12px;
    border: 2px solid #eee;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #ff416c;
    box-shadow: 0 0 0 0.2rem rgba(255, 65, 108, 0.25);
}

.btn-auth {
    background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
    border: none;
    border-radius: 10px;
    color: white;
    padding: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
    color: white;
}

.auth-footer {
    text-align: center;
    margin-top: 20px;
}

.auth-footer a {
    color: #ff416c;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.auth-footer a:hover {
    color: #ff4b2b;
}

.floating-label {
    position: relative;
    margin-bottom: 20px;
}

.floating-label label {
    position: absolute;
    top: 50%;
    left: 15px;
    transform: translateY(-50%);
    background: white;
    padding: 0 5px;
    color: #666;
    transition: all 0.3s ease;
    pointer-events: none;
}

.floating-label input:focus ~ label,
.floating-label input:not(:placeholder-shown) ~ label {
    top: 0;
    font-size: 12px;
    color: #ff416c;
}

.auth-icon {
    font-size: 48px;
    color: white;
    margin-bottom: 10px;
}

.register-benefits {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 15px;
    padding: 20px;
    color: white;
    margin-bottom: 30px;
}

.benefit-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.benefit-item i {
    margin-right: 10px;
    font-size: 20px;
}
</style>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-4">
                    <i class="bi bi-hospital auth-icon"></i>
                    <h2 class="text-white mb-0">Klinik Kesehatan</h2>
                    <p class="text-white-50">Buat akun baru untuk mengakses layanan kami</p>
                </div>

                <div class="register-benefits">
                    <h4 class="mb-3">Keuntungan Mendaftar:</h4>
                    <div class="benefit-item">
                        <i class="bi bi-calendar-check"></i>
                        <span>Buat janji temu dengan dokter secara online</span>
                    </div>
                    <div class="benefit-item">
                        <i class="bi bi-clock-history"></i>
                        <span>Lihat riwayat kunjungan medis Anda</span>
                    </div>
                    <div class="benefit-item">
                        <i class="bi bi-bell"></i>
                        <span>Dapatkan pengingat jadwal konsultasi</span>
                    </div>
                </div>
                
                <div class="auth-card">
                    <div class="auth-header">
                        <i class="bi bi-person-plus-fill me-2"></i>Register
                    </div>
                    <div class="auth-form">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="floating-label">
                                <input id="name" type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       required autocomplete="name" placeholder=" ">
                                <label for="name">Nama Lengkap</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="floating-label">
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" 
                                       required autocomplete="email" placeholder=" ">
                                <label for="email">Email Address</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="floating-label">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required 
                                       autocomplete="new-password" placeholder=" ">
                                <label for="password">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="floating-label">
                                <input id="password_confirmation" type="password" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       name="password_confirmation" required 
                                       autocomplete="new-password" placeholder=" ">
                                <label for="password_confirmation">Konfirmasi Password</label>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-auth">
                                    <i class="bi bi-person-plus-fill me-2"></i>Register
                                </button>
                            </div>
                        </form>

                        <div class="auth-footer">
                            <p class="mb-0">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 