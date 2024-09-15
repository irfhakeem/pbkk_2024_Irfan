<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\HealthCenter;
use Illuminate\Http\Request;
use App\Models\MedicalReport;
use App\Models\Service;
use App\Models\HealthCenterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class MedicalReportController extends Controller
{
    public function get()
    {
        $medicalReports = MedicalReport::orderBy('medical_report_id')->paginate(10);
        $columns = Schema::getColumnListing('medical_reports');

        $excludedColumns = ['created_at', 'updated_at'];

        $email =  Auth::user()->email;
        $doctor = Doctor::select('nama', 'doctor_id', 'health_center_id')->where('email', $email)->first();
        $healthCenter = HealthCenter::select('nama')->where('health_center_id', $doctor->health_center_id)->first();
        // dd($doctor, $healthCenter);

        $healthCenterServices = HealthCenterService::select('service_id')->where('health_center_id', $doctor->health_center_id)->get();
        $services = [];
        foreach ($healthCenterServices as $healthCenterService) {
            $services[] = Service::select('nama')->where('service_id', $healthCenterService->service_id)->first();
        }


        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.medical-report', compact('medicalReports', 'columns', 'doctor', 'healthCenter', 'services'));
    }

    function delete($id)
    {
        $medicalReport = MedicalReport::find($id);

        if ($medicalReport) {
            $medicalReport->delete();
            return redirect()->route('medicalReport')->with('success', 'Medical Report deleted successfully.');
        }

        return redirect()->route('medicalReport')->with('error', 'Medical Report not found.');
    }
    function add(Request $request)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'patient_id' => 'required',
            'dokter' => 'required',
            'faskes' => 'required',
            'service' => 'required',
            'diagnosis' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        // dd($validate);

        MedicalReport::create($validate);
        return redirect()->route('medicalReport')->with('success', 'Medical Report added successfully.');
    }

    function edit($id)
    {
        $medicalReport = MedicalReport::find($id);

        $email =  Auth::user()->email;
        $doctor = Doctor::select('nama', 'doctor_id', 'health_center_id')->where('email', $email)->first();
        $healthCenter = HealthCenter::select('nama')->where('health_center_id', $doctor->health_center_id)->first();
        // dd($doctor, $healthCenter);

        $healthCenterServices = HealthCenterService::select('service_id')->where('health_center_id', $doctor->health_center_id)->get();
        $services = [];
        foreach ($healthCenterServices as $healthCenterService) {
            $services[] = Service::select('nama')->where('service_id', $healthCenterService->service_id)->first();
        }


        return view('page-pertemuan-2.sections.medical-report-edit', compact('medicalReport', 'doctor', 'healthCenter', 'services'));
    }

    function update(Request $request, $id)
    {
        $validate = $request->validate([
            'judul' => 'required',
            'patient_id' => 'required',
            'dokter' => 'required',
            'faskes' => 'required',
            'service' => 'required',
            'diagnosis' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        $medicalReport = MedicalReport::find($id);
        $medicalReport->update($validate);

        return redirect()->route('medicalReport')->with('success', 'Medical Report updated successfully.');
    }
}
