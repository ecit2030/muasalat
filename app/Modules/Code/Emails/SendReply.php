<?php

namespace Modules\Code\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReply extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name  ,string $reply)
    {
        $this->name = $name;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(
            config('app.name')
        )->markdown('email.sendReply', [
            'name' => $this->name,
            'reply' => $this->reply,
        ]);
    }
}
