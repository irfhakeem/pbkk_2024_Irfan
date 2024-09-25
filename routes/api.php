<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthCenterController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Patient API
Route::get('/patient', [PatientController::class, 'getPatient']);
Route::post('/search-patient-nik', [PatientController::class, 'getPatientByNik']);
Route::post('/add-patient', [PatientController::class, 'addPatient']);

// Doctor API
Route::get('/doctor', [DoctorController::class, 'getDoctor']);
Route::post('/doctorBySip', [DoctorController::class, 'getDoctorBySip'])->middleware('auth:sanctum');

// Health Center API
Route::get('/health-center', [HealthCenterController::class, 'getHealthCenter']);
Route::post('/add-health-center', [HealthCenterController::class, 'addHealthCenter']);
