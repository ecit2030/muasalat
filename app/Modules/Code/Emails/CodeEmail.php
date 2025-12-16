<?php

namespace Modules\Code\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, string $code)
    {
        $this->title = $title;
        $this->message = $message;
        $this->code = $code;
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
        )->markdown('Code::emails.verficationMail', [
            'message' => $this->message,
            'code' => $this->code,
        ]);
    }
}
