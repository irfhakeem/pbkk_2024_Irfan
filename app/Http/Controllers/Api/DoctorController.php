<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Http\Requests\AddDoctorRequest;

class DoctorController extends Controller
{
    //
    public function getDoctor()
    {
        $doctors = Doctor::all();
        return response()->json($doctors);
    }

    public function getDoctorById($id)
    {
        $doctor = Doctor::where('doctor_id', $id)->first();

        if ($doctor) {
            return response()->json($doctor);
        }

        return response()->json([
            'message' => 'Doctor not found'
        ], 400);
    }

    public function addDoctor(AddDoctorRequest $request)
    {
        $validated = $request->validated();

        $doctor = new Doctor();
        $doctor->sip = $validated['sip'];
        $doctor->nama = $validated['nama'];
        $doctor->email = $validated['email'];
        $doctor->no_hp = $validated['no_hp'];
        $doctor->jenis_kelamin = $validated['jenis_kelamin'];
        $doctor->spesialis_id = $validated['spesialis_id'];
        $doctor->tanggal_lahir = $validated['tanggal_lahir'];
        $doctor->health_center_id = $validated['health_center_id'];
        $doctor->save();

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = $request->sip;
        $user->save();

        // Menetapkan role 'doctor' ke user
        $user->assignRole('doctor');

        // Mengembalikan response
        return response()->json([
            'message' => 'Doctor added successfully',
            'data' => $doctor
        ]);
    }

    function update(Request $request, $id)
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

        $doctor = Doctor::find($id);
        if ($doctor) {
            $doctor->update($request->all());
            return response()->json(['message' => 'Doctor updated successfully.']);
        }
        return response()->json(['message' => 'Doctor not found.'], 404);
    }

    function delete($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            $doctor->delete();
            return response()->json(['message' => 'Doctor deleted successfully.']);
        }
        return response()->json(['message' => 'Doctor not found.'], 404);
    }
}
