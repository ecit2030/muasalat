<?php

namespace Modules\Code\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $message;
    public $password;
    public $email;
    public $mobile;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $title, string $message, string $password , string $email,string $mobile = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->password = $password;
        $this->email = $email;
        $this->mobile = $mobile;
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
        )->markdown('email.SendPassword', [
            'message' => $this->message,
            'password' => $this->password,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);
    }
}
