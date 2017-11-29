<?php

namespace App\Events;

use App\Cliente;
use App\Empleado;
use Illuminate\Queue\SerializesModels;


class ClienteUpdating
{
    
    protected $cliente;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Cliente $cliente)
    {
        $c1=Cliente::find($cliente->id);
        $this->cliente=$cliente;
        if($c1->st_cliente_id==1 and $this->cliente->st_cliente_id>1){
            $empleado=Empleado::find($this->cliente->empleado_id);
            $empleado->pendientes=$empleado->pendientes-1;
            $empleado->save();        
        }
        if($c1->st_cliente_id>1 and $this->cliente->st_cliente_id==1){
            $empleado=Empleado::find($this->cliente->empleado_id);
            $empleado->pendientes=$empleado->pendientes+1;
            $empleado->save();        
        }
        
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
