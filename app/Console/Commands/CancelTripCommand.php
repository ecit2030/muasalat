<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\Trip;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelTripCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cancel trip if date is in past in hour';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oneHourLater = now()->subHour();

        $trips = Trip::query()
            ->with(['driver.deviceTokens', 'client.deviceTokens'])
            ->where("parent_id", 0)
            ->where(function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->whereNull("start_at")
                    ->whereNull("end_at");
                })->orWhere(function ($subQuery) {
                    $subQuery->whereNotNull("start_at")
                    ->whereNull("end_at");
                });
            })
            ->where("is_canceled", false)
            ->where(function ($query) use ($oneHourLater) {
                $query->where(function ($subQuery) {
                    $subQuery->where('date', '<', now()->toDateString());
                })
                ->orWhere(function ($subQuery) use ($oneHourLater) {
                    $subQuery->where('date', now()->toDateString())
                            ->where('time', '<=', $oneHourLater->toTimeString());
                });
            })
            ->get();

        foreach ($trips as $trip) {
            $trip->update([
                'is_canceled' => 1
            ]);

            if ($trip->report?->reservation_type != 'other') {
                $trip->children()->update([
                    'is_canceled' => true,
                ]);
            }

            $tokens = $trip->client->sendableTokens;
            $trip->client->notify(new FcmNotification(
                $tokens, 
                t_("messages.you_have_new_notification"),
                __('messages.trip is canceled', ['trip' => $trip->id]),
                FCMTopic::CLIENT_CANCELED_TRIP, 
                FCMAction::CLIENT_OPEN_CURRENT_TRIPS, 
                $trip->id
            ));
        }

    }
}
