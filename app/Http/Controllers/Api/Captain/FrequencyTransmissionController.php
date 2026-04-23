<?php

namespace App\Http\Controllers\Api\Captain;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Captain\FrequencyTransmission\FrequencyTransmissionResource;
use App\Models\FrequencyTransmission;
use Illuminate\Http\Request;

class FrequencyTransmissionController extends ApiController
{
    public function index(Request $request)
    {
        $query = FrequencyTransmission::query()
            ->where('driver_id', auth()->id())
            ->latest('id');

        if ($request->filled('status_driver')) {
            $query->where('status_driver', (int) $request->status_driver);
        }

        $items = $query->get();

        return sendResponse(FrequencyTransmissionResource::collection($items));
    }

    /**
     * Accept/refuse captain pending frequency transmission (status_driver = 0).
     *
     * status_driver: 1 = accept, 2 = refuse
     */
    public function decide(Request $request, FrequencyTransmission $frequencyTransmission)
    {
        if ($frequencyTransmission->driver_id !== auth()->id()) {
            return sendError(t_("you dont have permisssion to access this resource"), [], 403);
        }

        if ((int) $frequencyTransmission->status_driver !== 0) {
            return sendError(__("messages.Trip Has Pending Request") ?: "Only pending requests can be updated", [
                'status_driver' => (int) $frequencyTransmission->status_driver,
            ], 422);
        }

        $data = $request->validate([
            'status_driver' => 'required|in:1,2',
        ]);

        $frequencyTransmission->update([
            'status_driver' => (int) $data['status_driver'],
            'updated_by' => auth()->id(),
        ]);

        return sendResponse(new FrequencyTransmissionResource($frequencyTransmission->fresh()));
    }
}

