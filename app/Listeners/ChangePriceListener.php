<?php

namespace App\Listeners;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\User;
use App\Notifications\FcmNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ChangePriceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ["captain", "driver", "organization"]);
        })->whereHas("tracks")->with('deviceTokens')->get();

        $message = __("messages.price_range_is_changed_to_be") . $event->otherMin . t_("for") . t_("other min") . "," . " "
            . $event->otherMax . t_("for") . t_("other max") . "," . " "
            . $event->talebatMin . t_("for") . t_("talebat min") . "," . " "
            . $event->talebatMax . t_("for") . t_("talebat max");

        foreach ($users as $user) {
            $tokens = $user->sendableTokens;
            tap($user)->update([
                'update_price' => 1,
            ])->fresh();
            $user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), $message, FCMTopic::CLIENT_PRICE_CHANGED, FCMAction::CLIENT_OPEN_UPCOMING_TRIPS));
        }
    }
}
