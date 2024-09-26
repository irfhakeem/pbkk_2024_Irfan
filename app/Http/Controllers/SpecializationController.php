<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Schema;

class SpecializationController extends Controller
{
    //
    public function get()
    {
        $specializations = Specialization::paginate(10);

        $columns = Schema::getColumnListing('specializations');

        $excludedColumns = ['created_at', 'updated_at'];

        $columns = array_diff($columns, $excludedColumns);
        // dd($specializations);
        return view('page-pertemuan-2.sections.specialization', [
            'columns' => $columns,
            'specializations' => $specializations
        ]);
    }

    function delete($id)
    {
        $specialization = Specialization::find($id);

        if ($specialization) {
            $specialization->delete();
            return redirect()->route('specialization')->with('success', 'Specialization deleted successfully.');
        }

        return redirect()->route('specialization')->with('error', 'Specialization not found.');
    }

    function add(Request $request)
    {
        $request->validate([
            'spesialisasi' => 'required',
        ]);

        Specialization::create($request->all());
        return redirect()->route('specialization')->with('success');
    }

    function edit($id)
    {
        $specialization = Specialization::find($id);
        return view('page-pertemuan-2.sections.specialization-edit', compact('specialization'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'spesialisasi' => 'required',
        ]);

        $specialization = Specialization::find($id);
        $specialization->update($request->all());
        return redirect()->route('specialization')->with('success', 'Specialization updated successfully.');
    }

    // RestAPI

    public function getSpecialization()
    {
        $specializations = Specialization::all();
        return response()->json($specializations);
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

    function updateSpecialization(UpdateSpecializationRequest $request)
    {
        $inputSpecialization = strtolower($request->spesialisasi);

        // Cek apakah spesialisasi sudah ada
        $specialistExist = Specialization::whereRaw('LOWER(spesialisasi) = ?', [$inputSpecialization])
            ->where('spesialis_id', '!=', $request->spesialis_id) // Mengecek selain id yang sedang di-update
            ->first();

        if ($specialistExist) {
            return response()->json(['message' => 'Specialization already exists.'], 400);
        }

        // Cari spesialisasi yang akan di-update
        $specialization = Specialization::find($request->spesialis_id);

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
        // Cek apakah spesialisasi dengan ID tersebut ada
        $specialization = Specialization::find($id);

        if (!$specialization) {
            // Jika spesialisasi tidak ditemukan, return pesan error
            return response()->json([
                'message' => 'Specialization not found'
            ], 404);
        }

        // Hapus spesialisasi
        $specialization->delete();

        // Return response berhasil
        return response()->json([
            'message' => 'Specialization deleted successfully'
        ], 200);
    }
}
