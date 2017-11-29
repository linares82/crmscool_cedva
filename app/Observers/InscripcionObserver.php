<?php

namespace App\Observers;

use App\Inscripcion;
use App\Alumno;
use App\Cliente;
use App\Plantel;
use App\Grupo;

class InscripcionObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public $inscripcion;
    public function created(Inscripcion $inscripcion)
    {
        //dd("hi fil");
        $mes=date('m');
        $year=date('y');
        $cadena0="00000";
        
        $this->inscripcion=$inscripcion;
        //dd($this->inscripcion);
        $cliente=Cliente::find($inscripcion->cliente_id);
        //dd($cliente);
        if($cliente->cve_alumno==null){
            $plantel=Plantel::find($cliente->plantel_id);
            $plantel->cns_alumno=$plantel->cns_alumno+1;
            $plantel->save();

            $str=substr($cadena0, 0, strlen($cadena0)- strlen($plantel->cns_alumno));

            $cliente->cve_alumno=$mes.$year.$plantel->cve_plantel.$str.$plantel->cns_alumno;
            //dd($cliente);
            $cliente->save();
        }
        $grupo=Grupo::find($inscripcion->grupo_id);
        $grupo->registrados=$grupo->registrados+1;
        $grupo->save();

        
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function updating(Inscripcion $inscripcion)
    {
        //
    }

    public function deleted(Inscripcion $inscripcion){
        $grupo=Grupo::find($inscripcion->grupo_id);
        $grupo->registrados=$grupo->registrados-1;
        $grupo->save();
    }
}