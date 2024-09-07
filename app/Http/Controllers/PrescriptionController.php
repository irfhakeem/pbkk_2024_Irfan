<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prescription;
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

        // Filter kolom yang tidak diinginkan
        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.prescription', [
            'columns' => $columns,
            'prescriptions' => $prescriptions
        ]);
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
}
