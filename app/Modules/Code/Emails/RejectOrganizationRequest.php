<?php

namespace Modules\Code\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectOrganizationRequest extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message , string $email)
    {
        $this->title = $title;
        $this->message = $message;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(
            config('app.name') . ' '.$this->title
        )->markdown('email.RejectOrganizationRequest', [
            'message' => $this->message
        ]);
    }
}
