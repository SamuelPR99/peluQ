<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecuperarPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $resetUrl;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($resetUrl)
    {
        $this->resetUrl = $resetUrl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.recuperar_password')
                    ->subject('Recuperación de Contraseña')
                    ->with([
                        'resetUrl' => $this->resetUrl,
                    ]);
    }
}