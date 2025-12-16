<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\User;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TripIsOnNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check if user has a trip in 30 minutes from now and sends a notification for him';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $start = now()->format('H:i');
        $end = now()->addHour()->format('H:i');

        $users = User::role("user")
            ->withWherehas("clientTrips", function ($q) use ($start, $end) {
                $q->where("origin->start_time", ">=", $start)
                    ->where("date", now()->toDateString())
                    ->where("origin->start_time", "<=", $end);
            })->with(["deviceTokens"])
            ->distinct()
            ->get();

        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            foreach ($user->clientTrips as $trip) {
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_about_to_start") . $trip->origin["location"] . $trip->destination["location"], FCMTopic::CLIENT_TRIP_STARTING_SOON, FCMAction::CLIENT_OPEN_UPCOMING_TRIPS, $trip->id));
            }
        }

        $users = User::role("captain")
            ->withWherehas("captainTracks", function ($q) use ($start, $end) {
                $q->where("origin->start_time", ">=", $start)
                    ->whereJsonContains("repeat", Carbon::now()->englishDayOfWeek)
                    ->where("origin->start_time", "<=", $end);
            })->with(["deviceTokens"])
            ->distinct()
            ->get();


        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            foreach ($user->captainTracks as $track) {
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_about_to_start") . $track->origin["location"] . $track->destination["location"], FCMTopic::DRIVER_TRIP_STARTING, FCMAction::DRIVER_OPEN_UPCOMING_TRIPS, $track->id));
            }
        }

        $users = User::role("driver")
            ->withWherehas("driverTracks", function ($q) use ($start, $end) {
                $q->where("origin->start_time", ">=", $start)
                    ->whereJsonContains("repeat", Carbon::now()->englishDayOfWeek)
                    ->where("origin->start_time", "<=", $end);
            })
            ->with(["deviceTokens"])
            ->distinct()
            ->get();


        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            foreach ($user->driverTracks as $track) {
                $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.trip_about_to_start") . $track->origin["location"] . $track->destination["location"], FCMTopic::DRIVER_TRIP_STARTING, FCMAction::DRIVER_OPEN_UPCOMING_TRIPS, $track->id));
            }
        }

        return 1;
    }
}
