<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HealthCenter;
use App\Models\numberFunction;
use Illuminate\Http\Request;
use App\Models\Patient;

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
}
