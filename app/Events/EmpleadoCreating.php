<?php

namespace App\Events;

use App\Plantel;
use App\Empleado;
use Illuminate\Queue\SerializesModels;


class EmpledaoCreating
{
    
    protected $empleado;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Empleado $empleado)
    {
        //dd("hi fil");
        $this->empleado=$empleado;
        $plantel=Plantel::find($this->empleado->plantel_id);
        $plantel->cns_empleado=$plantel->cns_empleado+1;
        $plantel->save();
        $this->empleado->cve_empleado=$plantel->cns_empleado;
        
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
