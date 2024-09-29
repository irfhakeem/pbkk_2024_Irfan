<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    //
    function getPatient()
    {
        $patients = Patient::all();
        return response()->json($patients->makeHidden(['created_at', 'updated_at']));
    }

    // Get patient by id
    public function getPatientById($id)
    {
        $patient = Patient::where('patient_id', $id)->first()->makeHidden(['created_at', 'updated_at']);

        if ($patient) {
            return response()->json($patient->makeHidden(['created_at', 'updated_at']));
        }

        return response()->json([
            'message' => 'Patient not found'
        ], 400);
    }

    public function addPatient(Request $request)
    {
        $validate = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'Golongan_darah' => 'required',
            'jenis_kelamin' => ['required', 'in:L,P'],
        ]);

        if ($validate) {
            $patient = Patient::create($validate);
            $patient->assignRole('patient');

            return response()->json([
                'messege' => 'Patient added successfully',
                'data' => $patient
            ], 200);
        }

        return response()->json([
            "messege" => "Failed to add patient"
        ], 400);
    }

    function deletePatient($id)
    {
        $patient = Patient::where("patient_id", $id);

        if ($patient) {
            $patient->delete();
            return response()->json([
                'message' => 'Patient deleted successfully'
            ], 200);
        }

        return response()->json([
            'message' => 'Patient not found'
        ], 400);
    }

    public function updatePatient(UpdatePatientRequest $request, $id)
    {
        $validatedData = $request->validated();
        $patient = Patient::where("patient_id", $id)->first();

        if ($patient) {
            $patient->update($validatedData);
            return response()->json([
                'message' => 'Patient updated successfully',
            ], 200);
        }

        return response()->json([
            'message' => 'Patient not found'
        ], 404);
    }
}
