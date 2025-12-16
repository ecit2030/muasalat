<?php

namespace App\Events;

use App\Models\Trip;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DriverUpdateLocationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Trip $trip;
    public array $distance;
    public array $sourceDistance;
    public array $driverLocationNow;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($trip, $distance,$driverLocationNow,$sourceDistance)
    {
        $this->trip = $trip;
        $this->distance = $distance;
        $this->sourceDistance = $sourceDistance;
        $this->driverLocationNow = $driverLocationNow;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('update_driver_location.' . $this->trip->id);
    }

//    public function broadcastWith()
//    {
//        return [
//            'trip_id' => $this->trip->id,
//            'distance_now_between_driver_and_destination' => $this->distance['distance'],
//            'duration_now_between_driver_and_destination' => $this->distance['duration'],
//        ];
//    }
}
