<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevaSolicitudDeVehiculo extends Mailable
{
    use Queueable, SerializesModels;

    public $mensaje,$titulo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($titulo,$mensaje)
    {
        //
        $this->mensaje = $mensaje;
        $this->titulo = $titulo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email');
    }
}
