<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\HealthCenter;
use App\Models\Specialization;
use Illuminate\Support\Facades\Schema;

class DoctorController extends Controller
{
    public function get()
    {
        $doctors = Doctor::paginate(10);

        $columns = Schema::getColumnListing('doctors');

        $excludedColumns = ['created_at', 'updated_at'];

        $healthCenters = HealthCenter::all();
        $specializations = Specialization::all();

        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.doctor', compact('columns', 'doctors', 'healthCenters', 'specializations'));
    }

    function delete($id)
    {
        $doctor = Doctor::find($id);

        if ($doctor) {
            $doctor->delete();
            return redirect()->route('doctor')->with('success', 'Doctor deleted successfully.');
        }

        return redirect()->route('doctor')->with('error', 'Doctor not found.');
    }

    function add(Request $request)
    {
        $request->validate([
            'sip' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'jenis_kelamin' => 'required',
            'spesialis_id' => 'required',
            'tanggal_lahir' => 'required',
            'health_center_id' => 'required',
        ]);

        $doctor = new Doctor();
        $doctor->sip = $request->sip;
        $doctor->nama = $request->nama;
        $doctor->tanggal_lahir = $request->tanggal_lahir;
        $doctor->email = $request->email;
        $doctor->no_hp = $request->no_hp;
        $doctor->jenis_kelamin = $request->jenis_kelamin;
        $doctor->spesialis_id = $request->spesialis_id;
        $doctor->health_center_id = $request->health_center_id;
        $doctor->save();

        return redirect()->route('doctor')->with('success');
    }
}
