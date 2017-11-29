<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CalificacionPonderacion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCalificacionPonderacion;
use App\Http\Requests\createCalificacionPonderacion;

class CalificacionPonderacionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$calificacionPonderacions = CalificacionPonderacion::getAllData($request);

		return view('calificacionPonderacions.index', compact('calificacionPonderacions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('calificacionPonderacions.create')
			->with( 'list', CalificacionPonderacion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCalificacionPonderacion $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		CalificacionPonderacion::create( $input );

		return redirect()->route('calificacionPonderacions.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, CalificacionPonderacion $calificacionPonderacion)
	{
		$calificacionPonderacion=$calificacionPonderacion->find($id);
		return view('calificacionPonderacions.show', compact('calificacionPonderacion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, CalificacionPonderacion $calificacionPonderacion)
	{
		$calificacionPonderacion=$calificacionPonderacion->find($id);
		return view('calificacionPonderacions.edit', compact('calificacionPonderacion'))
			->with( 'list', CalificacionPonderacion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, CalificacionPonderacion $calificacionPonderacion)
	{
		$calificacionPonderacion=$calificacionPonderacion->find($id);
		return view('calificacionPonderacions.duplicate', compact('calificacionPonderacion'))
			->with( 'list', CalificacionPonderacion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, CalificacionPonderacion $calificacionPonderacion, updateCalificacionPonderacion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$calificacionPonderacion=$calificacionPonderacion->find($id);
		$calificacionPonderacion->update( $input );

		return redirect()->route('calificacionPonderacions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,CalificacionPonderacion $calificacionPonderacion)
	{
		$calificacionPonderacion=$calificacionPonderacion->find($id);
		$calificacionPonderacion->delete();

		return redirect()->route('calificacionPonderacions.index')->with('message', 'Registro Borrado.');
	}

}
