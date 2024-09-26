<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    //
    function getAll()
    {
        $appointments = Appointment::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($appointments);
    }

    function getById($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            return response()->json($appointment);
        }
        return response()->json(['message' => 'Appointment not found.'], 404);
    }

    function add(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'doctor_id' => 'required',
            'health_center_id' => 'required',
            'service_id' => 'required',
            'patient_id' => 'required',
            'time' => 'required',
        ]);

        $appointment = Appointment::create($request->all());
        return response()->json($appointment, 201);
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required',
            'doctor_id' => 'required',
            'health_center_id' => 'required',
            'service_id' => 'required',
            'patient_id' => 'required',
            'time' => 'required',
        ]);

        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->update($request->all());
            return response()->json(['message' => 'Appointment updated successfully.']);
        }
        return response()->json(['message' => 'Appointment not found.'], 404);
    }

    function delete($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->delete();
            return response()->json(['message' => 'Appointment deleted successfully.']);
        }
        return response()->json(['message' => 'Appointment not found.'], 404);
    }
}
