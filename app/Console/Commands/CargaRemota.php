<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Eloquent;
use DB;
use App\Empleado;
use App\Cliente;
use Auth;

class CargaRemota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:CargaRemota';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Conecta con base de datos remota y carga clientes de forma automatica';

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
        $descartados=DB::connection('remoto')->table('exportados')->max('informes_id');
        $total_archivo=0;
        if(is_null($descartados)){
            $cr=DB::connection('remoto')->table('informes')->select('Id_informe', 'Interesado', 'Telefono', 'email')
            ->where('Id_informe','>','0')->get();
            $total_archivo=DB::connection('remoto')->table('informes')
            ->where('Id_informe','>','0')->count('Interesado');
        }else{
            $cr=DB::connection('remoto')->table('informes')->select('Id_informe', 'Interesado', 'Telefono', 'email')
            ->where('Id_informe','>',$descartados)->get();

            $total_archivo=DB::connection('remoto')->table('informes')
            ->where('Id_informe','>',$descartados)->count('Interesado');
            //dd($total_archivo);
        }

        $total_empleados=Empleado::where('st_empleado_id','=','1')->count();
        //dd($total_empleados);
        $total_asignado=Empleado::where('st_empleado_id','=','1')->sum('pendientes');

        $total_meta=$total_asignado+$total_archivo;
        //dd($total_meta);
        $meta_individual=(($total_meta-($total_meta%$total_empleados))/$total_empleados);
        $this->meta_residuo=$total_meta % $total_empleados;

        $i=0;
        foreach ($cr as $r) {
            //dd($r);
            try{
                
                if(isset($r->Interesado)){
                    $input['nombre']=$r->Interesado;    
                }
                
                if(isset($r->email)){
                    $input['mail']=$r->email;    
                }
                if(isset($r->telefono)){
                    $input['tel_fijo']=$r->telefono;
                }
                
                //$empleado=Empleado::find($request->input('empleado_id'));
                if(isset($r->plantel)){
                    $input['plantel_id']=$r->plantel;    
                }else{
                    $input['plantel_id']=0;    
                }
                //dd($input);
                $input['usu_alta_id']=1;
                $input['usu_mod_id']=1;
                $input['promociones']=0;
                $input['promo_cel']=0;
                $input['promo_correo']=0;
                $input['municipio_id']=0;
                $input['estado_id']=0;
                $input['st_cliente_id']=1;
                $input['ofertum_id']=0;
                $input['medio_id']=0;
                $input['empleado_id']=$this->defineEmpleado($meta_individual);
                //dd($input);
                
                if(Cliente::create( $input )){
                    
                    //$procesados++;
                    $reg['informes_id']=$r->id;
                    DB::connection('remoto')->table('exportados')->create($reg);
                    $i++;        
                }
            }catch(\Exception $e){
                //dd($e);
            }   
            
        //echo "-".$i;
        }
        echo $i; 
         
         
    }

    public function defineEmpleado($meta_individual){
        //dd($meta_individual);
        $empleados=Empleado::select('id','pendientes')->where('st_empleado_id','=','1')->get();
        foreach($empleados as $e){
            $pendientes=Empleado::where('id','=',$e->id)->value('pendientes'); 
            if($pendientes<$meta_individual){
                return $e->id;
            }           
        }
        foreach($empleados as $e){
            if($this->meta_residuo>0){
                $this->meta_residuo--;
                return $e->id;
            }
        }

    }
}
