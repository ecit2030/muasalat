<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\Trip;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;


class CancelTripIfClientNotPaidCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trip:cancel-if-client-not-paid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cancel trip if client not paid in period from dashboard';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $general = setting('general');
        $minutes = data_get($general, "client_trip_payment_time_before_cancel", 1);
        $now = Carbon::now();

        $trips = Trip::query()
            ->with(['driver.deviceTokens', 'client.deviceTokens'])
            ->where("parent_id", 0)
            ->whereNull("start_at")
            ->whereNull("end_at")
            ->where("is_canceled", false)
            ->whereHas('report', function ($query) use ($minutes) {
                $query->where('is_paid', 0);
            })
            ->has("driver")
            ->where(function ($query) use ($minutes, $now) {
                $query->where(function ($subQuery) use ($minutes, $now) {
                    $subQuery->whereHas('report', function ($query) use ($minutes, $now) {
                        $query->where('reservation_type', 'other')
                            ->where('accepted_time_for_driver', '<=', $now->subMinutes($minutes)->format('Y-m-d H:i'));
                    });
                });
            })
            ->get();
        info('triiiiiiiiiiiiiiiiiip');
        info($trips->count());
        info($now->subMinutes($minutes)->format('Y-m-d H:i'));

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

            Notification::send($trip?->driver, new FcmNotification(
                $trip?->driver?->deviceTokens?->pluck('token')->toArray(),
                ['ar' => __("messages.you_have_new_notification", [], 'ar'),
                    'en' => __("messages.you_have_new_notification", [], 'en')],
                ['ar' => __("messages.client cancel :trip and reason is :reason", ['trip' => $trip->id, 'reason' => __('not paid', [], 'ar')], 'ar'),
                    'en' => __("messages.client cancel :trip and reason is :reason", ['trip' => $trip->id, 'reason' => __('not paid', [], 'en')], 'en')],
                FCMTopic::CLIENT_CANCELED_TRIP,
                FCMAction::DRIVER_OPEN_CURRENT_TRIPS,
                $trip?->id,
            ));
        }

    }
}
