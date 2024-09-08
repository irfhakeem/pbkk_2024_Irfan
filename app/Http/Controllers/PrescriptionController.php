<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Prescription;
use App\Models\Patient;
use Illuminate\Support\Facades\Schema;

class PrescriptionController extends Controller
{
    //
    public function get()
    {
        // Ambil data services dengan pagination
        $prescriptions = Prescription::paginate(10);

        // Ambil nama kolom dari tabel prescription
        $columns = Schema::getColumnListing('prescriptions');

        // Kolom yang tidak ingin disertakan
        $excludedColumns = ['created_at', 'updated_at'];

        $doctors = Doctor::all();

        // Filter kolom yang tidak diinginkan
        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.prescription', compact('prescriptions', 'columns', 'doctors'));
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
            'instruksi' => 'required',
            'dokter' => 'required',
            'patient_id' => 'required'
        ]);

        Prescription::create($request->all());
        return redirect()->route('prescription')->with('success', 'Prescription added successfully.');
    }

    public function edit($id)
    {
        $prescription = Prescription::find($id);
        $doctors = Doctor::all();
        return view('page-pertemuan-2.sections.prescription-edit', compact('prescription'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'instruksi' => 'required',
            'dokter' => 'required',
            'patient_id' => 'required'
        ]);

        $prescription = Prescription::find($id);
        $prescription->update($request->all());
        return redirect()->route('prescription')->with('success', 'Prescription updated successfully.');
    }
}
