<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inscripcion;
use App\Grupo;
use App\Cliente;
use App\Hacademica;
use App\Calificacion;
use App\Ponderacion;
use App\CalificacionPonderacion;
use App\CargaPonderacion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateInscripcion;
use App\Http\Requests\createInscripcion;
use DB;

class InscripcionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$inscripcions = Inscripcion::getAllData($request);

		return view('inscripcions.index', compact('inscripcions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('inscripcions.create')
			->with( 'list', Inscripcion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createInscripcion $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		$i=Inscripcion::create( $input );
		//dd($i);
			

		return redirect()->route('inscripcions.index')->with('message', 'Registro Creado.');
	}

	function registrarMaterias($id){
		$i=Inscripcion::find($id);
		$materias=Grupo::find($i->grupo_id)->periodoEstudio->materias;
		$materias_validar=Hacademica::where('grupo_id', '=', $i->grupo_id)->where('grado_id', '=', $i->grado_id)->get();
		
		//dd($materias_validar->count());
		if($materias_validar->count()==0){
			foreach($materias as $m){
				$h['inscripcion_id']=$i->id;
				$h['cliente_id']=$i->cliente_id;
				$h['plantel_id']=$i->plantel_id;
				$h['especialidad_id']=$i->especialidad_id;
				$h['nivel_id']=$i->nivel_id;
				$h['grado_id']=$i->grado_id;
				$h['grupo_id']=$i->grupo_id;
				$h['materium_id']=$m->id;
				$h['st_materium_id']=0;
				$h['lectivo_id']=$i->lectivo_id;
				$h['usu_alta_id']=Auth::user()->id;
				$h['usu_mod_id']=Auth::user()->id;
				$ha=Hacademica::create($h);
				//$h=new Hacademica;
				//$h->save($h);
				$c['hacademica_id']=$ha->id;
				$c['tpo_examen_id']=1;
				$c['calificacion']=0;
				$c['fecha']=date('Y-m-d');
				$c['reporte_bnd']=0;
				$c['usu_alta_id']=Auth::user()->id;
				$c['usu_mod_id']=Auth::user()->id;
				$calif=Calificacion::create($c);
				
				$ponderaciones=CargaPonderacion::where('ponderacion_id','=', $m->ponderacion_id)->get();
				//dd($ponderaciones);
				foreach($ponderaciones as $p){
					$ponde['calificacion_id']=$calif->id;
					$ponde['carga_ponderacion_id']=$p->id;
					$ponde['calificacion_parcial']=0;
					$ponde['ponderacion']=$p->porcentaje;
					$ponde['usu_alta_id']=Auth::user()->id;
					$ponde['usu_mod_id']=Auth::user()->id;
					CalificacionPonderacion::create($ponde);
				}
			}
		}
		
		return redirect()->route('clientes.edit', $i->cliente_id)->with('message', 'Registro Actualizado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Inscripcion $inscripcion)
	{
		$inscripcion=$inscripcion->find($id);
		return view('inscripcions.show', compact('inscripcion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Inscripcion $inscripcion)
	{
		$inscripcion=$inscripcion->find($id);
		return view('inscripcions.edit', compact('inscripcion'))
			->with( 'list', Inscripcion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Inscripcion $inscripcion)
	{
		$inscripcion=$inscripcion->find($id);
		return view('inscripcions.duplicate', compact('inscripcion'))
			->with( 'list', Inscripcion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Inscripcion $inscripcion, updateInscripcion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$inscripcion=$inscripcion->find($id);
		$inscripcion->update( $input );

		return redirect()->route('inscripcions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Inscripcion $inscripcion)
	{
		$inscripcion=$inscripcion->find($id);
		$inscripcion->delete();

		return redirect()->route('inscripcions.index')->with('message', 'Registro Borrado.');
	}

	public function destroyCli($id,Inscripcion $inscripcion)
	{
		$inscripcion=$inscripcion->find($id);
		$cli=$inscripcion->cliente_id;
		$inscripcion->delete();

		return redirect()->route('clientes.edit', $cli)->with('message', 'Registro Borrado.');
	}

	public function getReinscripcion()
	{
		return view('inscripcions.reinscripcion')
			->with( 'list', Inscripcion::getListFromAllRelationApps() );
	}

	public function postReinscripcion(Request $request)
	{
		$input = $request->all();
		//dd($input);
		if(isset($input['plantel_id']) and isset($input['lectivo_id']) and isset($input['grupo_id'])){
			$clientes=Cliente::join('inscripcions as i', 'i.cliente_id', '=', 'clientes.id')
						->join('hacademicas as h', 'h.inscripcion_id', 'i.id')
						->join('calificacions as c', 'c.hacademica_id', '=', 'h.id')
						->join('materia as m', 'm.id', 'h.materium_id')
						->join('grados as g', 'g.id', 'h.grado_id')
						->select('i.id',
								 DB::raw('concat(clientes.nombre," ",clientes.nombre2," ",clientes.ape_paterno," ",clientes.ape_materno) as nombre'),
								 DB::raw('count(m.name) as materias_aprobadas'))
						->where('i.plantel_id', '=', $input['plantel_id'])
						->where('i.especialidad_id', '=', $input['especialidad_id'])
						->where('i.nivel_id', '=', $input['nivel_id'])
						->where('i.grupo_id', '=', $input['grupo_id'])
						->where('i.lectivo_id', '=', $input['lectivo_id'])
						->where('i.plantel_id', '=', $input['plantel_id'])
						->where('h.st_materium_id', '=', 1)
						->groupBy('nombre', 'i.id')
						->get();
		}	
		if(isset($input['id']) and isset($input['grupo_to']) and isset($input['lectivo_to'])){
			foreach($input['id'] as $key=>$value){
				$id=$value;
				$posicion=$key;
				$i=Inscripcion::find($id);
				$i->grupo_id=$input['grupo_to'];
				$i->lectivo_id=$input['lectivo_to'];
				$i->save();
				$this->registrarMaterias($id);
			}
		}
		//dd($clientes->toArray());
		return view('inscripcions.reinscripcion', compact('clientes'))
			->with( 'list', Hacademica::getListFromAllRelationApps() );
	}
}
