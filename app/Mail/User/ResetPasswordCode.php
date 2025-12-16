<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordCode extends Mailable
{
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $code;
    protected $title;
    protected $message;

    public function __construct($code, $title, $message)
    {
        $this->code = $code;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.reset_password_code', [
            'code' => $this->code,
            'title' => $this->title,
            'message' => $this->message,
        ])
            ->subject(t_('Reset Password Code'))->from(env(
                'MAIL_FROM_ADDRESS',
                'no-replay@on-wingez.com'
            ), 'No Replay');
    }
}
