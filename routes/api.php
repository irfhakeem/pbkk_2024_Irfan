<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\HealthCenterController;
use App\Http\Controllers\Api\SpecializationController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\DrugController;
use App\Http\Controllers\Api\MedicalReportController;
use App\Http\Controllers\Api\PrescriptionController;
use App\Http\Controllers\Api\AppointmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Patient API
// Route::middleware(['auth:sanctum', 'can:add patient'])->group(function () {
//     Route::get('/patient', [PatientController::class, 'get']);
//     Route::delete('/patient/delete/{id}', [PatientController::class, 'delete']);
//     Route::post('/patient/add', [PatientController::class, 'add']);
//     Route::get('/patient/edit/{id}', [PatientController::class, 'edit']);
//     Route::put('/patient/{id}', [PatientController::class, 'update']);
// });

Route::get('/patient', [PatientController::class, 'getPatient']);
Route::get('/patient/{id}', [PatientController::class, 'getPatientById']);
Route::post('/add-patient', [PatientController::class, 'addPatient']);
Route::delete('/delete-patient/{id}', [PatientController::class, 'deletePatient']);
Route::put('/update-patient/{id}', [PatientController::class, 'updatePatient']);

// Doctor API
Route::get('/doctor', [DoctorController::class, 'getDoctor']);
Route::get('/search-doctor-id/{id}', [DoctorController::class, 'getDoctorById']);
Route::post("/add-doctor", [DoctorController::class, 'addDoctor']);
Route::put('/update-doctor/{id}', [DoctorController::class, 'update']);
Route::delete('/delete-doctor/{id}', [DoctorController::class, 'delete']);

// Health Center API
Route::get('/health-center', [HealthCenterController::class, 'getHealthCenter']);
Route::post('/search-health-center-id', [HealthCenterController::class, 'getHealthCenterById']);
Route::post('/add-health-center', [HealthCenterController::class, 'addHealthCenter']);
Route::put('/update-health-center/{id}', [HealthCenterController::class, 'updateHealthCenter']);
Route::delete('/delete-health-center/{id}', [HealthCenterController::class, 'deleteHealthCenter']);

// Specialization API
Route::get('/specialization', [SpecializationController::class, 'getSpecialization']);
Route::post('/search-specialization-id', [SpecializationController::class, 'getSpecializationById']);
Route::post('/add-specialization', [SpecializationController::class, 'addSpecialization']);
Route::put('/update-specialization/{id}', [SpecializationController::class, 'updateSpecialization']);
Route::delete('/delete-specialization/{id}', [SpecializationController::class, 'deleteSpecialization']);

// Service API
Route::get('/service', [ServiceController::class, 'getService']);
Route::get('/service/{id}', [ServiceController::class, 'getServiceById']);
Route::post('/add-service', [ServiceController::class, 'addService']);
Route::put('/update-service/{id}', [ServiceController::class, 'updateService']);
Route::delete('/delete-service/{id}', [ServiceController::class, 'deleteService']);

// Drug API
Route::get('/drug', [DrugController::class, 'getDrug']);
Route::get('/drug/{id}', [DrugController::class, 'getDrugById']);
Route::post('/add-drug', [DrugController::class, 'addDrug']);
Route::put('/update-drug/{id}', [DrugController::class, 'updateDrug']);
Route::delete('/delete-drug/{id}', [DrugController::class, 'deleteDrug']);

// MR API
Route::get('/medical-report', [MedicalReportController::class, 'getMedicalReport']);
Route::get('/medical-report/{id}', [MedicalReportController::class, 'getMedicalReportById']);
Route::post('/add-medical-report', [MedicalReportController::class, 'addMedicalReport']);
Route::put('/update-medical-report/{id}', [MedicalReportController::class, 'updateMedicalReport']);
Route::delete('/delete-medical-report/{id}', [MedicalReportController::class, 'deleteMedicalReport']);

// Prescription API
Route::get('/prescription', [PrescriptionController::class, 'getAll']);
Route::get('/prescription/{id}', [PrescriptionController::class, 'getById']);
Route::post('/add-prescription', [PrescriptionController::class, 'add']);
Route::put('/update-prescription/{id}', [PrescriptionController::class, 'update']);
Route::delete('/delete-prescription/{id}', [PrescriptionController::class, 'delete']);

// Prescription API
Route::get('/appointment', [AppointmentController::class, 'getAll']);
Route::get('/appointment/{id}', [AppointmentController::class, 'getById']);
Route::post('/add-appointment', [AppointmentController::class, 'add']);
Route::put('/update-appointment/{id}', [AppointmentController::class, 'update']);
Route::delete('/delete-appointment/{id}', [AppointmentController::class, 'delete']);
