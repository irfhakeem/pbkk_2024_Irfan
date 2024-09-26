<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSpecializationRequest;
use App\Http\Requests\GetSpecializationByIdRequest;
use App\Http\Requests\UpdateSpecializationRequest;
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
            'spesialisasi' => 'required',
        ]);

        Specialization::create($request->all());
        return redirect()->route('specialization')->with('success');
    }

    function edit($id)
    {
        $specialization = Specialization::find($id);
        return view('page-pertemuan-2.sections.specialization-edit', compact('specialization'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'spesialisasi' => 'required',
        ]);

        $specialization = Specialization::find($id);
        $specialization->update($request->all());
        return redirect()->route('specialization')->with('success', 'Specialization updated successfully.');
    }

    // RestAPI

}
