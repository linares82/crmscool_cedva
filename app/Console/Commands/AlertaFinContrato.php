<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Empleado;
use DB;
use App\Mail\AlertaFinContrato as alerta;
use Mailgun;

class AlertaFinContrato extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ian:FinContratos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa fechas de fin de contrato y envia arletas si esta activa la misma';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $empleados=Empleado::select(DB::raw('distinct(r.mail)'),'empleados.resp_alerta_id', 'r.mail_empresa', 
                                    'j.mail as j_mail', 'j.mail_empresa as j_mail_empresa', 'empleados.dias_alerta')
                                ->join('empleados as r', 'r.id', '=', 'empleados.resp_alerta_id')
                                ->leftJoin('empleados as j', 'j.id', '=', 'empleados.jefe_id')
                                ->where('empleados.alerta_bnd', '=', 1)
                                ->whereDate('empleados.fin_contrato', '>=', date('Y/m/d'))
                                ->get();

        //dd($empleados->toArray());
        foreach($empleados as $e){
            //$fecha_valida=Carbon->now()->addDays($e->dias_alerta);
            
            $alertas=Empleado::select(DB::raw("concat(empleados.nombre,' ',empleados.ape_paterno, ' ',empleados.ape_materno) as nombre"), 
                                'empleados.dias_alerta', 'empleados.fin_contrato')
                    ->join('empleados as r', 'r.id', '=', 'empleados.resp_alerta_id')
                    ->leftJoin('empleados as j', 'j.id', '=', 'empleados.jefe_id')
                    ->where('empleados.alerta_bnd', '=', 1)
                    ->whereBetween(DB::raw('DATEDIFF(CURDATE(),empleados.fin_contrato)'), ['0','empleados.dias_alerta'])
                    ->whereDate('empleados.fin_contrato', '>=', date('Y/m/d'))
                    ->where('empleados.resp_alerta_id', '=', $e->resp_alerta_id)
                    ->get();
            $mail=$e->mail;
            $jefe_mail=$e->j_mail;
            //dd($alertas);
            
            /*\Mail::send('emails.alertaFinContrato', 
				array('ps'=>$alertas), 
				function($message) use($mail, $jefe_mail) 
                {
                    $message->to($mail);
                    if(!is_null($jefe_mail)){
                        $message->cc($jefe_mail);	
                    }
                    $message->subject('Alerta Contratos Por Vencer');
                });
                */
            
            $respuesta=Mailgun::send('emails.alertaFinContrato', 
                array('ps'=>$alertas),  
                function ($message) use($mail, $jefe_mail) {
                    $message->to($mail);
                    if(!is_null($jefe_mail)){
                        $message->cc($jefe_mail);	
                    }
                    $message->subject('Alerta Contratos Por Vencer');
            });	
            //dd($respuesta);
        }
    }
}
