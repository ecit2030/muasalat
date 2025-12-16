<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendSmsMessageEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message ;
    public $code_number ;
    public $phone ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($code_number , $message , $phone)
    {
        $this->code_number = $code_number ;
        $this->message = $message ;
        $this->phone = $phone ;
    }
}
