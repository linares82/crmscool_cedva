<?php

namespace App\Observers;

use App\Empleado;
use App\Cliente;
use App\Plantel;

class EmpleadoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
     public $empleado;
    public function creating(Empleado $empleado)
    {
        //dd("hi fil");
        $mes=date('m');
        $year=date('y');
        $cadena0="00000";
        
        $this->empleado=$empleado;
        $plantel=Plantel::find($this->empleado->plantel_id);
        $plantel->cns_empleado=$plantel->cns_empleado+1;
        $plantel->save();

        $str=substr($cadena0, 0, strlen($cadena0)- strlen($plantel->cns_empleado));

        $this->empleado->cve_empleado=$mes.$year.$plantel->cve_plantel.$str.$plantel->cns_empleado;
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function updating(Empleado $empleado)
    {
        //
    }
}