<?php

namespace App\Observers;

use App\Alumno;
use App\Cliente;
use App\Plantel;

class AlumnoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
     public $alumno;
    public function creating(Alumno $alumno)
    {
        //dd("hi fil");
        $mes=date('m');
        $year=date('y');
        $cadena0="00000";
        
        $this->alumno=$alumno;
        $plantel=Plantel::find($this->alumno->plantel_id);
        $plantel->cns_alumno=$plantel->cns_alumno+1;
        $plantel->save();

        $str=substr($cadena0, 0, strlen($cadena0)- strlen($plantel->cns_alumno));

        $this->alumno->cve_alumno=$mes.$year.$plantel->cve_plantel.$str.$plantel->cns_alumno;
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