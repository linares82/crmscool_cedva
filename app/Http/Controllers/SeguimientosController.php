<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Seguimiento;
use App\Empleado;
use App\Cliente;
use App\StSeguimiento;
use App\AsignacionTarea;
use App\Hactividade;
use App\Aviso;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSeguimiento;
use App\Http\Requests\createSeguimiento;
use App\Http\Requests\updateAsignacionTarea;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Log;

class SeguimientosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$seguimientos = Seguimiento::getAllData($request);

		return view('seguimientos.index', compact('seguimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('seguimientos.create')
			->with( 'list', Seguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		$input_seguimiento['mes']=date('m');

		//create data
		Seguimiento::create( $input );

		return redirect()->route('seguimientos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Seguimiento $seguimiento, updateAsignaciontarea $request)
	{
		/*$seguimiento=$seguimiento->join('st_seguimientos as st', 'st.id', '=', 'seguimientos.st_seguimiento_id')
								->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
								->where('cliente_id', '=', $id)->first();
		*/
		//dd($seguimiento);
		$seguimiento=$seguimiento->where('cliente_id', '=', $id)->first();
		if(!isset($seguimiento->id)){
			$input_seguimiento['cliente_id']=$id;
			$input_seguimiento['estatus_id']=1;
			$input_seguimiento['usu_alta_id']=Auth::user()->id;
			$input_seguimiento['usu_mod_id']=Auth::user()->id;
			$seguimiento=Seguimiento::create($input_seguimiento);
		}
		//$seguimiento->getAllData();
		$sts=StSeguimiento::pluck('name', 'id');
		$asignacionTareas = AsignacionTarea::where('cliente_id', '=', $seguimiento->cliente_id)->get();
		$avisos=Aviso::select('avisos.id','a.name','avisos.detalle', 'avisos.fecha',
							Db::Raw('DATEDIFF(avisos.fecha,CURDATE()) as dias_restantes'))
					->join('asuntos as a', 'a.id', '=', 'avisos.asunto_id')
					->where('seguimiento_id', '=', $seguimiento->id)
					->where('avisos.activo', '=', '1')
					->get();
		$actividades=Hactividade::where('seguimiento_id', '=', $seguimiento->id)->get();
                //dd($actividades->toArray());
                //$dias=round((strtotime($a->fecha)-strtotime(date('Y-m-d')))/86400);
		//dd($seguimiento);
		return view('seguimientos.show', compact('seguimiento', 'sts', 'asignacionTareas', 'avisos', 'actividades'))
					->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
	}

	public function showPrint($id, Seguimiento $seguimiento, updateAsignaciontarea $request)
	{
		/*$seguimiento=$seguimiento->join('st_seguimientos as st', 'st.id', '=', 'seguimientos.st_seguimiento_id')
								->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
								->where('cliente_id', '=', $id)->first();
		*/
		//dd($seguimiento);
		$seguimiento=$seguimiento->where('cliente_id', '=', $id)->first();
		if(!isset($seguimiento->id)){
			$input_seguimiento['cliente_id']=$id;
			$input_seguimiento['estatus_id']=1;
			$input_seguimiento['usu_alta_id']=Auth::user()->id;
			$input_seguimiento['usu_mod_id']=Auth::user()->id;
			$seguimiento=Seguimiento::create($input_seguimiento);
		}
		//$seguimiento->getAllData();
		$sts=StSeguimiento::pluck('name', 'id');
		$asignacionTareas = AsignacionTarea::where('cliente_id', '=', $seguimiento->cliente_id)->get();
		$avisos=Aviso::select('avisos.id','a.name','avisos.detalle', 'avisos.fecha',
							Db::Raw('DATEDIFF(avisos.fecha,CURDATE()) as dias_restantes'))
					->join('asuntos as a', 'a.id', '=', 'avisos.asunto_id')
					->where('seguimiento_id', '=', $seguimiento->id)
					->where('avisos.activo', '=', '1')
					->get();
		//$dias=round((strtotime($a->fecha)-strtotime(date('Y-m-d')))/86400);
		//dd($seguimiento);
		$fecha=date('d-m-Y');
		PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.showPrint', array('seguimiento'=>$seguimiento, 'sts'=>$sts, 'asignacionTareas'=>$asignacionTareas, 'avisos'=>$avisos, 'fecha'=>$fecha))
						->setPaper('letter', 'portrait');
			return $pdf->download('reporte.pdf');
		/*return view('seguimientos.show', compact('seguimiento', 'sts', 'asignacionTareas', 'avisos'))
					->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
					*/
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Seguimiento $seguimiento)
	{
		$seguimiento=$seguimiento->find($id);
		return view('seguimientos.edit', compact('seguimiento'))
			->with( 'list', Seguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Seguimiento $seguimiento)
	{
		$seguimiento=$seguimiento->find($id);
		return view('seguimientos.duplicate', compact('seguimiento'))
			->with( 'list', Seguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Seguimiento $seguimiento, updateSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$seguimiento=$seguimiento->find($id);
                
		$seguimiento->update( $input );
                if($seguimiento->st_seguimiento_id==2){
                    $c=Cliente::find($seguimiento->cliente_id);
                    //dd($c->toArray());
                    $st=DB::table('params')->where('llave', 'st_cliente_final')->first();
                    $c->st_cliente_id=$st->valor;
                    $c->save();
                }
		return redirect()->route('seguimientos.show', $seguimiento->cliente_id)->with('message', 'Registro Actualizado.');
	}

	public function updateEstatus($id, Seguimiento $seguimiento, updateSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$seguimiento=$seguimiento->find($id);
		$seguimiento->update( $input );

		return redirect()->route('seguimientos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Seguimiento $seguimiento)
	{
		$seguimiento=$seguimiento->find($id);
		$seguimiento->delete();

		return redirect()->route('seguimientos.index')->with('message', 'Registro Borrado.');
	}

	public function reporteSeguimientosXEmpleado(){
		$estatus=$_REQUEST['estatus'];
		$e=Empleado::where('user_id', '=', Auth::user()->id)->first();
		$mes=(int)date('m');
		$fecha=date('d-m-Y');
		
		$seguimientos=Seguimiento::select('c.nombre as Nombre', 'c.nombre2 as Segundo Nombre', 'c.ape_paterno as Apellido_Paterno', 'c.ape_materno as Apellido_Materno',
			'c.calle as Calle', 'c.no_interior as No_Interior', 'c.no_exterior as No_Exterior', 'm.name as Municipio', 'e.name as Estado', 
			'c.tel_fijo as Teléfono_Fijo', 'tel_cel as Teléfono_Celular', 'mail as Correo_Electrónico', 'sts.name as Estatus_Seguimiento', 
			'stc.name as Estatus_Cliente')
			->join('st_seguimientos as sts', 'sts.id', '=', 'seguimientos.estatus_id')
			->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
			->join('municipios as m', 'm.id', '=', 'c.municipio_id')
			->join('estados as e', 'e.id', '=', 'c.estado_id')
			->join('st_clientes as stc', 'stc.id', '=', 'c.st_cliente_id')
			//->leftJoin('asignacion_tareas as at', 'at.cliente_id', '=','seguimientos.cliente_id')
			->where('mes', '=', $mes)
			->where('c.plantel_id', '=', $e->plantel_id)
			->where('c.empleado_id', '=', $e->id)
			->where('seguimientos.estatus_id', '=', $estatus)
			->get()->toArray();
		//dd($seguimientos);
			/*PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXempleado', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha, 'e'=>$e))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			*/
		//return view('seguimientos.reportes.seguimientosXempleado', compact('seguimientos', 'fecha', 'e'));			
		Excel::create('Laravel Excel', function($excel) use($seguimientos) {
            $excel->sheet('Productos', function($sheet) use($seguimientos) {
                $sheet->fromArray($seguimientos);
            });
        })->export('xls');
	}

	public function seguimientosXempleadoG()
	{
		return view('seguimientos.reportes.seguimientosXempleadoG')
			->with( 'list', Cliente::getListFromAllRelationApps())
			->with( 'list1', Seguimiento::getListFromAllRelationApps());
	}

	public function seguimientosXempleadoGr(updateSeguimiento $request)
	{
		$input=$request->all();
		$fecha=date('d-m-Y');
		
		/*$seguimientos=Seguimiento::select(
				'p.razon','emp.nombre as nombre_e','emp.ape_paterno as paterno_e','emp.ape_materno as materno_e',
				'cli.nombre as nombre_c','cli.nombre2 as nombre2_c','cli.ape_paterno as paterno_c',
				'cli.ape_materno as materno_c','cli.calle','cli.no_interior','cli.no_exterior','cli.colonia',
				'm.name as municipio', 'est.name as estado','cli.tel_fijo','cli.tel_cel', 'cli.mail',
				'stc.name as estatus_cliente','sts.name as estatus_seguimiento' 
				)
				->join('clientes as cli', 'cli.id', '=','seguimientos.cliente_id')
				->join('municipios as m', 'm.id', '=', 'cli.municipio_id')
				->join('estados as est', 'est.id', '=', 'cli.estado_id')
				->join('empleados as emp', 'emp.id', '=', 'cli.empleado_id')
				->join('plantels as p', 'p.id', '=', 'cli.plantel_id')
				->join('st_clientes as stc', 'stc.id', '=', 'cli.st_cliente_id')
				->join('st_seguimientos as sts', 'sts.id', '=', 'seguimientos.estatus_id')
				->whereBetween('cli.empleado_id', [$input['empleado_f'], $input['empleado_t']])
				->whereBetween('cli.plantel_id', [$input['plantel_f'], $input['plantel_t']])
				->whereBetween('seguimientos.estatus_id', [$input['estatus_f'], $input['estatus_t']])
				->whereBetween('seguimientos.created_at', [$input['fecha_f'], $input['fecha_t']])
				->orderBy('cli.empleado_id', 'seguimientos.estatus_id')
				->get();
		*/
		$seguimientos=Seguimiento::select('p.razon', DB::raw('concat(e.nombre," ", e.ape_paterno," ", e.ape_materno) as nombre'), 'sts.name', DB::raw('count(sts.name) as total'))
								->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
								->join('empleados as e', 'e.id', '=', 'c.empleado_id')
								->join('plantels as p', 'p.id', '=', 'c.plantel_id')
								->join('st_seguimientos as sts', 'sts.id', '=', 'seguimientos.st_seguimiento_id')
								->whereBetween('c.empleado_id', [$input['empleado_f'], $input['empleado_t']])
								->whereBetween('c.plantel_id', [$input['plantel_f'], $input['plantel_t']])
								->whereBetween('seguimientos.st_seguimiento_id', [$input['estatus_f'], $input['estatus_t']])
								->whereBetween('seguimientos.created_at', [$input['fecha_f'], $input['fecha_t']])
								->groupBy('p.razon', 'e.nombre', 'e.ape_paterno', 'e.ape_materno', 'sts.name')
								->get();
		//dd($seguimientos);
		
		//$s=Seguimiento::get();
		//dd($clientes);
			PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXempleadoGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			
			//return view('seguimientos.reportes.seguimientosXempleadoGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha));	
			/*Excel::create('Laravel Excel', function($excel) use($seguimientos) {
				$excel->sheet('Productos', function($sheet) use($seguimientos) {
					$sheet->fromArray($seguimientos);
				});
			})->export('xls');
			*/
	}

	public function seguimientosXespecialidadG()
	{
		return view('seguimientos.reportes.seguimientosXespecialidadG')
			->with( 'list', Cliente::getListFromAllRelationApps())
			->with( 'list1', Seguimiento::getListFromAllRelationApps());
	}

	public function seguimientosXespecialidadGr(updateSeguimiento $request)
	{
		$input=$request->all();
		$fecha=date('d-m-Y');
		
		/*$seguimientos=Seguimiento::select(DB::raw('concat(e.nombre," ", e.ape_paterno," ", e.ape_materno) as nombre'), DB::raw('count(seguimientos.st_seguimiento_id) as total'), 'esp.meta')
								->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
								->join('empleados as e', 'e.id', '=', 'c.empleado_id')
								->join('especialidads as esp', 'esp.id', '=', 'c.especialidad_id')
								->where('c.plantel_id', '=', $input['plantel_f'])
								->where('c.especialidad_id', '=', $input['especialidad_f'])
								->where('seguimientos.st_seguimiento_id', '=', '2')
								->whereBetween('seguimientos.created_at', [$input['fecha_f'], $input['fecha_t']])
								->orderBy('nombre')
								->groupBy('esp.meta','e.nombre', 'e.ape_paterno', 'e.ape_materno')
								->get();
		$encabezado = ['Empleado', 'Total', 'Meta'];
        $datos=array();
        array_push($datos,$encabezado);
		foreach($seguimientos as $s){
			array_push($datos,array($s->nombre, $s->total, $s->meta));
		}*/

		
		$especialidades=DB::table('especialidads as e')->select('e.id','e.name as especialidad','e.meta')
								//->join('empleados as emp', 'emp.id', '=', 'c.empleado_id')
								->where('e.plantel_id', '=', $input['plantel_f'])
								//->where('c.plantel_id', '=', 1)
								//->where('c.especialidad_id', '=', $input['especialidad_f'])
								//->where('seguimientos.st_seguimiento_id', '=', '2')
								->orderby('e.plantel_id', 'asc')
								->orderby('e.id', 'asc')
								//->orderby('empleado_id', 'asc')
								//->orderBy('name', 'asc')
								->get();
		//dd($especialidades->toArray());
		$encabezado=array();
		array_push($encabezado, "Especialidad");
		array_push($encabezado, "Meta");
		$encabezado_agregado=0;
		$datos=array();
		$j=0;
		foreach($especialidades as $e){
			$linea=array();
			
			//dd($linea);
			$empleados=Db::table('empleados as e')->select('id',DB::raw('concat(e.nombre," ", e.ape_paterno," ", e.ape_materno) as nombre'))
			->where('puesto_id', '=', '2')
			->where('plantel_id', '=', $input['plantel_f'])
			->get();
			
			
			//dd($encabezado_agregado);
			if($encabezado_agregado==0){
				foreach($empleados as $emp){
					
					//Log::info($emp->nombre."-Antes");
					
					array_push($encabezado, $emp->nombre);
					//Log::info($emp->nombre."-Despues");
				}
				//dd($encabezado);
				array_push($datos, $encabezado);
				$encabezado_agregado++;
			}
			//dd($datos);
			$total=0;
			array_push($linea,$e->especialidad);
			array_push($linea,$e->meta);
			foreach($empleados as $emp){
				$total=DB::table('clientes as c')->select(
					DB::raw('count(st.name) as total'))
					->join('seguimientos','seguimientos.cliente_id', '=', 'c.id')
					->join('st_seguimientos as st', 'st.id', '=', 'seguimientos.st_seguimiento_id')
					//->where('c.plantel_id', '=', $input['plantel_f'])
					//->where('c.plantel_id', '=', 1)
					->where('c.especialidad_id', '=', $e->id)
					->where('c.empleado_id', '=', $emp->id)
					//->where('seguimientos.st_seguimiento_id', '=', '2')
					->orderby('c.plantel_id', 'asc')
					//->orderby('especialidad_id', 'asc')
					->orderby('empleado_id', 'asc')
					//->orderBy('name', 'asc')
					->groupBy('cliente_id')
					->value('total');	
				array_push($linea, $total);
			}
			//dd($linea);
			array_push($datos, $linea);
			/*$j++;
			if($j==30){break;}*/
		}
		//dd($datos);
		
		//dd($clientes);
			/*PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXespecialidadGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha, 'datos'=>json_encode($datos)))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			*/
			return view('seguimientos.reportes.seguimientosXespecialidadGr', array('fecha'=>$fecha, 'registros'=>$datos))
					->with('datos', json_encode($datos));	
					
			/*Excel::create('Laravel Excel', function($excel) use($seguimientos) {
				$excel->sheet('Productos', function($sheet) use($seguimientos) {
					$sheet->fromArray($seguimientos);
				});
			})->export('xls');
			*/
	}

	public function seguimientos()
	{
		return view('seguimientos.reportes.seguimientos')
			->with( 'list', Cliente::getListFromAllRelationApps())
			->with( 'list1', Seguimiento::getListFromAllRelationApps());
	}

	public function seguimientosr(updateSeguimiento $request)
	{
		$input=$request->all();
		$fecha=date('d-m-Y');
		if(!$request->has('plantel_f') and !$request->has('plantel_t')){
			$input['plantel_f']=DB::table('empleados as e')
                            ->where('e.user_id', Auth::user()->id)->value('plantel_id');
			$input['plantel_t']=$input['plantel_f'];
		}
		
		$seguimientos=Seguimiento::select('cve_plantel as Plantel', 'esp.name as Especialidad','n.name as Nivel',
		'g.name as Grado', 'seguimientos.mes as Mes',
		DB::raw('concat(e.nombre," ", e.ape_paterno," ", e.ape_materno) as Empleado'), 'st.name as Estatus',
		'st.id as st_contar','esp.meta as Meta')
								->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
								->join('empleados as e', 'e.id', '=', 'c.empleado_id')
								->join('plantels as p', 'p.id', '=', 'c.plantel_id')
								->join('especialidads as esp', 'esp.id', '=', 'c.especialidad_id')
								->join('nivels as n', 'n.id', '=', 'c.nivel_id')
								->join('grados as g', 'g.id', '=', 'c.grado_id')
								->join('st_seguimientos as st', 'st.id', '=', 'seguimientos.st_seguimiento_id')
								->where('c.plantel_id', '>=', $input['plantel_f'])
								->where('c.plantel_id', '<=', $input['plantel_t'])
								//->where('c.especialidad_id', '=', $input['especialidad_f'])
								//->where('seguimientos.st_seguimiento_id', '=', '2')
								->whereBetween('seguimientos.created_at', [$input['fecha_f'], $input['fecha_t']])
								->orderBy('Plantel')
								//->groupBy('esp.meta','e.nombre', 'e.ape_paterno', 'e.ape_materno')
								->get();
		
		//dd($seguimientos->toArray());
			/*PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXespecialidadGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha, 'datos'=>json_encode($datos)))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			*/
			return view('seguimientos.reportes.seguimientosr', array('fecha'=>$fecha))
					->with('datos', json_encode($seguimientos));	
					
			/*Excel::create('Laravel Excel', function($excel) use($seguimientos) {
				$excel->sheet('Productos', function($sheet) use($seguimientos) {
					$sheet->fromArray($seguimientos);
				});
			})->export('xls');
			*/
	}

	public function seguimientosGrf()
	{
		return view('seguimientos.reportes.seguimientosGrf')
			->with( 'list', Cliente::getListFromAllRelationApps())
			->with( 'list1', Seguimiento::getListFromAllRelationApps());
	}

	public function seguimientosGrfr(updateSeguimiento $request)
	{
		$input=$request->all();
		//dd($input);
		$fecha=date('d-m-Y');
		if(!$request->has('plantel_f') and !$request->has('plantel_t')){
			$input['plantel_f']=DB::table('empleados as e')
                            ->where('e.user_id', Auth::user()->id)->value('plantel_id');
			$input['plantel_t']=$input['plantel_f'];
		}
		
		$seguimientos=Seguimiento::select('cve_plantel as Plantel', 'esp.name as Especialidad','n.name as Nivel',
		'g.name as Grado', 'seguimientos.mes as Mes', 'm.name as medio',
		DB::raw('concat(e.nombre," ", e.ape_paterno," ", e.ape_materno) as Empleado'), 'st.name as Estatus',
		'st.id as st_contar','esp.meta as Meta', 'u.name as Usuario')
                ->join('clientes as c', 'c.id', '=', 'seguimientos.cliente_id')
                ->join('empleados as e', 'e.id', '=', 'c.empleado_id')
                ->join('users as u', 'u.id', '=', 'e.user_id')
                ->join('plantels as p', 'p.id', '=', 'c.plantel_id')
                ->join('especialidads as esp', 'esp.id', '=', 'c.especialidad_id')
                ->join('nivels as n', 'n.id', '=', 'c.nivel_id')
                ->join('grados as g', 'g.id', '=', 'c.grado_id')
                ->join('st_seguimientos as st', 'st.id', '=', 'seguimientos.st_seguimiento_id')
                ->join('medios as m', 'm.id', '=', 'c.medio_id')
                ->where('c.plantel_id', '>=', $input['plantel_f'])
                ->where('c.plantel_id', '<=', $input['plantel_t'])
                //->where('c.especialidad_id', '=', $input['especialidad_f'])
                //->where('seguimientos.st_seguimiento_id', '=', '2')
                ->whereBetween('seguimientos.created_at', [$input['fecha_f'], $input['fecha_t']])
                ->orderBy('Plantel')
                //->groupBy('esp.meta','e.nombre', 'e.ape_paterno', 'e.ape_materno')
                ->get();
		//dd($seguimientos->toArray());
		//dd($seguimientos->toArray());
			/*PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXespecialidadGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha, 'datos'=>json_encode($datos)))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			*/
			return view('seguimientos.reportes.seguimientosGrfr', array('fecha'=>$fecha))
					->with('datos', json_encode($seguimientos));	
					
			/*Excel::create('Laravel Excel', function($excel) use($seguimientos) {
				$excel->sheet('Productos', function($sheet) use($seguimientos) {
					$sheet->fromArray($seguimientos);
				});
			})->export('xls');
			*/
	}
        
        public function analitica_actividades()
	{   
            	return view('seguimientos.reportes.analitica_actividades')
			->with( 'list', Cliente::getListFromAllRelationApps());
	}
        
        public function analitica_actividadesr(Request $request)
	{
            $input=$request->all();
            
            $fecha_inicio= date ( 'Y-m-j' , strtotime ( '-8 day' , strtotime ( date('Y-m-j') ) ) );
            //dd($fecha_inicio);
            $ds_actividades=DB::table('hactividades as has')
                        ->select('p.razon as plantel', DB::raw('concat(e.nombre,e.ape_paterno,e.ape_materno) as empleado'),
                                DB::raw('concat(c.nombre,c.ape_paterno,c.ape_materno) as cliente'),
                                'has.tarea', 'has.fecha', 'has.asunto', 'has.detalle')
                        ->join('clientes as c', 'c.id', '=', 'has.cliente_id')
                        ->join('empleados as e', 'e.id', '=', 'c.empleado_id')
                        ->join('plantels as p', 'p.id', '=', 'e.plantel_id')
                        ->where('has.fecha', '>=', $input['fecha_f'])
                        ->where('has.fecha', '<=', $input['fecha_t'])
                        ->where('c.plantel_id', '>=', $input['plantel_f'])
                        ->where('c.plantel_id', '<=', $input['plantel_t'])
                        ->get();
            return view('seguimientos.reportes.analitica_actividadesr')
                        ->with('actividades', json_encode($ds_actividades));
	}
        
        public function analitica_actividadesf()
	{
            
            $fecha_inicio= date ( 'Y-m-j' , strtotime ( '-8 day' , strtotime ( date('Y-m-j') ) ) );
            //dd($fecha_inicio);
            $ds_actividades=DB::table('hactividades as has')
                        ->select('p.razon as plantel', DB::raw('concat(e.nombre,e.ape_paterno,e.ape_materno) as empleado'),
                                DB::raw('concat(c.nombre,c.ape_paterno,c.ape_materno) as cliente'),
                                'has.tarea', 'has.fecha', 'has.asunto', 'has.detalle')
                        ->join('clientes as c', 'c.id', '=', 'has.cliente_id')
                        ->join('empleados as e', 'e.id', '=', 'c.empleado_id')
                        ->join('plantels as p', 'p.id', '=', 'e.plantel_id')
                        ->where('has.fecha', '>', $fecha_inicio)
                        ->get();
            return view('seguimientos.reportes.analitica_actividadesr')
                        ->with('actividades', json_encode($ds_actividades));
	}
}
