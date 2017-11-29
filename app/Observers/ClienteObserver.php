<?php

namespace App\Observers;

use App\Empleado;
use App\Cliente;

class ClienteObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(Cliente $cliente)
    {
        /*$empleado=Empleado::find($cliente->empleado_id);
        $empleado->pendientes=$empleado->pendientes+1;
        $empleado->save();
        */
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  User  $user
     * @return void
     */
    public function updating(Cliente $cliente)
    {
        //
    }
}