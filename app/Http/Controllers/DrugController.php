<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use Illuminate\Support\Facades\Schema;


class DrugController extends Controller
{
    //
    public function get()
    {
        $drugs = Drug::orderBy('drug_id')->paginate(10);

        $columns = Schema::getColumnListing('drugs');

        $excludedColumns = ['created_at', 'updated_at'];

        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.drug', [
            'columns' => $columns,
            'drugs' => $drugs
        ]);
    }

    function delete($id)
    {
        $drug = Drug::find($id);

        if ($drug) {
            $drug->delete();
            return redirect()->route('drug')->with('success', 'Drug deleted successfully.');
        }

        return redirect()->route('drug')->with('error', 'Drug not found.');
    }

    function add(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'satuan' => 'required'
        ]);

        Drug::create($request->all());
        // dd($drug->nama, $drug->jenis, $drug->satuan);
        return redirect()->route('drug')->with('success', 'Drug deleted successfully.');
    }

    function edit($id)
    {

        $drug = Drug::find($id);

        return view('page-pertemuan-2.sections.drug-edit', compact('drug'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required',
            'satuan' => 'required'
        ]);

        $drug = Drug::find($id);
        $drug->update($request->all());

        return redirect()->route('drug')->with('success', 'drug updated successfully.');
    }
}
