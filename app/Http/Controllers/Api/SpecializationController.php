<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Requests\AddSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;


class SpecializationController extends Controller
{
    //
    public function getSpecialization()
    {
        $specializations = Specialization::all();
        return response()->json($specializations);
    }

    function getSpecializationById($id)
    {
        $specialization = Specialization::where("spesialis_id", $id)->first()->makeHidden(['created_at', 'updated_at']);

        if (!$specialization) {
            return response()->json(['message' => 'Specialization not found.'], 404);
        }

        return response()->json($specialization);
    }

    function addSpecialization(AddSpecializationRequest $request)
    {
        $inputSpecialization = strtolower($request->spesialisasi);

        $specialistExist = Specialization::whereRaw('LOWER(spesialisasi) = ?', [$inputSpecialization])->first();

        if ($specialistExist) {
            return response()->json(['message' => 'Specialization already exists.'], 400);
        }

        Specialization::create($request->all());
        return response()->json(['message' => 'Specialization added successfully.']);
    }

    function updateSpecialization(UpdateSpecializationRequest $request, $spesialis_id)
    {
        $inputSpecialization = strtolower($request->spesialisasi);

        // Cek apakah spesialisasi sudah ada
        $specialistExist = Specialization::whereRaw('LOWER(spesialisasi) = ?', [$inputSpecialization])
            ->where('spesialis_id', '!=', $spesialis_id) // Mengecek selain id yang sedang di-update
            ->first();

        if ($specialistExist) {
            return response()->json(['message' => 'Specialization already exists.'], 400);
        }

        // Cari spesialisasi yang akan di-update
        $specialization = Specialization::find($spesialis_id);

        if (!$specialization) {
            return response()->json(['message' => 'Specialization not found.'], 404);
        }

        // Update spesialisasi
        $specialization->update([
            'spesialisasi' => $request->spesialisasi
        ]);

        return response()->json(['message' => 'Specialization updated successfully.']);
    }

    public function deleteSpecialization($id)
    {
        $specialization = Specialization::find($id);

        if (!$specialization) {
            return response()->json([
                'message' => 'Specialization not found'
            ], 404);
        }

        $specialization->delete();

        return response()->json([
            'message' => 'Specialization deleted successfully'
        ], 200);
    }
}
