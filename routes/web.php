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
use App\Models\Prescription;
use Illuminate\Support\Facades\Auth;


// Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth'])->get('/dashboard', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('dashboard');
    } else if (Auth::user()->hasRole('patient')) {
        return redirect()->route('dashboardPatient');
    } else if (Auth::user()->hasRole('doctor')) {
        return redirect()->route('dashboardDoctor');
    }
});

// Fallback routing
Route::fallback(function () {
    return response()->view('fallback', ['message' => 'Halaman yang Anda cari tidak ditemukan.'], 404);
})->name('fallback');

// Pertemuan 2
Route::prefix('/sections')->group(function () {
    // admin Dashboard
    Route::middleware(['auth', 'can:view admin dashboard'])->get('/dashboard', [DashboardController::class, 'statistics'])->name('dashboard');
    // patient Dashboard
    Route::middleware(['auth', 'can:view patient dashboard'])->get('/dashboard-patient', [DashboardController::class, 'getStatisticPatient'])->name('dashboardPatient');
    // doctor Dashboard
    Route::middleware(['auth', 'can:view doctor dashboard'])->get('/dashboard-doctor', [DashboardController::class, 'getStatisticDoctor'])->name('dashboardDoctor');

    // Patient Only Pages
    Route::middleware(['auth', 'can:view patient dashboard'])->group(function () {
        Route::get('/medical-reports-patient', [PatientController::class, 'getMyMedicalReports'])->name('medicalReportsPatient');
        Route::get('/appointments-patient', [PatientController::class, 'getMyAppointments'])->name('appointmentsPatient');
    });

    Route::middleware(['auth', 'can:add patients'])->group(function () {
        Route::get('/patient', [PatientController::class, 'get'])->name('pasien');
        Route::delete('/patient/delete/{id}', [PatientController::class, 'delete'])->name('pasien.delete');
        Route::post('/patient/add', [PatientController::class, 'add'])->name('pasien.add');
        Route::get('/patient/edit/{id}', [PatientController::class, 'edit'])->name('pasien.edit');
        Route::put('/patient/{id}', [PatientController::class, 'update'])->name('pasien.update');
    });

    // Admin Only Pages
    // Doctor
    Route::middleware(['auth', 'can:add doctors'])->group(function () {
        Route::get('/doctor', [DoctorController::class, 'get'])->name('doctor');
        Route::delete('/doctor/delete/{id}', [DoctorController::class, 'delete'])->name('doctor.delete');
        Route::post('doctor/add', [DoctorController::class, 'add'])->name('doctor.add');
        Route::get('/doctor/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
        Route::put('/doctor/{id}', [DoctorController::class, 'update'])->name('doctor.update');
    });

    // Health Center
    Route::middleware(['auth', 'can:add health centers'])->group(function () {
        Route::get('/health-center', [HealthCenterController::class, 'get'])->name('healthCenter');
        Route::delete('/health-center/delete/{id}', [HealthCenterController::class, 'delete'])->name('healthCenter.delete');
        Route::post('/health-center/add', [HealthCenterController::class, 'add'])->name('healthCenter.add');
        Route::get('/health-center/edit/{id}', [HealthCenterController::class, 'edit'])->name('healthCenter.edit');
        Route::put('/health-center/{id}', [HealthCenterController::class, 'update'])->name('healthCenter.update');
    });

    //Services
    Route::middleware(['auth', 'can:add services'])->group(function () {
        Route::get('/service', [ServiceController::class, 'get'])->name('service');
        Route::delete('/service/delete/{id}', [ServiceController::class, 'delete'])->name('service.delete');
        Route::post('/service/add', [ServiceController::class, 'add'])->name('service.add');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
        Route::put('/service/{id}', [ServiceController::class, 'update'])->name('service.update');
    });

    // Drugs
    Route::middleware(['auth', 'can:add drugs'])->group(function () {
        Route::get('/drug', [DrugController::class, 'get'])->name('drug');
        Route::delete('/drug/delete/{id}', [DrugController::class, 'delete'])->name('drug.delete');
        Route::post('/drug/add', [DrugController::class, 'add'])->name('drug.add');
        Route::get('/drug/edit/{id}', [DrugController::class, 'edit'])->name('drug.edit');
        Route::put('/drug/{id}', [DrugController::class, 'update'])->name('drug.update');
    });

    // Specialization
    Route::middleware(['auth', 'can:add specializations'])->group(function () {
        Route::get('/specialization', [SpecializationController::class, 'get'])->name('specialization');
        Route::delete('/specialization/delete/{id}', [SpecializationController::class, 'delete'])->name('specialization.delete');
        Route::post('/specialization/add', [SpecializationController::class, 'add'])->name('specialization.add');
        Route::get('/specialization/edit/{id}', [SpecializationController::class, 'edit'])->name('specialization.edit');
        Route::put('/specialization/{id}', [SpecializationController::class, 'update'])->name('specialization.update');
    });

    // Doctor Only Pages
    // Prescription
    Route::middleware(['auth', 'can:add prescriptions'])->group(function () {
        Route::get('/prescription', [PrescriptionController::class, 'get'])->name('prescription');
        Route::delete('/prescription/delete/{id}', [PrescriptionController::class, 'delete'])->name('prescription.delete');
        Route::post('/prescription/add', [PrescriptionController::class, 'add'])->name('prescription.add');
        Route::get('/prescription/edit/{id}', [PrescriptionController::class, 'edit'])->name('prescription.edit');
        Route::put('/prescription/{id}', [PrescriptionController::class, 'update'])->name('prescription.update');
    });

    // Medical Report
    Route::middleware(['auth', 'can:add medical reports'])->group(function () {
        Route::get('/medicalReport', [MedicalReportController::class, 'get'])->name('medicalReport');
        Route::delete('/medicalReport/delete/{id}', [MedicalReportController::class, 'delete'])->name('medicalReport.delete');
        Route::post('/medicalReport/add', [MedicalReportController::class, 'add'])->name('medicalReport.add');
        Route::get('/medicalReport/edit/{id}', [MedicalReportController::class, 'edit'])->name('medicalReport.edit');
        Route::put('/medicalReport/{id}', [MedicalReportController::class, 'update'])->name('medicalReport.update');
    });

    // Appointment
    Route::get('/appointment', [AppointmentController::class, 'get'])->name('appointment');
    Route::delete('/appointment/delete/{id}', [AppointmentController::class, 'delete'])->name('appointment.delete');
    Route::post('/appointment/add', [AppointmentController::class, 'add'])->name('appointment.add');
    Route::get('/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
});
