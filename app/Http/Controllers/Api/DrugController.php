<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Http\Requests\AddDrugRequest;
use App\Http\Requests\UpdateDrugRequest;

class DrugController extends Controller
{
    //
    function getDrug()
    {
        $drugs = Drug::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($drugs);
    }

    function getDrugById($id)
    {
        $drug = Drug::where("drug_id", $id)->first()->makeHidden(['created_at', 'updated_at']);

        if (!$drug) {
            return response()->json([
                'message' => 'Drug not found'
            ], 404);
        }

        return response()->json($drug);
    }

    function addDrug(AddDrugRequest $request)
    {
        $inputNama = strtolower($request->nama);

        $isExist = Drug::whereRaw('LOWER(nama) = ?', $inputNama)->first();

        if ($isExist) {
            return response()->json([
                'message' => 'Drug already exist'
            ], 400);
        }

        $drug = Drug::create($request->all());
        return response()->json($drug->makeHidden(['created_at', 'updated_at']), 201);
    }

    function updateDrug(UpdateDrugRequest $request, $id)
    {
        $drug = Drug::where("drug_id", $id)->first();

        if (!$drug) {
            return response()->json([
                'message' => 'Drug not found'
            ], 404);
        }

        $drug->update($request->all());
        return response()->json($drug->makeHidden(['created_at', 'updated_at']));
    }

    function deleteDrug($id)
    {
        $drug = Drug::where("drug_id", $id)->first();

        if (!$drug) {
            return response()->json([
                'message' => 'Drug not found'
            ], 404);
        }

        $drug->delete();
        return response()->json([
            'message' => 'Drug deleted successfully'
        ]);
    }
}
