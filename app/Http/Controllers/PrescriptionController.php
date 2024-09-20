<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Drug;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\PrescriptionDrug;
use Illuminate\Support\Facades\Schema;

class PrescriptionController extends Controller
{
    //
    public function get()
    {
        // Ambil data services dengan pagination
        $prescriptions = Prescription::paginate(10);
        $drugs = Drug::select('drug_id', 'nama')->get();
        // Ambil nama kolom dari tabel prescription
        $columns = Schema::getColumnListing('prescriptions');

        // Kolom yang tidak ingin disertakan
        $excludedColumns = ['created_at', 'updated_at'];

        // Filter kolom yang tidak diinginkan
        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.prescription', compact('prescriptions', 'columns', 'drugs'));
    }

    function delete($id)
    {
        $prescription = Prescription::find($id);

        if ($prescription) {
            $prescription->delete();
            return redirect()->route('prescription')->with('success', 'Prescription deleted successfully.');
        }

        return redirect()->route('prescription')->with('error', 'Prescription not found.');
    }

    function add(Request $request)
    {
        $request->validate([
            'penyakit' => 'required',
            'instruksi' => 'required',
            'dokter' => 'required',
            'date' => 'required',
            'patient_id' => 'required',
            'drug_id' => 'required|array',
            'drug_id.*' => 'exists:drugs,drug_id',
        ]);

        // dd($request->all());

        $prescription = Prescription::create($request->only('penyakit', 'instruksi', 'dokter', 'date', 'patient_id'));

        foreach ($request->drug_id as $drugId) {
            PrescriptionDrug::create([
                'prescription_id' => $prescription->prescription_id,
                'drug_id' => $drugId
            ]);
        }

        return redirect()->route('prescription')->with('success', 'Prescription added successfully.');
    }

    public function edit($id)
    {
        $prescription = Prescription::find($id);
        $doctors = Doctor::select('nama', 'dokter_id')->get();
        $prescriptionDrugs = PrescriptionDrug::where('prescription_id', $id)->get();
        return view('page-pertemuan-2.sections.prescription-edit', compact('prescription', 'doctors', 'prescriptionDrugs'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'instruksi' => 'required',
            'penyakit' => 'required',
            'dokter' => 'required',
            'date' => 'required',
            'patient_id' => 'required',
            'drug_id' => 'required|array',
            'drug_id.*' => 'exists:drugs,drug_id',
        ]);

        $prescription = Prescription::find($id);
        $prescription->update($request->only('penyakit', 'instruksi', 'dokter', 'date', 'patient_id'));

        $existingDrugs = PrescriptionDrug::where('prescription_id', $id)->pluck('drug_id')->toArray();

        foreach ($existingDrugs as $existingDrugId) {
            if (!in_array($existingDrugId, $request->drug_id)) {
                PrescriptionDrug::where('prescription_id', $id)
                    ->where('drug_id', $existingDrugId)
                    ->delete();
            }
        }

        foreach ($request->drug_id as $drugId) {
            if (!in_array($drugId, $existingDrugs)) {
                PrescriptionDrug::create([
                    'prescription_id' => $prescription->prescription_id,
                    'drug_id' => $drugId
                ]);
            }
        }
        return redirect()->route('prescription')->with('success', 'Prescription updated successfully.');
    }
}
