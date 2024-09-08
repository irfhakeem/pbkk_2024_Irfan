<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Schema;

class ServiceController extends Controller
{
    //
    public function get()
    {
        // Ambil data services dengan pagination
        $services = Service::paginate(10);

        // Ambil nama kolom dari tabel services
        $columns = Schema::getColumnListing('services');

        // Kolom yang tidak ingin disertakan
        $excludedColumns = ['created_at', 'updated_at'];

        // Filter kolom yang tidak diinginkan
        $columns = array_diff($columns, $excludedColumns);

        return view('page-pertemuan-2.sections.service', [
            'columns' => $columns,
            'services' => $services
        ]);
    }

    function delete($id)
    {
        $service = Service::find($id);

        if ($service) {
            $service->delete();
            return redirect()->route('service')->with('success', 'Service deleted successfully.');
        }

        return redirect()->route('service')->with('error', 'Service not found.');
    }

    function add(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        Service::create($request->all());
        return redirect()->route('service')->with('success');
    }

    function edit($id)
    {
        $service = Service::find($id);
        return view('page-pertemuan-2.sections.service-edit', compact('service'));
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $service = Service::find($id);
        $service->update($request->all());

        return redirect()->route('service')->with('success', 'Service updated successfully.');
    }
}
