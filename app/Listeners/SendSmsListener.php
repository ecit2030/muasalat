<?php

namespace App\Listeners;

use App\Events\SendSmsMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class SendSmsListener
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
     * @param  \App\Events\SendSmsMessageEvent  $event
     * @return void
     */
    public function handle(SendSmsMessageEvent $event)
    {
        $number = preg_replace("/^05/", "9665", $event->phone);

        try {
            $response = Http::post('https://api-sms.4jawaly.com/api/v1/sendsms', [
                "username" => "4sWAbjaYjc27ZSwdhfDxzK4Gg0yO4pWg61ac9JwI",
                "password" => "Q7AHqMmlskxrRQ4uXWugQ0AUEdGSyMivAIfo1jt1W5aql8UTxJ88CDrag5o7HPzhxDDr138o5WEdrheEEN6Mj4PXL30Ty3tOYM0B",
                "message" => $event->message . " " . $event->code_number,
                "sender" => "muasalat",
                "numbers" => $number
            ]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
