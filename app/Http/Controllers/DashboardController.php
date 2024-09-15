<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HealthCenter;
use App\Models\MedicalReport;
use App\Models\numberFunction;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function statistics()
    {
        $numberFunction = new numberFunction();
        $displayTotalPatients = $numberFunction->formatNumber(Patient::count());
        $displayTotalDoctors = $numberFunction->formatNumber(Doctor::count());
        $displayTotalHealthCenter = $numberFunction->formatNumber(HealthCenter::count());

        return view('page-pertemuan-2.sections.dashboard', [
            'totalPatients' => $displayTotalPatients,
            'totalDoctors' => $displayTotalDoctors,
            'totalHealthCenter' => $displayTotalHealthCenter
        ]);
    }

    function getStatisticPatient()
    {
        $email = Auth::user()->email ?? null;
        $patient = Patient::where('email', $email)->first();
        // dd($id);
        $medicalReports = MedicalReport::where('patient_id', $patient->patient_id)->get('nama', 'dokter', 'date', 'faskes');
        $appointments = Appointment::where('patient_id', $patient->patient_id)->get('date');
        $prescriptions = Prescription::where('patient_id', $patient->patient_id)->get('instruksi', 'date');

        return view('page-pertemuan-2.sections.pasien-dashboard', compact('patient', 'medicalReports', 'appointments', 'prescriptions'));
    }

    public function getStatisticDoctor()
    {
        $email = Auth::user()->email ?? null;
        $doctor = Doctor::where('email', $email)->first();
        $spesialis_id = $doctor->spesialis_id;

        $spesialis = Specialization::where('spesialis_id', $spesialis_id)->first()->spesialisasi;
        $appointments = Appointment::where('doctor_id', $doctor->doctor_id)->get('date');

        return view('page-pertemuan-2.sections.doctor-dashboard', compact('doctor',  'appointments', 'spesialis'));
    }
}
