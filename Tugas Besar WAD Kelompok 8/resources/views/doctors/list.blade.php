@extends('layout')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" 
                       class="form-control" 
                       id="searchDoctor" 
                       placeholder="Cari dokter berdasarkan nama atau spesialisasi..."
                       autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row" id="doctorsList">
        <!-- Loading indicator -->
        <div class="col-12 text-center">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat data dokter...</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, fetching doctors...');
    loadDoctors();

    const searchInput = document.getElementById('searchDoctor');
    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const searchTerm = this.value.toLowerCase();
            console.log('Searching for:', searchTerm);
            filterDoctors(searchTerm);
        }, 300);
    });
});

function loadDoctors() {
    console.log('Making API request...');
    fetch('/api/doctors')
        .then(response => {
            console.log('API Response:', response);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);
            if (data.success) {
                window.allDoctors = data.data; // Store doctors globally
                renderDoctors(data.data);
            } else {
                throw new Error(data.message || 'Failed to load doctors');
            }
        })
        .catch(error => {
            console.error('Error loading doctors:', error);
            document.getElementById('doctorsList').innerHTML = `
                <div class="col-12">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Terjadi kesalahan: ${error.message}
                    </div>
                </div>
            `;
        });
}

function filterDoctors(searchTerm) {
    if (!window.allDoctors) {
        console.warn('No doctors data available for filtering');
        return;
    }

    console.log('Filtering doctors with term:', searchTerm);
    const filtered = window.allDoctors.filter(doctor => 
        doctor.name.toLowerCase().includes(searchTerm) ||
        doctor.specialty.toLowerCase().includes(searchTerm)
    );
    
    renderDoctors(filtered);
}

function renderDoctors(doctors) {
    console.log('Rendering doctors:', doctors);
    if (!doctors || doctors.length === 0) {
        document.getElementById('doctorsList').innerHTML = `
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle-fill me-2"></i>
                    Tidak ada dokter yang sesuai dengan pencarian Anda.
                </div>
            </div>
        `;
        return;
    }

    const doctorsHtml = doctors.map(doctor => `
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="position-relative">
                    <img src="${doctor.picture}" 
                         class="card-img-top" 
                         alt="${doctor.name}" 
                         style="height: 200px; object-fit: cover;">
                    <span class="position-absolute top-0 end-0 m-2 badge ${doctor.available ? 'bg-success' : 'bg-danger'}">
                        ${doctor.available ? 'Tersedia' : 'Tidak Tersedia'}
                    </span>
                </div>
                <div class="card-body">
                    <h5 class="card-title">${doctor.name}</h5>
                    <p class="card-text">
                        <span class="d-block mb-2">
                            <i class="bi bi-hospital me-2"></i>
                            <strong>Spesialisasi:</strong> ${doctor.specialty}
                        </span>
                        <span class="d-block mb-3">
                            <i class="bi bi-envelope me-2"></i>
                            <strong>Email:</strong> ${doctor.email}
                        </span>
                    </p>
                    ${doctor.available 
                        ? `<a href="/appointments/create?doctor=${encodeURIComponent(doctor.name)}" 
                            class="btn btn-primary w-100">
                            <i class="bi bi-calendar-plus me-2"></i>Buat Janji
                           </a>`
                        : `<button class="btn btn-secondary w-100" disabled>
                            <i class="bi bi-x-circle me-2"></i>Tidak Tersedia
                           </button>`
                    }
                </div>
            </div>
        </div>
    `).join('');
    
    document.getElementById('doctorsList').innerHTML = doctorsHtml;
}
</script>
@endpush 