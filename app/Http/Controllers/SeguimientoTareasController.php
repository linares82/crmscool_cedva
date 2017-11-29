<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SeguimientoTarea;
use App\AsignacionTarea;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSeguimientoTarea;
use App\Http\Requests\createSeguimientoTarea;

class SeguimientoTareasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$seguimientoTareas = SeguimientoTarea::getAllData($request);

		return view('seguimientoTareas.index', compact('seguimientoTareas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('seguimientoTareas.create')
			->with( 'list', SeguimientoTarea::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSeguimientoTarea $request)
	{
		
		$input = $request->all();
		
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		//create data
		
		$s=SeguimientoTarea::create( $input );
		$id=$input['asignacion_tarea_id'];
		$asignacion=AsignacionTarea::find($id);
		$asignacion->st_tarea_id=$input['estatus_id'];
		
		$asignacion->save();
		
		//dd($asignacion);
		return redirect()->route('asignacionTareas.seguimiento', $s->asignacion_tarea_id)->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, SeguimientoTarea $seguimientoTarea)
	{
		$seguimientoTarea=$seguimientoTarea->find($id);
		return view('seguimientoTareas.show', compact('seguimientoTarea'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, SeguimientoTarea $seguimientoTarea)
	{
		$seguimientoTarea=$seguimientoTarea->find($id);
		return view('seguimientoTareas.edit', compact('seguimientoTarea'))
			->with( 'list', SeguimientoTarea::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, SeguimientoTarea $seguimientoTarea)
	{
		$seguimientoTarea=$seguimientoTarea->find($id);
		return view('seguimientoTareas.duplicate', compact('seguimientoTarea'))
			->with( 'list', SeguimientoTarea::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, SeguimientoTarea $seguimientoTarea, updateSeguimientoTarea $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$seguimientoTarea=$seguimientoTarea->find($id);
		$seguimientoTarea->update( $input );

		return redirect()->route('seguimientoTareas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,SeguimientoTarea $seguimientoTarea)
	{
		$seguimientoTarea=$seguimientoTarea->find($id);
		$id=$seguimientoTarea->asignacion_tarea_id;
		$seguimientoTarea->delete();
		return redirect()->route('asignacionTareas.seguimiento', ['id'=>$id])->with('message', 'Registro Borrado.');
		//return redirect()->route('seguimientoTareas.index')->with('message', 'Registro Borrado.');
	}

}
