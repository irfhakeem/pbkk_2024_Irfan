<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Schema;

class PatientController extends Controller
{
    public function get()
    {

        // Ambil semua data pasien
        $patients = Patient::orderBy('patient_id')->paginate(10);

        // Ambil nama kolom dari tabel patients
        $columns = Schema::getColumnListing('patients');

        $excludedColumns = ['created_at', 'updated_at'];

        // Filter kolom yang tidak diinginkan
        $columns = array_diff($columns, $excludedColumns);
        // dd($patients);
        return view('page-pertemuan-2.sections.pasien', [
            'columns' => $columns,
            'patients' => $patients
        ]);
    }

    function delete($id)
    {
        $patient = Patient::find($id);

        if ($patient) {
            $patient->delete();
            return redirect()->route('pasien')->with('success', 'Patient deleted successfully.');
        }

        return redirect()->route('pasien')->with('error', 'Patient not found.');
    }

    function add(Request $request)
    {
        $patient = new Patient();
        $patient->name = $request->name;
        $patient->nik = $request->nik;
        $patient->tanggal_lahir = $request->tanggal_lahir;
        $patient->email = $request->email;
        $patient->no_hp = $request->no_hp;
        $patient->jenis_kelamin = $request->jenis_kelamin;
        $patient->Golongan_darah = $request->Golongan_darah;
        $patient->save();

        return redirect()->route('pasien')->with('success', 'Patient added successfully.');
    }

    public function edit($id)
    {
        $patient = Patient::find($id);

        if ($patient) {
            return view('page-pertemuan-2.sections.pasien-edit', compact('patient'));
        }

        return redirect()->route('pasien')->with('error', 'Patient not found.');
    }

    function update(Request $request, $id)
    {
        $validate = $request->validate([
            'nik' => 'required',
            'name' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'Golongan_darah' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $patient = Patient::find($id);
        $patient->update($validate);
        return redirect()->route('pasien')->with('success', 'Patient updated successfully.');
    }
}
