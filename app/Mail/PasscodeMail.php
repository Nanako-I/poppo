<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasscodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $passcode;

    public function __construct($passcode)
    {
        $this->passcode = $passcode;
    }

    public function build()
    {
        return $this->subject('パスコードのご連絡')->view('emails.passcode');
    }
}
