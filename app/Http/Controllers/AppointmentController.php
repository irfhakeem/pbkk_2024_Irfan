<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\HealthCenter;
use App\Models\Service;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AppointmentController extends Controller
{
    //hanya menampilkan appoinment pada user yang login, jadi tidak tertampil semua selain user yang login
    function get()
    {
        $columns = Schema::getColumnListing('appointments');
        $excludedColumns = ['created_at', 'updated_at'];
        $columns = array_diff($columns, $excludedColumns);

        if (Auth::user()->hasRole('doctor')) {
            $email = Auth::user()->email;
            $doctor = Doctor::where('email', $email)->first();
            $healthCenter = HealthCenter::where('health_center_id', $doctor->health_center_id)->first();
            $appointments = Appointment::where('doctor_id', $doctor->doctor_id)->orderBy('date')->paginate(10);
            $services = Service::select('service_id', 'nama')->get();
            return view('page-pertemuan-2.sections.appointment', compact('columns', 'appointments', 'doctor', 'healthCenter', 'services'));
        } elseif (Auth::user()->hasRole('patient')) {
            $email = Auth::user()->email;
            $patient = Patient::where('email', $email)->first();
            $appointments = Appointment::where('patient_id', $patient->patient_id)->orderBy('date')->paginate(10);
            $doctors = Doctor::select('doctor_id', 'nama')->get();
            $services = Service::select('service_id', 'nama')->get();
            $healthCenters = HealthCenter::select('health_center_id', 'nama')->get();
            return view('page-pertemuan-2.sections.appointment', compact('columns', 'appointments', 'doctors', 'healthCenters', 'services', 'patient'));
        } else {
            $appointments = Appointment::orderBy('date')->paginate(10);
            return view('page-pertemuan-2.sections.appointment', compact('columns', 'appointments'));
        }
    }

    public function delete($id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            $appointment->delete();
            return redirect()->route('appointment')->with('success', 'Appointment deleted successfully.');
        }

        return redirect()->route('appointment')->with('error', 'Appointment not found.');
    }

    public function add(Request $request)
    {
        $validate = $request->validate([
            'date' => 'required',
            'doctor_id' => 'required',
            'health_center_id' => 'required',
            'service_id' => 'required',
            'patient_id' => 'required',
            'time' => 'required',
        ]);

        Appointment::create($validate);
        return redirect()->route('appointment')->with('success');
    }

    function edit($id)
    {
        $appointment = Appointment::find($id);
        $doctors = Doctor::all();
        $healthCenters = HealthCenter::all();
        $services = Service::all();

        return view('page-pertemuan-2.sections.appointment-edit', compact('appointment', 'doctors', 'healthCenters', 'services'));
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
        $appointment->update($request->all());
        return redirect()->route('appointment')->with('success', 'Appointment updated successfully.');
    }
}
