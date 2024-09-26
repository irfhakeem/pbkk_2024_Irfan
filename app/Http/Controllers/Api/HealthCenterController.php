<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HealthCenter;
use App\Models\HealthCenterService;
use App\Http\Requests\AddHealthCenterRequest;
use App\Http\Requests\UpdateHealthCenterRequest;

class HealthCenterController extends Controller
{
    //
    function getHealthCenter()
    {
        $healthCenters = HealthCenter::all();
        return response()->json($healthCenters);
    }

    function getHealthCenterById($id)
    {
        $healthCenter = HealthCenter::where("health_center_id", $id)->first();
        $healthCenter->services = HealthCenterService::where('health_center_id', $healthCenter->health_center_id)->pluck('service_id')->toArray();

        if ($healthCenter) {
            return response()->json($healthCenter);
        }

        return response()->json([
            'message' => 'Health Center not found.'
        ], 400);
    }

    function addHealthCenter(AddHealthCenterRequest $request)
    {
        $healthCenter = HealthCenter::create($request->only('nama', 'alamat', 'no_telp', 'email'));

        foreach ($request->service_id as $serviceId) {
            HealthCenterService::create([
                'health_center_id' => $healthCenter->health_center_id,
                'service_id' => $serviceId
            ]);
        }

        $healthCenter->services = HealthCenterService::where('health_center_id', $healthCenter->health_center_id)->pluck('service_id')->toArray();

        return response()->json([
            'message' => 'Health Center and services added successfully.',
            'data' => $healthCenter
        ]);
    }

    function deleteHealthCenter($id)
    {
        $healthCenter = HealthCenter::where('health_center_id', $id)->first();

        if ($healthCenter) {
            $healthCenter->delete();
            return response()->json([
                'message' => 'Health Center deleted successfully.'
            ]);
        }

        return response()->json([
            'message' => 'Health Center not found.'
        ], 400);
    }

    function updateHealthCenter(UpdateHealthCenterRequest $request, $id)
    {
        $healthCenter = HealthCenter::where("health_center_id", $id)->first();

        if ($healthCenter) {
            $healthCenter->update($request->only('nama', 'alamat', 'no_telp', 'email'));

            $existingServices = HealthCenterService::where('health_center_id', $healthCenter->health_center_id)->pluck('service_id')->toArray();

            foreach ($existingServices as $existingServiceId) {
                if (!in_array($existingServiceId, $request->service_id)) {
                    HealthCenterService::where('health_center_id', $healthCenter->health_center_id)
                        ->where('service_id', $existingServiceId)
                        ->delete();
                }
            }

            foreach ($request->service_id as $serviceId) {
                if (!in_array($serviceId, $existingServices)) {
                    HealthCenterService::create([
                        'health_center_id' => $healthCenter->health_center_id,
                        'service_id' => $serviceId
                    ]);
                }
            }

            return response()->json([
                'message' => 'Health Center updated successfully.',
            ]);
        }

        return response()->json([
            'message' => 'Health Center not found.'
        ], 400);
    }
}
