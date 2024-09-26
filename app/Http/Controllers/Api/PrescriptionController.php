<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPrescriptionRequest;
use App\Models\Prescription;
use App\Models\PrescriptionDrug;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    //
    function getAll()
    {
        $prescriptions = Prescription::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($prescriptions);
    }

    function getById($id)
    {
        $prescription = Prescription::find($id);
        if ($prescription) {
            return response()->json($prescription);
        }
        return response()->json(['message' => 'Prescription not found.'], 404);
    }

    function add(AddPrescriptionRequest $request)
    {
        try {
            $prescription = Prescription::create($request->only('penyakit', 'instruksi', 'dokter', 'date', 'patient_id'));

            foreach ($request->drug_id as $drugId) {
                PrescriptionDrug::create([
                    'prescription_id' => $prescription->prescription_id,
                    'drug_id' => $drugId
                ]);
            }
            return response()->json($prescription->makeHidden(['created_at', 'updated_at']), 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    function update(AddPrescriptionRequest $request, $id)
    {
        $prescription = Prescription::find($id);
        if ($prescription) {
            $prescription->update($request->only('penyakit', 'instruksi', 'dokter', 'date', 'patient_id'));
            PrescriptionDrug::where('prescription_id', $id)->delete();
            foreach ($request->drug_id as $drugId) {
                PrescriptionDrug::create([
                    'prescription_id' => $prescription->prescription_id,
                    'drug_id' => $drugId
                ]);
            }
            return response()->json($prescription->makeHidden(['created_at', 'updated_at']));
        }
        return response()->json(['message' => 'Prescription not found.'], 404);
    }

    function delete($id)
    {
        $prescription = Prescription::find($id);
        if ($prescription) {
            $prescription->delete();
            return response()->json(['message' => 'Prescription deleted successfully.']);
        }
        return response()->json(['message' => 'Prescription not found.'], 404);
    }
}
