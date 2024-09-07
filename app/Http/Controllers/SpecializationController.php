<?php

namespace App\Http\Controllers;

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
            'nama' => 'required',
        ]);

        $specialization = new Specialization();
        $specialization->nama = $request->nama;
        $specialization->save();

        return redirect()->route('specialization')->with('success');
    }
}
