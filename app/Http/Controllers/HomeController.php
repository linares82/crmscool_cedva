<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aviso;
use App\Lectivo;
use App\AvisoGral;
use App\PivotAvisoGralEmpleado;
use App\Seguimiento;
use App\Hactividade;
use App\Empleado;
use App\Menu;
use DB;
use Auth;
use Activity;

class HomeController extends Controller
{
    public $menuArmado="";
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $f=date("Y-m-d");
        $l=Lectivo::find(0)->first();

        $e=Empleado::where('user_id', '=', Auth::user()->id)->first();
        $avisos=Aviso::select('avisos.id','a.name','avisos.detalle', 'avisos.fecha', 's.cliente_id')
					->join('asuntos as a', 'a.id', '=', 'avisos.asunto_id')
                    ->join('seguimientos as s', 's.id', '=', 'avisos.seguimiento_id')
                    ->join('clientes as c', 'c.id', '=', 's.cliente_id')
					->where('avisos.activo', '=', '1')
                    //->where('avisos.fecha', '=', Db::Raw('CURDATE()'))
                    ->where('c.empleado_id', '=', $e->id)
					->get();
        //dd($avisos);
        $mes=(int)date('m');
        //dd($mes);-
        
        
        $a_2=Seguimiento::select('p.id','p.razon', 'p.meta_total', 
                    DB::raw('count(c.nombre) as avance'), DB::raw('((count(c.nombre)*100)/p.meta_total) as p_avance'))
                    ->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
                    ->join('plantels as p', 'p.id', '=', 'c.plantel_id')
                    ->join('hactividades as h', 'h.cliente_id', '=', 'c.id')
                    ->where('h.tarea', '=', 'Seguimiento')
                    ->where('h.detalle', '=', 'Concretado')
                    ->where('h.created_at', '>=', $l->inicio)
                    ->where('h.created_at', '<=', $l->fin)
                    ->where('c.st_cliente_id', '=', '4')
                    ->groupBy('p.id')
                    ->groupBy('p.razon')
                    ->groupBy('p.meta_total')
                    ->get();
        //dd($a_2->toArray());
        
        $fecha=date('Y-m-d');
        $avisos_generales=PivotAvisoGralEmpleado::where('leido','=', 0)
                                    ->where('enviado','=', 1)
                                    ->where('empleado_id', '=', $e->id)
                                    ->get();
        //dd($avisos_generales);
        $encabezado = ['Estatus', 'Cantidad Total', 'Meta'];
        $datos=array();
        array_push($datos,$encabezado);
        $encabezado = ['Estatus', 'Cantidad Total'];
        $datos2=array();
        array_push($datos2,$encabezado);
        $mes=(int)date('m');
        $grafica=Seguimiento::select('sts.name as estatus', DB::raw('count(sts.name) as valor'))
                    ->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
                    ->join('st_seguimientos as sts', 'sts.id','=','seguimientos.st_seguimiento_id')
                    //->where('mes', '=', $mes)
                    ->where('seguimientos.created_at', '>=', $l->inicio)
                    ->where('seguimientos.created_at', '<=', $l->fin)
                    ->where('c.empleado_id', '=', $e->id)
                    ->where('c.plantel_id', '=', $e->plantel_id)
                    ->where('sts.id', '=', 2)
                    ->groupBy('sts.name')
                    ->get();
        
        foreach($grafica as $g){
            if($g->estatus=="Concretado"){
                array_push($datos, array($g->estatus, $g->valor, $e->plantel->meta_venta));
            }else{
                array_push($datos, array($g->estatus, $g->valor, 0));
            }
            
        }
        
        $grafica2=Seguimiento::select('sts.name as estatus', DB::raw('count(sts.name) as valor'))
                    ->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
                    ->join('st_seguimientos as sts', 'sts.id','=','seguimientos.st_seguimiento_id')
                    //->where('mes', '=', $mes)
                    ->where('c.empleado_id', '=', $e->id)
                    ->where('c.plantel_id', '=', $e->plantel_id)
                    ->whereIn('sts.id', [1,3,4])
                    ->groupBy('sts.name')
                    ->get();
        foreach($grafica2 as $g){
            array_push($datos2, array($g->estatus, $g->valor));
        }
        
        
        //dd($ds_actividades->toArray());
        return view('home', compact('avisos', 'a_2', 'grafica2','grafica', 'avisos_generales'))
                    ->with('datos', json_encode($datos))
                    ->with('datos2', json_encode($datos2));
    }

    public function grfEstatusXEmpleado(){
        $e=Empleado::where('user_id', '=', Auth::user()->id)->first();
        $mes=(int)date('m');
        return $grafica=Seguimiento::select('sts.name as Estatus', DB::raw('count(sts.name) as Valor'))
                    ->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
                    ->join('st_seguimientos as sts', 'sts.id','=','seguimientos.st_seguimiento_id')
                    //->where('mes', '=', $mes)
                    ->where('c.empleado_id', '=', $e->id)
                    ->where('c.plantel_id', '=', $e->plantel_id)
                    ->groupBy('sts.name')
                    ->get()->toJson();
    }

    public function armaMenuPrimario($padre=1){
    	//$menu=$this->menuRepository->search(array('padre'=>$padre));
    	//$usuario_actual=User::find(Auth::user()->id)->is('admin');
    	$menu=Menu::where('padre', $padre)
                ->where('activo', true)
                ->orderBy('prioridad', 'asc')->get();

        //dd($menu);
    	
    	if(!empty($menu)){
    		//dd($menu);
    		foreach($menu as $item){
    			//$permiso=User::find(Auth::user()->id)->can($item->permiso);

    			if ($item->permiso<>"home"){
    				$permiso=Auth::user()->can($item->permiso);
    			}else{
    				$permiso=true;
    			}
    			$link=route($item->link);
    			//dd($permiso);
    			if($permiso and $item->activo==1 and $item->parametros=="_blank"){
    				$this->menuArmado=$this->menuArmado."<li class='active'><a href='".$link."' target='".$item->parametros."'><i class='".$item->imagen."'></i><span>".$item->item."</span></a></li>";
    			}
    		}
    	}
    	
    	//dd($this->menuArmado);
    	return $this->menuArmado;
    }

	public function armaMenu($padre=1){
		if (session()->has('menu')) {
		    return session('menu');
		}
		else{
			$m=$this->armaMenuPrincipal();	
	    	session(['menu' => $m]);

	    	//dd($this->menuArmado);
	    	return session('menu');
	    	//return $this->menuArmado;
    	}
    	
    }	
	public function armaMenu2($padre=43){
		if (session()->has('menu2')) {
		    //Log::info(session('menu2'));
			return session('menu2');
			
		}
		else{
			$m=$this->armaMenuPrincipal($padre);	
	    	session(['menu2' => $m]);

	    	//dd($this->menuArmado);
	    	return session('menu2');
	    	//return $this->menuArmado;
    	}
    	
    }	

    public function armaMenuPrincipal($padre=1){
    				
    	//$menu=$this->menuRepository->search(array('padre'=>$padre));
    	//$usuario_actual=User::find(Auth::user()->id)->is('admin');
    	$menu=Menu::where('padre', $padre)
                ->where('activo', true)
                ->orderBy('prioridad', 'asc')->get();

        //dd($menu);
    	
    	if(!empty($menu)){
    		//dd($menu);
    		foreach($menu as $item){
    			//$permiso=User::find(Auth::user()->id)->can($item->permiso);

    			if ($item->permiso<>"home" and $item->permiso<>"logout"){
    				
					$permiso=Auth::user()->can($item->permiso);
					
    			}else{
					//dd($item->permiso);
    				$permiso=true;
    			}
    			$link=route($item->link);
    			//dd($permiso);
    			if($permiso and $item->activo==1){
    				//dd($item->id);
	    			$r=intval($this->tieneItems($item->id));
	    			//dd(action($item->link));
	    			
	    			if($r==1){
	    				$this->menuArmado=$this->menuArmado."<li class='treeview'>
									                <a href=' ".$link." '>
														<i class='".$item->imagen."'></i><span>".$item->item."</span> <i class='fa fa-angle-left pull-right'></i>
													</a>
									                <ul class='treeview-menu'>";
						$this->menuArmado=$this->armaMenuPrincipal($item->id);
						$this->menuArmado=$this->menuArmado."</ul></li>";

	    			}else{
	    				//dd($this->menuArmado);
	    				$this->menuArmado=$this->menuArmado."<li class='active'><a href='".$link."'><i class='".$item->imagen."'></i><span>".$item->item."</span></a></li>";
	    			}
	    			//Log::info($this->menuArmado);
    			}
    		}
    		return $this->menuArmado;
    	}
    	
    	
    	//dd($this->menuArmado);
    	
    	//return $this->menuArmado;
    	
    }

    public function tieneItems($padre){
    	$menu=Menu::where('padre', $padre)->where('activo', true)->count();

		//dd($menu);
    	if($menu==0){
    		return -1;
    	}
    	else{
    		return 1;
    	}
    }
}
