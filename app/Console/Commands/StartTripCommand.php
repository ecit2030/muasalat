<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Console\Command;

class StartTripCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check if user has a trip to start every minute';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = now()->format('H:i');
        $tracks = [];

        $users = User::role("user")
            ->withWherehas("clientTrips", function ($q) use ($start) {
                $q->whereNull('start_at')
                    ->where("origin->start_time", "<=", $start)
                    ->where("date", now()->toDateString());
            })->with(["deviceTokens"])
            ->distinct()
            ->get();

        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            foreach ($user->clientTrips as $trip) {
                array_push($tracks, $trip->track_id);
                $trip->start_at = now();
                $trip->save();
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_started") . $trip->origin["location"] . $trip->destination["location"], FCMTopic::CLIENT_TRIP_STARTED, FCMAction::CLIENT_OPEN_CURRENT_TRIPS, $trip->id));
            }
        }

        $users = User::role("captain")
            ->withWherehas("captainTracks", function ($q) use ($tracks) {
                $q->whereIn('id', $tracks);
            })
            ->with(["deviceTokens"])
            ->distinct()
            ->get();


        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            foreach ($user->captainTracks as $track) {
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_started") . $track->origin["location"] . $track->destination["location"], FCMTopic::DRIVER_TRIP_STARTED, FCMAction::DRIVER_OPEN_CURRENT_TRIPS, $track->id));
            }
        }

        $users = User::role("driver")
            ->withWherehas("driverTracks", function ($q) use ($tracks) {
                $q->whereIn('id', $tracks);
            })
            ->with(["deviceTokens"])
            ->distinct()
            ->get();

        foreach ($users as $user) {
            $tokens[] = $user->sendableTokens;
            foreach ($user->driverTracks as $track) {
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_started") . $track->origin["location"] . $track->destination["location"], FCMTopic::DRIVER_TRIP_STARTED, FCMAction::DRIVER_OPEN_CURRENT_TRIPS, $track->id));
            }
        }

        return 1;
    }
}
