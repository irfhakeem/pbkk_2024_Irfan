<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HealthCenterController;
use App\Http\Controllers\MedicalReportController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\AppointmentController;

// Fallback routing
Route::fallback(function () {
    return response()->view('fallback', ['message' => 'Halaman yang Anda cari tidak ditemukan.'], 404);
});

Route::redirect('/', '/page-pertemuan-2/sections/dashboard', 301);

// Pertemuan 2
Route::prefix('/page-pertemuan-2')->group(function () {
    Route::prefix('/sections')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'statistics'])->name('dashboard');

        // Patient
        Route::get('/pasien', [PatientController::class, 'get'])->name('pasien');
        Route::delete('/pasien/delete/{id}', [PatientController::class, 'delete'])->name('pasien.delete');
        Route::post('/pasien/add', [PatientController::class, 'add'])->name('pasien.add');
        Route::get('/pasien/edit/{id}', [PatientController::class, 'edit'])->name('pasien.edit');
        Route::put('/pasien/{id}', [PatientController::class, 'update'])->name('pasien.update');

        // Doctor
        Route::get('/doctor', [DoctorController::class, 'get'])->name('doctor');
        Route::delete('/doctor/delete/{id}', [DoctorController::class, 'delete'])->name('doctor.delete');
        Route::post('doctor/add', [DoctorController::class, 'add'])->name('doctor.add');

        // Health Center
        Route::get('/health-center', [HealthCenterController::class, 'get'])->name('healthCenter');
        Route::delete('/health-center/delete/{id}', [HealthCenterController::class, 'delete'])->name('healthCenter.delete');
        Route::post('/health-center/add', [HealthCenterController::class, 'add'])->name('healthCenter.add');

        //Services
        Route::get('/service', [ServiceController::class, 'get'])->name('service');
        Route::delete('/service/delete/{id}', [ServiceController::class, 'delete'])->name('service.delete');
        Route::post('/service/add', [ServiceController::class, 'add'])->name('service.add');

        // Drugs
        Route::get('/drug', [DrugController::class, 'get'])->name('drug');
        Route::delete('/drug/delete/{id}', [DrugController::class, 'delete'])->name('drug.delete');
        Route::post('/drug/add', [DrugController::class, 'add'])->name('drug.add');

        // Specialization
        Route::get('/specialization', [SpecializationController::class, 'get'])->name('specialization');
        Route::delete('/specialization/delete/{id}', [SpecializationController::class, 'delete'])->name('specialization.delete');
        Route::post('/specialization/add', [SpecializationController::class, 'add'])->name('specialization.add');

        // Prescription
        Route::get('/prescription', [PrescriptionController::class, 'get'])->name('prescription');
        Route::delete('/prescription/delete/{id}', [PrescriptionController::class, 'delete'])->name('prescription.delete');

        // Medical Report
        Route::get('/medicalReport', [MedicalReportController::class, 'get'])->name('medicalReport');
        Route::delete('/medicalReport/delete/{id}', [MedicalReportController::class, 'delete'])->name('medicalReport.delete');
        Route::post('/medicalReport/add', [MedicalReportController::class, 'add'])->name('medicalReport.add');
        Route::get('/medicalReport/edit/{id}', [MedicalReportController::class, 'edit'])->name('medicalReport.edit');
        Route::put('/medicalReport/{id}', [MedicalReportController::class, 'update'])->name('medicalReport.update');

        // Appointment
        Route::get('/appointment', [AppointmentController::class, 'get'])->name('appointment');
        Route::delete('/appointment/delete/{id}', [AppointmentController::class, 'delete'])->name('appointment.delete');
    });
});
