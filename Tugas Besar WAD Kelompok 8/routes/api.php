<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DoctorApiController;

Route::get('appointments', [AppointmentController::class, 'apiIndex']);
Route::get('appointments/{appointment}', [AppointmentController::class, 'apiShow']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/doctors', [DoctorApiController::class, 'getDoctors']);    