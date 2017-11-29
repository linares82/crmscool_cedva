<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Materium;
use App\Empleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateMaterium;
use App\Http\Requests\createMaterium;
use DB;
class MateriasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$materias = Materium::getAllData($request);

		return view('materias.index', compact('materias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$list=Materium::where('id', '>', '0')->where('seriada_bnd', '=', '1')->pluck('name','id')->toArray();
		$materiales_ls = array_merge(['0' => 'Seleccionar Opción'],$list);
		return view('materias.create', compact('materiales_ls'))
			->with( 'list', Materium::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createMaterium $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['seriada_bnd'])){
			$input['seriada_bnd']=0;
		}else{
			$input['seriada_bnd']=1;
		}
		//create data
		Materium::create( $input );

		return redirect()->route('materias.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Materium $materium)
	{
		$materium=$materium->find($id);
		return view('materias.show', compact('materium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Materium $materium)
	{
		$materium=$materium->find($id);
		$list=Materium::where('id', '>', '0')->where('seriada_bnd', '=', '1')->pluck('name','id')->toArray();
		$materiales_ls = array_merge(['0' => 'Seleccionar Opción'],$list);
		//dd($materiales_ls);
		return view('materias.edit', compact('materium', 'materiales_ls'))
			->with( 'list', Materium::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Materium $materium)
	{
		$materium=$materium->find($id);
		return view('materias.duplicate', compact('materium'))
			->with( 'list', Materium::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Materium $materium, updateMaterium $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$materium=$materium->find($id);
		if(!isset($input['seriada_bnd'])){
			$input['seriada_bnd']=0;
		}else{
			$input['seriada_bnd']=1;
		}
		$materium->update( $input );

		return redirect()->route('materias.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Materium $materium)
	{
		$materium=$materium->find($id);
		$materium->delete();

		return redirect()->route('materias.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbMateria(Request $request){
		if($request->ajax()){
			//dd($request->all());
			$plantel=$request->get('plantel_id');
			
			$materia=$request->get('materium_id');
			//dd("FLC:".$materia);
			$final = array();
			$r = DB::table('materia as m')
					->select('m.id', 'm.name')
					->where('m.plantel_id', '=', $plantel)
					->where('m.id', '>', '0')
					->get();
			
			//dd($r);
			if(isset($materia) and $materia<>0){
				foreach($r as $r1){
					if($r1->id==$materia){
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>'Selected'));
					}else{
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>''));
					}
				}
				return $final;
			}else{
				return $r;	
			}
			
		}
	}

	public function getCmbMateriaXalumno(Request $request){
		if($request->ajax()){
			//dd($request->all());
			$cve_alumno=$request->get('cve_alumno');
			
			$grado=$request->get('grado_id');
			$materia=$request->get('materia_id');
			//dd("FLC:".$materia);
			$final = array();
			$r = DB::table('materia as m')
					->join('hacademicas as h', 'h.materium_id', '=', 'm.id')
					->join('inscripcions as i', 'i.id', '=', 'h.inscripcion_id')
					->join('clientes as c', 'c.id', '=', 'i.cliente_id')
					->select('m.id', 'm.name')
					->whereColumn('m.plantel_id', 'i.plantel_id')
					->where('c.cve_alumno', '=', $cve_alumno)
					->where('i.grado_id', '=', $grado)
					->where('h.deleted_at', '=', null)
					->get();
			//dd($r);
			if(isset($materia) and $materia<>0){
				foreach($r as $r1){
					if($r1->id==$materia){
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>'Selected'));
					}else{
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>''));
					}
				}
				return $final;
			}else{
				return $r;	
			}
			
		}
	}

	public function getCmbMateriaXalumno2(Request $request){
		if($request->ajax()){
			//dd($request->all());
			$cve_alumno=$request->get('cve_alumno');
			$materia=$request->get('materium_id');
			//dd("FLC:".$materia);
			$e=Empleado::where('user_id', '=', Auth::user()->id)->first();
			//dd($e->id);
			
			$final = array();
			
			$filtro=Auth::user()->can('IfiltroCalificacionXProfesor');
			//dd($filtro);
			if($filtro){
				$r = DB::table('materia as m')
					->join('hacademicas as h', 'h.materium_id', '=', 'm.id')
					->join('inscripcions as i', 'i.id', '=', 'h.inscripcion_id')
					->join('clientes as c', 'c.id', '=', 'i.cliente_id')
					->join('grupos as g', 'g.id', '=', 'i.grupo_id')
					->join('asignacion_academicas as aa', 'aa.grupo_id','=', 'g.id')
					->join('empleados as e', 'e.id', 'aa.empleado_id')
					->select('m.id', 'm.name')
					->whereColumn('m.plantel_id', 'i.plantel_id')
					->where('c.cve_alumno', '=', $cve_alumno)
					->where('e.id', '=', $e->id)
					->where('h.deleted_at', '=', null)
					->get();	
			}else{
				$r = DB::table('materia as m')
					->join('hacademicas as h', 'h.materium_id', '=', 'm.id')
					->join('inscripcions as i', 'i.id', '=', 'h.inscripcion_id')
					->join('clientes as c', 'c.id', '=', 'i.cliente_id')
					->join('grupos as g', 'g.id', '=', 'i.grupo_id')
					->join('asignacion_academicas as aa', 'aa.grupo_id','=', 'g.id')
					->join('empleados as e', 'e.id', 'aa.empleado_id')
					->select('m.id', 'm.name')
					->whereColumn('m.plantel_id', 'i.plantel_id')
					->where('c.cve_alumno', '=', $cve_alumno)
					->where('h.deleted_at', '=', null)
					->get();
			}
					
			//dd($r);
			if(isset($materia) and $materia<>0){
				foreach($r as $r1){
					if($r1->id==$materia){
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>'Selected'));
					}else{
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>''));
					}
				}
				return $final;
			}else{
				return $r;	
			}
			
		}
	}
}
