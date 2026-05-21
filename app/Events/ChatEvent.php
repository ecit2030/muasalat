<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chat_id;
    public $message;

    public function __construct($chat_id, $message)
    {
        $this->chat_id = $chat_id;
        $this->message = $message instanceof JsonResource
            ? $message->resolve()
            : $message;
    }

    public function broadcastOn()
    {
        return new Channel('chat.' . $this->chat_id);
    }

    public function broadcastWith(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message' => $this->message,
        ];
    }
}
