<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TELEKOMEDIKA') - TELEKOMEDIKA</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
        }
        .bg-custom-red {
            background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%) !important;
        }
        .btn-custom-red {
            background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-custom-red:hover {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 65, 108, 0.4);
            color: white;
        }
        .btn-outline-custom-red {
            color: #fff;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }
        .btn-outline-custom-red:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: #fff;
            color: white;
            transform: translateY(-2px);
        }
        .navbar-nav-link {
            color: white !important;
            position: relative;
            text-decoration: none;
            padding: 5px 0;
            transition: all 0.3s ease;
        }
        .navbar-nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: white;
            transition: width 0.3s ease;
        }
        .navbar-nav-link:hover::after {
            width: 100%;
        }
        .navbar-nav-link:hover {
            transform: translateY(-2px);
        }
        .dropdown-menu {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }
        .dropdown-item {
            transition: all 0.3s ease;
        }
        .dropdown-item:hover {
            background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
            color: white;
            transform: translateX(5px);
        }
        .nav-profile-img {
            width: 32px;
            height: 32px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
        }
        .nav-profile-img:hover {
            border-color: white;
            transform: scale(1.1);
        }
        .appointment-card .btn-outline-custom-red {
            color: #ff416c;
            border: 1px solid #ff416c;
            margin: 0 2px;
            padding: 0.25rem 0.5rem;
        }
        .appointment-card .btn-outline-custom-red:hover {
            background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%);
            border-color: transparent;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(255, 65, 108, 0.2);
        }
        .appointment-card .btn-group {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-radius: 0.25rem;
        }
        .appointment-card .btn-group .btn:first-child {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }
        .appointment-card .btn-group .btn:last-child {
            border-top-right-radius: 0.25rem;
            border-bottom-right-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="bg-white">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center py-3">
                    <h1 class="mb-0" style="background: linear-gradient(135deg, #ff4b2b 0%, #ff416c 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">TELKOMEDIKA</h1>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="bi bi-telephone-fill" style="color: #ff416c"></i>
                            <strong style="color: #ff416c">EMERGENCY</strong><br>
                            <span style="color: #ff4b2b">(237) 681-892-255</span>
                        </div>
                        <div class="me-4">
                            <i class="bi bi-clock-fill" style="color: #ff416c"></i>
                            <strong style="color: #ff416c">WORK HOUR</strong><br>
                            <span style="color: #ff4b2b">09:00 - 20:00 Everyday</span>
                        </div>
                        <div>
                            <i class="bi bi-geo-alt-fill" style="color: #ff416c"></i>
                            <strong style="color: #ff416c">LOCATION</strong><br>
                            <span style="color: #ff4b2b">0123 Some Place</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="bg-custom-red py-2 shadow-sm">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="/" class="navbar-nav-link me-3">Home</a>
                        <a href="{{ route('doctors.index') }}" class="navbar-nav-link me-3">Doctors</a>
                        @auth
                            <a href="{{ route('appointments.index') }}" class="navbar-nav-link me-3">Appointments</a>
                            <a href="{{ route('holidays.index') }}" class="navbar-nav-link me-3">Holidays</a>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.obat.index') }}" class="navbar-nav-link me-3">
                                    Stok Obat
                                </a>
                            @endif
                            @if(Auth::user()->role === 'doctor')
                                <a href="{{ route('medical-records.index') }}" class="navbar-nav-link me-3">
                                    <i class="bi bi-journal-medical me-1"></i>Rekam Medis
                                </a>
                            @endif
                        @endauth
                    </div>
                    <div>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-custom-red me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-custom-red">
                                <i class="bi bi-person-plus"></i> Register
                            </a>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-custom-red dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ Auth::user()->profile_photo_url }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="rounded-circle nav-profile-img me-2">
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->isAdmin())
                                        <span class="badge bg-white text-danger ms-1">Admin</span>
                                    @endif
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                                            <i class="bi bi-person-circle me-2"></i>Profil Saya
                                        </a>
                                    </li>
                                    @if(Auth::user()->isAdmin())
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a href="{{ route('admin.doctorss.index') }}" class="dropdown-item">
                                                <i class="bi bi-people-fill me-2"></i>Kelola Dokter
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.patients.index') }}" class="dropdown-item">
                                                <i class="bi bi-person-fill me-2"></i>Kelola Pasien
                                            </a>
                                        </li>
                                    @endif
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4">
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

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-custom-red text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>TELKOMEDIKA</h5>
                    <p>TelkoMedika connected health solution</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="/doctorss" class="text-white text-decoration-none">Doctors</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill"></i> 0123 Some Place</li>
                        <li><i class="bi bi-telephone-fill"></i> (237) 681-892-255</li>
                        <li><i class="bi bi-envelope-fill"></i> info@telekomedika.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
