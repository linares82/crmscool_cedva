<?php

namespace App\Observers;

use App\Seguimiento;
use App\HsSeguimiento;
use App\Hactividade;
use App\Cliente;
use App\Plantel;
use Carbon\Carbon;

class SeguimientoObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public $Seguimiento;
    public function created(Seguimiento $Seguimiento)
    {
        $this->Seguimiento=$Seguimiento;
        $h=new Hactividade();
        
        $h->cliente_id=$this->Seguimiento->cliente_id;  
        $h->seguimiento_id=$this->Seguimiento->id;
        $h->tarea='Seguimiento';
        $h->fecha=Carbon::now();
        $h->hora=Carbon::now();
        $h->asunto='Creacion';
        $h->detalle=$this->Seguimiento->stSeguimiento->name;
        $h->usu_alta_id=$this->Seguimiento->usu_alta_id;
        $h->usu_mod_id=$this->Seguimiento->usu_mod_id;

        //dd($hactividad);
        
        $h->save();
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
     public function deleting(Seguimiento $Seguimiento){
        /*$this->Seguimiento=$Seguimiento;
        $s=Seguimiento::find($this->Seguimiento->id);
        //dd($s->toArray());
        if($this->Seguimiento->st_seguimiento_id<>$s->st_seguimiento_id){
            $hs['seguimiento_id']=$this->Seguimiento->id;
            $hs['cliente_id']=$this->Seguimiento->cliente_id;  
            $hs['st_seguimiento_id']=$this->Seguimiento->st_seguimiento_id;
            $hs['st_anterior_id']=$s->st_seguimiento_id;
            $hs['mes']=$this->Seguimiento->mes;
            $hs['usu_alta_id']=$this->Seguimiento->usu_alta_id;
            $hs['usu_mod_id']=$this->Seguimiento->usu_mod_id;
            $hs['created_at']=$this->Seguimiento->created_at;
            $hs['updated_at']=$this->Seguimiento->updated_at;
            $hs['deleted_at']=$this->Seguimiento->deleted_at;
            $h=new HsSeguimiento();
            $h->save($hs);
        }
         * 
         */
     }

    public function updated(Seguimiento $Seguimiento)
    {
        $this->Seguimiento=$Seguimiento;
        $h=new Hactividade();
        
        $h->cliente_id=$this->Seguimiento->cliente_id;  
        $h->seguimiento_id=$this->Seguimiento->id;
        $h->tarea='Seguimiento';
        $h->fecha=Carbon::now();
        $h->hora=Carbon::now();
        $h->asunto='Cambio estatus ';
        $h->detalle=$this->Seguimiento->stSeguimiento->name;
        $h->usu_alta_id=$this->Seguimiento->usu_alta_id;
        $h->usu_mod_id=$this->Seguimiento->usu_mod_id;

        //dd($hactividad);
        
        $h->save();
    }

}