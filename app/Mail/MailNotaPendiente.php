<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotaPendiente extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Aviso de inscripcion de nota pendiente';
    public $DatosEmail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($DatosEmail)
    {
        $this->DatosEmail = $DatosEmail;    
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notapendiente');
    }
}
