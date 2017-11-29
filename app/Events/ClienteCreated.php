<?php

namespace App\Events;

use App\Cliente;
use App\Empleado;
use Illuminate\Queue\SerializesModels;


class ClienteCreated
{
    
    protected $cliente;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cliente $cliente)
    {
        $this->cliente=$cliente;
        $empleado=Empleado::find($this->cliente->empleado_id);
        $empleado->pendientes=$empleado->pendientes+1;
        $empleado->save();
        //Asignar clave
        
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        
    }
}
