<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\Trip;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndTripCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:finish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'finishes the trip if still open and driver or captain didnt close it';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Trip::query()
            ->with(['track.driver.deviceTokens', 'client.deviceTokens'])
            ->whereNotNull("start_at")
            ->whereNull("end_at")
            ->whereDate("date", now()->toDateString())
            ->get()
            ->filter(function ($trip) {
                $startTime = $trip->origin['start_time'];
                $duration = $trip->destination['duration'];
                $splitDuration = explode(':', $duration);
                $endAt = Carbon::parse($trip->date . ' ' . $startTime)->addHours($splitDuration[0])->addMinutes($splitDuration[1]);

                if (now()->gt($endAt->addMinutes(10))) {
                    $trip->update([
                        "end_at" => now()
                    ]);
                    $tokens = $trip->track?->driver?->sendableTokens;
                    $trip->track?->driver?->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_trip") . " " . $trip->track?->name . " " . t_("messages.have_been_finished") . " " . t_("by_system"), FCMTopic::DRIVER_TRIP_FINISHED, FCMAction::DRIVER_OPEN_PREVIOUS_TRIPS, $trip->track_id));
                    $tokens = $trip->client?->sendableTokens;
                    $trip->client?->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_trip") . " " . $trip->track?->name . " " . t_("messages.have_been_finished") . " " . t_("by_system"), FCMTopic::CLIENT_TRIP_FINISHED, FCMAction::CLIENT_OPEN_PREVIOUS_TRIPS, $trip->id));
                }
                return $trip;
            });
    }
}
