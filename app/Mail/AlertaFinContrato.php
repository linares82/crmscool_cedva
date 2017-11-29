<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Plantilla;

class AlertaFinContrato extends Mailable
{
    use Queueable, SerializesModels;

    public $p;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($alertas)
    {
        $this->p=$alertas;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->p);
        return $this->view('emails.alertaFinContrato', array('ps'=>$this->p))
                    ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
                    ->subject('Contratos con vencimiento próximo');
    }
}
