<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class alert extends Mailable
{
    use Queueable, SerializesModels;

    public $composeMail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($composeMail)
    {
         $this->composeMail = $composeMail;
    }

    /**
     * Build the composeMail.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Alerta de nueva referencia')->view('emails.alert');
    }
}
