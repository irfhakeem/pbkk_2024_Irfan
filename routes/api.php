<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HealthCenterController;
use App\Http\Controllers\SpecializationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Patient API
Route::get('/patient', [PatientController::class, 'getPatient']);
Route::post('/search-patient-id', [PatientController::class, 'getPatientById']);
Route::post('/add-patient', [PatientController::class, 'addPatient']);
Route::post('/delete-patient', [PatientController::class, 'deletePatient']);
Route::post('/update-patient', [PatientController::class, 'updatePatient']);

// Doctor API
Route::get('/doctor', [DoctorController::class, 'getDoctor']);
Route::post('/search-doctor-id', [DoctorController::class, 'getDoctorById']);
Route::post("/add-doctor", [DoctorController::class, 'addDoctor']);


// Health Center API
Route::get('/health-center', [HealthCenterController::class, 'getHealthCenter']);
Route::post('/search-health-center-id', [HealthCenterController::class, 'getHealthCenterById']);
Route::post('/add-health-center', [HealthCenterController::class, 'addHealthCenter']);
Route::post('/delete-health-center', [HealthCenterController::class, 'deleteHealthCenter']);
Route::post('/update-health-center', [HealthCenterController::class, 'updateHealthCenter']);

// Specialization API
Route::get('/specialization', [SpecializationController::class, 'getSpecialization']);
Route::post('/add-specialization', [SpecializationController::class, 'addSpecialization']);
Route::post('/update-specialization', [SpecializationController::class, 'updateSpecialization']);
Route::delete('/delete-specialization/{id}', [SpecializationController::class, 'deleteSpecialization']);
