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
            ->whereIn('status_driver', [0, 1])
            ->latest('id');

        if ($request->filled('status_driver') && in_array($request->status_driver, [0, 1])) {
            $query->where('status_driver', (int) $request->status_driver);
        } else {
            $query->whereIn('status_driver', [0, 1]);
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
            'is_active' => ((int) $data['status_driver'] === 1) ? 1 : 0,
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

    public function completed_trip(Request $request, FrequencyTransmission $frequencyTransmission)
    {
        if ($frequencyTransmission->driver_id !== auth()->id()) {
            return $this->apiCode(403)
                ->apiBody([])
                ->apiMessage(t_("you dont have permisssion to access this resource"))
                ->apiInfo('captain frequency transmissions forbidden')
                ->apiResponse();
        }

        // Prevent completing already finished trip
        if ($frequencyTransmission->is_active == 2) {
            return $this->apiCode(400)
                ->apiBody([])
                ->apiMessage(t_("trip already completed"))
                ->apiInfo('captain frequency transmission already completed')
                ->apiResponse();
        }

        // active trips (is_active = 1) can become completed (is_active = 2).
        if ($frequencyTransmission->is_active != 1) {
            return $this->apiCode(400)
                ->apiBody([])
                ->apiMessage(t_("trip is not active"))
                ->apiInfo('invalid trip state')
                ->apiResponse();
        }
        
        $frequencyTransmission->update([
            'is_active' => 2,
            'updated_by' => auth()->id(),
        ]);

        return $this->apiCode(200)
            ->apiBody([
                'data' => new FrequencyTransmissionResource($frequencyTransmission->fresh()),
            ])
            ->apiMessage('')
            ->apiInfo('captain frequency transmissions completed success')
            ->apiResponse();
    }
}

