<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AsignacionAcademica;
use App\Empleado;
use App\Horario;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAsignacionAcademica;
use App\Http\Requests\createAsignacionAcademica;
use DB;
class AsignacionAcademicasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$asignacionAcademicas = AsignacionAcademica::getAllData($request);
		$e=Empleado::where('user_id', '=', Auth::user()->id)->first();
		return view('asignacionAcademicas.index', compact('asignacionAcademicas', 'e'))
                        ->with( 'list', AsignacionAcademica::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('asignacionAcademicas.create')
			->with( 'list', AsignacionAcademica::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAsignacionAcademica $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		AsignacionAcademica::create( $input );

		return redirect()->route('asignacionAcademicas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, AsignacionAcademica $asignacionAcademica)
	{
		$asignacionAcademica=$asignacionAcademica->find($id);
		return view('asignacionAcademicas.show', compact('asignacionAcademica'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, AsignacionAcademica $asignacionAcademica)
	{
		$asignacionAcademica=$asignacionAcademica->find($id);
		
		return view('asignacionAcademicas.edit', compact('asignacionAcademica'))
			->with( 'list', AsignacionAcademica::getListFromAllRelationApps() )
			->with( 'list1', Horario::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, AsignacionAcademica $asignacionAcademica)
	{
		$asignacionAcademica=$asignacionAcademica->find($id);
		return view('asignacionAcademicas.duplicate', compact('asignacionAcademica'))
			->with( 'list', AsignacionAcademica::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, AsignacionAcademica $asignacionAcademica, updateAsignacionAcademica $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//dd($request->all());
		$input2['asignacion_academica_id']=$id;
		$input2['dia_id']=$input['dia_id'];
		$input2['hora']=$input['hora'];
		$input2['duracion_clase']=$input['duracion_clase'];
		$input2['usu_mod_id']=Auth::user()->id;
		$input2['usu_alta_id']=Auth::user()->id;
		unset($input['dia_id']);
		unset($input['hora']);
		unset($input['duracion_clase']);
		
		//update data
		$asignacionAcademica=$asignacionAcademica->find($id);
		$asignacionAcademica->update( $input );
		if($request->input('dia_id') and $request->input('hora') and $request->input('duracion_clase')){
			
			Horario::create($input2);
		}
		



		return redirect()->route('asignacionAcademicas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,AsignacionAcademica $asignacionAcademica)
	{
		$asignacionAcademica=$asignacionAcademica->find($id);
		$asignacionAcademica->delete();

		return redirect()->route('asignacionAcademicas.index')->with('message', 'Registro Borrado.');
	}

	public function horarioGrupo()
	{
		return view('asignacionAcademicas.reportes.horarioGrupo')
			->with( 'list', AsignacionAcademica::getListFromAllRelationApps());
	}

	public function horarioGrupoR(Request $request)
	{
		$input=$request->all();
		$fecha=date('d-m-Y');
		
		$horarios=AsignacionAcademica::select(DB::raw("concat(e.nombre,' ',e.ape_paterno,' ',e.ape_materno) as empleado"),
								'p.razon as plantel', 'm.name as materia', 'g.name as grupo', 'l.name as lectivo', 
								DB::raw('concat(d.id,"-",d.name) as dia'),
								 'h.hora')
								->join('empleados as e', 'e.id', '=', 'asignacion_academicas.empleado_id')
								->join('plantels as p', 'p.id', '=', 'asignacion_academicas.plantel_id')
								->join('materia as m', 'm.id', '=', 'asignacion_academicas.materium_id')
								->join('grupos as g', 'g.id', '=', 'asignacion_academicas.grupo_id')
								->join('lectivos as l', 'l.id', '=', 'asignacion_academicas.lectivo_id')
								->join('horarios as h', 'h.asignacion_academica_id', '=', 'asignacion_academicas.id')
								->join('dias as d', 'd.id', '=', 'h.dia_id')
								//->where('asignacion_academicas.plantel_id', '>=', $input['plantel_f'])
								//->where('asignacion_academicas.grupo_id', '<=', $input['grupo_f'])
								//->where('asignacion_academicas.lectivo_id', '<=', $input['lectivo_f'])
								->whereNull('h.deleted_at')
								->orderBy('d.id')
								->orderBy('Plantel')
								//->groupBy('esp.meta','e.nombre', 'e.ape_paterno', 'e.ape_materno')
								->get();
		
		//dd($horarios->toArray());
			/*PDF::setOptions(['defaultFont' => 'arial']);
			$pdf = PDF::loadView('seguimientos.reportes.seguimientosXespecialidadGr', array('seguimientos'=>$seguimientos, 'fecha'=>$fecha, 'datos'=>json_encode($datos)))
						->setPaper('letter', 'landscape');
			return $pdf->download('reporte.pdf');
			*/
			return view('asignacionAcademicas.reportes.horarioGrupoR', array('fecha'=>$fecha))
					->with('datos', json_encode($horarios));	
					
			/*Excel::create('Laravel Excel', function($excel) use($seguimientos) {
				$excel->sheet('Productos', function($sheet) use($seguimientos) {
					$sheet->fromArray($seguimientos);
				});
			})->export('xls');
			*/
	}

}
