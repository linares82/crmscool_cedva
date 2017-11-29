<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Plantilla;

class Correo extends Mailable
{
    use Queueable, SerializesModels;

    public $p;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Plantilla $plantilla)
    {
        $this->p=$plantilla;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.7')
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->attach(storage_path('app') . "/plantillas_correos/" . $this->p->img1)
                    ->subject($this->p->asunto);
    }
}
