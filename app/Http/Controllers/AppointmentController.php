<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Schema;

class AppointmentController extends Controller
{
    //
    function get()
    {
        $appointments = Appointment::paginate(10);

        $columns = Schema::getColumnListing('appointments');

        $excludedColumns = ['created_at', 'updated_at'];
        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.appointment', [
            'columns' => $columns,
            'appointments' => $appointments
        ]);
    }

    function delete($id)
    {
        $appointment = Appointment::find($id);

        if ($appointment) {
            $appointment->delete();
            return redirect()->route('appointment')->with('success', 'Appointment deleted successfully.');
        }

        return redirect()->route('appointment')->with('error', 'Appointment not found.');
    }
}
