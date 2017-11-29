<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Tarea;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateTarea;
use App\Http\Requests\createTarea;

class TareasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$tareas = Tarea::getAllData($request);

		return view('tareas.index', compact('tareas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tareas.create')
			->with( 'list', Tarea::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createTarea $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Tarea::create( $input );

		return redirect()->route('tareas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Tarea $tarea)
	{
		$tarea=$tarea->find($id);
		return view('tareas.show', compact('tarea'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Tarea $tarea)
	{
		$tarea=$tarea->find($id);
		return view('tareas.edit', compact('tarea'))
			->with( 'list', Tarea::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Tarea $tarea)
	{
		$tarea=$tarea->find($id);
		return view('tareas.duplicate', compact('tarea'))
			->with( 'list', Tarea::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Tarea $tarea, updateTarea $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$tarea=$tarea->find($id);
		$tarea->update( $input );

		return redirect()->route('tareas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Tarea $tarea)
	{
		$tarea=$tarea->find($id);
		$tarea->delete();

		return redirect()->route('tareas.index')->with('message', 'Registro Borrado.');
	}

}
