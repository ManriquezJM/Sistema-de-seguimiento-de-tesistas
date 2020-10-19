<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailAceptacionFit extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Actualizacion formulario de inscripcion de tesis';
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
        return $this->view('emails.aceptacionfit');
    }
}
