<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Sms;
use App\Plantilla;
use App\Cliente;
use App\Sm;
use DB;
use App\Param;

class EnviarSms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ian:EnviarSms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia mensajes dado un telefono y un mensaje';

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
        //Ejemplo deenvio de correos
        /*
        $r=Param::where('llave','=', 'sms')->first();
        if($r->value=='activo'){
            dd($r);
            $message  = "Hello Phone de prueba!";
            $to       = "+527221569361";
            $from     = "+13093196909";
            $response = Sms::send($message,$to,$from);    
        }
        */
        $c=0;
        $cantidad_enviada=0;
        
        $r=Param::where('llave','=', 'correo_electronico')->first();
        //dd($r->valor);
        if($r->valor=='activo'){
            
            $ps=Plantilla::select('id', 'st_cliente_id', 'dia', 'tpo_correo_id', 'para_nombre', 'asunto', 'activo_bnd','mail_bnd', 'sms_bnd', 'sms', 'nivel_id')
                ->where('tpo_correo_id', '<>', '1')
                ->where('sms_bnd', '=', '1')
                ->orderBy('tpo_correo_id', 'asc')
                ->get();
            //dd($ps);
            
            foreach($ps as $p){
                //dd($p->toArray());
                $cuenta=0;                
                switch ($p->tpo_correo_id) {
                    case '2': //revisar definicion
                        /*if($p->activo_bnd==1){
                            //dd($status_array);
                            $dia=date("j");
                            if($dia==$p->dia){
                                //dd($p->nivel_id);
                                $clis=DB::table('clientes')->where('nivel_id', $p->nivel_id)->get();
                                //dd($clis);
                                try{
                                    foreach($clis as $cli){
                                        if($cli->celular_confirmado==1){
                                            $to       = '+52'.$cli->tel_cel;
                                            $from     = "+13093196909";
                                            $message  = $p->sms;
                                            $response = Sms::send($message,$to,$from);    
                                            $cantidad_enviada++;
                                        }
                                    }
                                    //$m->queue(new Correo($p));
                                    //dd('correo enviado');
                                }catch(\Exception $e){
                                dd($e);
                                }
                            }
                        }
                        break;
                        */
                    case '3':
                        if($p->activo_bnd==1){
                            $status_array='';
                            $aux=0;
                            foreach($p->estatus as $st){
                                //dd($st->id);
                                if($aux==0){
                                    $status_array=$status_array.$st->id;
                                }else{
                                    $status_array=",".$status_array.$st->id;
                                }
                            }
                            
                            //dd($status_array);
                            $dia=date("j");
                            if($p->inicio<=$dia and $p->fin>=$dia){
                                //dd($dia);
                                $clis=DB::table('clientes')->whereIn('st_cliente_id', [$status_array])->get();
                                //dd($clis);
                                
                                try{
                                    foreach($clis as $cli){
                                        if($cli->celular_confirmado==1){
                                            $to       = '+52'.$cli->tel_cel;
                                            $from     = "+13093196909";
                                            $message  = $p->sms;
                                            $response = Sms::send($message,$to,$from);    
                                            $cantidad_enviada++;
                                        }
                                    }
                                    //$m->queue(new Correo($p));
                                    dd('correo enviado');
                                }catch(\Exception $e){
                                dd($e);
                                }
                            
                            }
                        }
                        break;
                    case '4':
                        if($p->activo_bnd==1){
                            $status_array='';
                            $aux=0;
                            foreach($p->estatus as $st){
                                //dd($st->id);
                                if($aux==0){
                                    $status_array=$status_array.$st->id;
                                }else{
                                    $status_array=",".$status_array.$st->id;
                                }
                            }
                            
                            //dd($status_array);
                            $dia=date("j");
                            if($dia==$p->dia){
                                //dd($dia);
                                $clis=DB::table('clientes')->whereIn('st_cliente_id', [$status_array])->get();
                                //dd($clis->toArray());
                                
                                try{
                                    foreach($clis as $cli){
                                        if($cli->celular_confirmado==1){
                                            $to       = '+52'.$cli->tel_cel;
                                            $from     = "+13093196909";
                                            $message  = $p->sms;
                                            $response = Sms::send($message,$to,$from);    
                                            $cantidad_enviada++;
                                            
                                        }
                                    }
                                    
                                }catch(\Exception $e){
                                dd($e);
                                }
                            }
                        }
                    break;
                    case '5':
                        if($p->activo_bnd==1){
                            $status_array='';
                            $especialidades_array();
                            $aux_estatus=0;
                            $aux_expecialidad=0;
                            foreach($p->estatus as $st){
                                //dd($st->id);
                                if($aux_estatus==0){
                                    $status_array=$status_array.$st->id;
                                }else{
                                    $status_array=",".$status_array.$st->id;
                                }
                            }
                            /*foreach($p->especialidad as $especialidad){
                                if($aux_especialidad==0){
                                    $especialidad_array=$especialidad_array.$especialidad->id;
                                }else{
                                    $especialidad_array=",".$especialidad_array.$especialidad->id;
                                }
                            }*/
                            
                            //dd($status_array);
                            $dia=date("j");
                            if($dia==$p->dia){
                                //dd($dia);
                                $clis=DB::table('clientes')->whereIn('st_cliente_id', [$status_array])
                                                            ->where('plantel_id', '=', $p->plantel_id)
                                                           ->where('especialidad_id','=', $plantel->especialidad_id)
                                                           ->where('nivel_id', '=', $plantel->nivel_id)
                                                           ->get();
                                //dd($clis);
                                
                                try{
                                    foreach($clis as $cli){
                                        if($cli->celular_confirmado==1){
                                            $to       = '+52'.$cli->tel_cel;
                                            $from     = "+13093196909";
                                            $message  = $p->sms;
                                            $response = Sms::send($message,$to,$from);    
                                            $cantidad_enviada++;
                                        }
                                    }
                                    
                                }catch(\Exception $e){
                                dd($e);
                                }                      
                            }
                        }
                    break;
                }
            }
            $input2['usu_envio_id']=1;
            $input2['cliente_id']=1;
            $input2['fecha_envio']=date("Y/m/d");
            $input2['cantidad']=$cantidad_enviada;
            $input2['usu_alta_id']=1;
            $input2['usu_mod_id']=1;
            Sm::create($input2);
            
        }
    }
}
