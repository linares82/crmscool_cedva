<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Plantilla;
use App\Cliente;
use App\Correo as Corre;
use App\Param;
use DB;
use App\Mail\Correo;

class EnviarCorreos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ian:EnviarCorreos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa tabla de plantillas y envia correos segun condiciones';

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
        $c=0;
        $cantidad_enviada=0;
        //$status_array=array();
        //$data = $request->all();
        /*$data['email']="linares82@gmail.com";
        $data['subject']='prb envio';
        $data['name']='linares82';

        \Mail::send('emails.1', array(), function($message) use ($data)
                 {
                     //remitente
                    //dd($cli);
                     //$message->from($cli->mail, $cli->nombre);
                     $message->from($data['email'], $data['name']);
           
                     //asunto
                     $message->subject("sin asunto");
           
                     //receptor
                     $message->to(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
           
                 });
        */
        $r=Param::where('llave','=', 'correo_electronico')->first();
        //dd($r->valor);
        if($r->valor=='activo'){
            
            $ps=Plantilla::select('id', 'st_cliente_id', 'dia', 'tpo_correo_id', 'para_nombre', 'asunto', 'activo_bnd','mail_bnd', 'sms_bnd', 'sms', 'nivel_id')
                ->where('tpo_correo_id', '<>', '1')
                ->where('mail_bnd', '=', '1')
                ->orderBy('tpo_correo_id', 'asc')
                ->get();
            //dd($ps->toArray());
            
            foreach($ps as $p){
                $cuenta=0;                
                switch ($p->tpo_correo_id) {
                    /*case '2': //revisar definicion
                        if($p->activo_bnd==1){
                            //dd($status_array);
                            $dia=date("j");
                            if($dia==$p->dia){
                                //dd($dia);
                                $clis=DB::table('clientes')->where('nivel_id', $p->nivel_id)->get();
                                //dd($clis);
                                
                                try{
                                    foreach($clis as $cli){
                                        $m=\Mail::to($cli->mail, $cli->nombre);    
                                        $m->queue(new Correo($p));
                                        $cantidad_enviada++;
                                    }
                                    //$m->queue(new Correo($p));
                                    //dd('correo enviado');
                                }catch(\Exception $e){
                                dd($e);
                                }
                                
                                if($p->bnd_sms==1){

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
                                        if($cli->correo_confirmado==1){
                                            $m=\Mail::to($cli->mail, $cli->nombre);    
                                            $m->queue(new Correo($p));
                                            $cantidad_enviada++;
                                        }
                                    }
                                    //$m->queue(new Correo($p));
                                    dd('correo enviado');
                                }catch(\Exception $e){
                                dd($e);
                                }
                            
                                if($p->bnd_sms==1){

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
                                //dd($clis);
                                
                                try{
                                    foreach($clis as $cli){
                                        if($cli->correo_confirmado==1){
                                            $m=\Mail::to($cli->mail, $cli->nombre);    
                                            $m->queue(new Correo($p));
                                            $cantidad_enviada++;
                                        }
                                    }
                                    
                                }catch(\Exception $e){
                                dd($e);
                                }
                            
                                if($p->bnd_sms==1){

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
                                        if($cli->correo_confirmado==1){
                                            $m=\Mail::to($cli->mail, $cli->nombre);    
                                            $m->queue(new Correo($p));
                                            $cantidad_enviada++;
                                        }
                                    }
                                    
                                }catch(\Exception $e){
                                dd($e);
                                }
                        
                                if($p->bnd_sms==1){

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
            Corre::create($input2);
        }
    }
}
