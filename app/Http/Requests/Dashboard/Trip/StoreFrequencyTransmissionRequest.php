<?php

namespace App\Http\Requests\Dashboard\Trip;

use App\Models\User;
use App\Models\FrequencyTransmission;
use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use Carbon\Carbon;

class StoreFrequencyTransmissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:100',

            'driver_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:user_vehicles,id',

            'origin.location' => 'nullable|string|max:200',
            'destination.location' => 'nullable|string|max:200',

            'origin.lat' => 'nullable|string|max:200',
            'destination.lat' => 'nullable|string|max:200',

            'origin.lng' => 'nullable|string|max:200',
            'destination.lng' => 'nullable|string|max:200',

            'repeat' => 'nullable|array|min:1|max:7',
            'repeat.*' => 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',

            'date_trans' => 'required|date',

            'specificlocation' => 'nullable|string|max:255', 
            'relay_point' => 'nullable|string|max:255', 

            'is_active' => 'nullable|boolean',
            'status_driver' => 'nullable|in:0,1,2',

            'map_route_data' => 'nullable',
            'details' => 'nullable',

            'oneway_price' => 'nullable|numeric|min:0',
            'round_price' => 'nullable|numeric|min:0',
        ];
    }

    protected function prepareForValidation()
	{
	    $this->merge([
	        'is_active' => $this->has('is_active') ? 1 : 0,
	        'status_driver' => $this->status_driver ?? 0,
	    ]);
	}

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $driverId = $this->driver_id;
            $vehicleId = $this->vehicle_id;

            // Conflict check (same driver or vehicle same day)
            $conflicts = FrequencyTransmission::where('is_active', 1)
                ->whereDate('date_trans', Carbon::parse($this->date_trans)->toDateString())
                ->where(function ($q) use ($driverId, $vehicleId) {
                    $q->where('driver_id', $driverId)
                      ->orWhere('vehicle_id', $vehicleId);
                })
                ->get();

            foreach ($conflicts as $old) {

                $intersection = array_intersect(
                    $old->repeat ?? [],
                    $this->repeat ?? []
                );

                if (!empty($intersection)) {
                    $validator->errors()->add(
                        'repeat',
                        'Driver or vehicle already assigned on overlapping days.'
                    );
                    break;
                }
            }

            // Driver check
            $driver = User::find($driverId);

            if ($driver && Carbon::now() > $driver->driver_license_end_date) {
                $validator->errors()->add(
                    'driver',
                    __("messages.your_driver_lisence_is_expired")
                );
            }
        });
    }
}