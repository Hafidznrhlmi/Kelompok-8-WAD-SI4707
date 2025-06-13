<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\MedicalRecordController;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Test route for doctors API
Route::get('/test-doctors', function() {
    $doctors = app()->make(App\Http\Controllers\Api\DoctorApiController::class)->getDoctors();
    dd($doctors);
});

// Doctors routes
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');

// API routes
Route::get('/api/doctors', [App\Http\Controllers\Api\DoctorApiController::class, 'getDoctors']);

// Medical Records routes - Simplified
Route::middleware(['auth'])->group(function () {
    Route::get('/medical-records', [MedicalRecordController::class, 'index'])->name('medical-records.index');
    Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])->name('medical-records.create');
    Route::post('/medical-records', [MedicalRecordController::class, 'store'])->name('medical-records.store');
    Route::get('/medical-records/{medical_record}', [MedicalRecordController::class, 'show'])->name('medical-records.show');
    Route::get('/medical-records/{medical_record}/edit', [MedicalRecordController::class, 'edit'])->name('medical-records.edit');
    Route::put('/medical-records/{medical_record}', [MedicalRecordController::class, 'update'])->name('medical-records.update');
    Route::delete('/medical-records/{medical_record}', [MedicalRecordController::class, 'destroy'])->name('medical-records.destroy');
});

// Public doctor routes (accessible by all)
Route::get('/doctorss', [DoctorController::class, 'index'])->name('doctorss.index');
Route::get('/doctorss/{doctor}', [DoctorController::class, 'show'])->name('doctorss.show');

// Doctor routes (only for authenticated doctors)
Route::middleware(['auth', 'doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
});

// Admin doctor management routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::resource('doctorss', AdminDoctorController::class);
        Route::resource('patients', PatientController::class)->except(['create', 'store']);
        Route::resource('obat', ObatController::class);
    });

// Appointment routes (for patients)
Route::middleware(['auth'])->group(function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.update-status');
});

// API routes
Route::get('/api/appointments', [AppointmentController::class, 'apiIndex']);
Route::get('/api/appointments/{appointment}', [AppointmentController::class, 'apiShow']);

// Holiday routes
Route::resource('holidays', HolidayController::class);

// Profile Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete-photo');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Patient Management Routes
    Route::get('/patients', [App\Http\Controllers\Admin\PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{patient}/edit', [App\Http\Controllers\Admin\PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [App\Http\Controllers\Admin\PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [App\Http\Controllers\Admin\PatientController::class, 'destroy'])->name('patients.destroy');
});


