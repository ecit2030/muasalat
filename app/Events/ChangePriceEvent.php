<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangePriceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $otherMin;
    public $otherMax;
    public $talebatMin;
    public $talebatMax;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($otherMin, $otherMax, $talebatMin, $talebatMax)
    {
        $this->otherMin = $otherMin;
        $this->otherMax = $otherMax;
        $this->talebatMin = $talebatMin;
        $this->talebatMax = $talebatMax;
    }

}
