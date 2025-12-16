<?php

namespace Modules\Code\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $reason;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, string $email, string $reason)
    {
        $this->title = $title;
        $this->message = $message;
        $this->email = $email;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->reason == "") {
            return $this->subject(
                config('app.name') . ' ' . $this->title
            )->markdown('email.activateAccount', [
                'name' => $this->title,
                'message' => $this->message,
                'email' => $this->email,
                'reply' => '',
            ]);
        }

        return $this->subject(
            config('app.name') . ' ' . $this->title
        )->markdown('email.deactivateAccount', [
            'name' => $this->title,
            'message' => $this->message,
            'email' => $this->email,
            'reason' => $this->reason,
            'reply' => '',
        ]);
    }
}
