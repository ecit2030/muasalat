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

        return $this->apiCode(200)
            ->apiBody([
                'data' => FrequencyTransmissionResource::collection($items),
            ])
            ->apiMessage('')
            ->apiInfo('captain frequency transmissions index')
            ->apiResponse();
    }

    /**
     * Accept/refuse captain pending frequency transmission (status_driver = 0).
     *
     * status_driver: 1 = accept, 2 = refuse
     */
    public function decide(Request $request, FrequencyTransmission $frequencyTransmission)
    {
        if ($frequencyTransmission->driver_id !== auth()->id()) {
            return $this->apiCode(403)
                ->apiBody([])
                ->apiMessage(t_("you dont have permisssion to access this resource"))
                ->apiInfo('captain frequency transmissions decide forbidden')
                ->apiResponse();
        }

        if ((int) $frequencyTransmission->status_driver !== 0) {
            return $this->apiCode(422)
                ->apiBody([
                    'status_driver' => (int) $frequencyTransmission->status_driver,
                ])
                ->apiMessage(__("messages.Trip Has Pending Request") ?: "Only pending requests can be updated")
                ->apiInfo('captain frequency transmissions decide not pending')
                ->apiResponse();
        }

        $data = $request->validate([
            'status_driver' => 'required|in:1,2',
        ]);

        $frequencyTransmission->update([
            'status_driver' => (int) $data['status_driver'],
            'updated_by' => auth()->id(),
        ]);

        return $this->apiCode(200)
            ->apiBody([
                'data' => new FrequencyTransmissionResource($frequencyTransmission->fresh()),
            ])
            ->apiMessage('')
            ->apiInfo('captain frequency transmissions decide success')
            ->apiResponse();
    }
}

