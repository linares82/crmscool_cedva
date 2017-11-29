<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Cliente;

class CorreoBienvenida extends Mailable
{
    use Queueable, SerializesModels;

    public $cli;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cliente $cli)
    {
        $this->$cli=$cli;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.2')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Confirmación de Coreo');
    }
}
