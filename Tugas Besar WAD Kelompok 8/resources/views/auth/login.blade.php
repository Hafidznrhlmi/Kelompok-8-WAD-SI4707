@extends('layout')

@section('title', 'Login')

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
</style>

<div class="auth-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <i class="bi bi-hospital auth-icon"></i>
                    <h2 class="text-white mb-0">Klinik Kesehatan</h2>
                    <p class="text-white-50">Selamat datang kembali!</p>
                </div>
                
                <div class="auth-card">
                    <div class="auth-header">
                        <i class="bi bi-person-circle me-2"></i>Login
                    </div>
                    <div class="auth-form">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

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
                                       autocomplete="current-password" placeholder=" ">
                                <label for="password">Password</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" 
                                           id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-auth">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </button>
                            </div>
                        </form>

                        <div class="auth-footer">
                            <p class="mb-0">
                                Belum punya akun? 
                                <a href="{{ route('register') }}">Register</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 