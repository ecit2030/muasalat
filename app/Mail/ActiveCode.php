<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActiveCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $code;
    protected $info;
    protected $emails;

    public function __construct($code)
    {
        $this->code = $code;
        //info
        $this->info = setting('info');

        //user code email
        $emails = setting('emails');
        $this->emails = $emails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.active_code', [
            'code' => $this->code,
            'emails' => $this->emails,
            'info' => $this->info,
        ])->subject($this->emails['active_user']['subject'])
            ->from($this->info['email'], $this->emails['from_name']);
    }
}
