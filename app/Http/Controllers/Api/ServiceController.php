<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\AddServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    //
    function getService()
    {
        $services = Service::all()->makeHidden(['created_at', 'updated_at']);
        return response()->json($services);
    }

    function getServiceById($id)
    {
        $service = Service::where("service_id", $id)->first()->makeHidden(['created_at', 'updated_at']);
        return response()->json($service);
    }

    function addService(AddServiceRequest $request)
    {
        $inputService = strtolower($request->nama);

        $serviceExist = Service::whereRaw('LOWER(nama) = ?', [$inputService])->first();

        if ($serviceExist) {
            return response()->json(['message' => 'Service already exists.'], 400);
        }

        $service = Service::create($request->validated());
        return response()->json($service);
    }

    function updateService(UpdateServiceRequest $request, $id)
    {
        $service = Service::where("service_id", $id)->first();

        if (!$service) {
            return response()->json(['message' => 'Service not found.'], 404);
        }

        $inputService = strtolower($request->nama);
        $serviceExist = Service::whereRaw('LOWER(nama) = ?', [$inputService])->where('service_id', '!=', $id)->first();

        if ($serviceExist) {
            return response()->json(['message' => 'Service already exists.'], 400);
        }

        $service->update($request->validated());
        return response()->json(['messege' => 'Service updated successfully.']);
    }

    function deleteService($id)
    {
        $service = Service::where("service_id", $id)->first();

        if (!$service) {
            return response()->json([
                'message' => 'Service not found.'
            ], 404);
        }

        $service->delete();
        return response()->json([
            'message' => 'Service deleted successfully.'
        ]);
    }
}
