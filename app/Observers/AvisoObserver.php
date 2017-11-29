<?php

namespace App\Observers;

use App\Seguimiento;
use App\HsSeguimiento;
use App\Aviso;
use App\Hactividade;
use App\Cliente;
use App\Plantel;
use Carbon\Carbon;

class AvisoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public $Aviso;
    public function created(Aviso $aviso)
    {
        $this->Aviso=$aviso;
        $seguimiento=Seguimiento::find($this->Aviso->seguimiento_id);
        //dd($seguimiento->toArray());
        $h=new Hactividade();
        
        $h->cliente_id=$seguimiento->cliente_id;  
        $h->seguimiento_id=$this->Aviso->seguimiento_id;
        $h->tarea='Aviso';
        $h->fecha=Carbon::now();
        $h->hora=Carbon::now();
        $h->asunto=$this->Aviso->asunto->name;
        $h->detalle=$this->Aviso->detalle;
        $h->usu_alta_id=$this->Aviso->usu_alta_id;
        $h->usu_mod_id=$this->Aviso->usu_mod_id;

        //dd($h);
        
        $h->save();
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
     public function deleting(Seguimiento $Seguimiento){
        
     }

    /*public function updated(Seguimiento $Seguimiento)
    {
        $this->AsignacionTarea=$asignacionTarea;
        $seguimiento=Seguimiento::where('cliente_id', '=', $this->AsignacionTarea->cliente_id)->first();
        $h=new Hactividade();
        
        $h->cliente_id=$this->AsignacionTarea->cliente_id;  
        $h->seguimiento_id=$seguimiento->id;
        $h->tarea=$this->AsignacionTarea->tarea->name;
        $h->fecha=Carbon::now();
        $h->hora=Carbon::now();
        $h->asunto=$this->AsignacionTarea->asunto->name;
        $h->detalle=$this->AsignacionTarea->detalle;
        $h->usu_alta_id=$this->Seguimiento->usu_alta_id;
        $h->usu_mod_id=$this->Seguimiento->usu_mod_id;

        //dd($hactividad);
        
        $h->save();
    }*/

}