<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalReport;
use App\Http\Requests\AddMedicalReportRequest;

class MedicalReportController extends Controller
{
    //
    function getMedicalReport()
    {
        $medicalReports = MedicalReport::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($medicalReports);
    }

    function getMedicalReportById($id)
    {
        $medicalReport = MedicalReport::where("medical_report_id", $id)->first()->makeHidden(['created_at', 'updated_at']);
        return response()->json($medicalReport);
    }

    function addMedicalReport(AddMedicalReportRequest $request)
    {
        $validated = $request->validated();
        MedicalReport::create($validated);
        return response()->json(['message' => 'Medical report added successfully']);
    }

    function updateMedicalReport(AddMedicalReportRequest $request, $id)
    {
        $validated = $request->validated();
        $medicalReport = MedicalReport::find($id);
        $medicalReport->update($validated);
        return response()->json(['message' => 'Medical report updated successfully']);
    }

    function deleteMedicalReport($id)
    {
        $medicalReport = MedicalReport::find($id);
        if ($medicalReport) {
            $medicalReport->delete();
            return response()->json(['message' => 'Medical report deleted successfully']);
        }
        return response()->json(['message' => 'Medical report not found']);
    }
}
