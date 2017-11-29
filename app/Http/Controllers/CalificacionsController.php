<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Calificacion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCalificacion;
use App\Http\Requests\createCalificacion;

class CalificacionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$calificacions = Calificacion::getAllData($request);

		return view('calificacions.index', compact('calificacions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('calificacions.create')
			->with( 'list', Calificacion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCalificacion $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Calificacion::create( $input );

		return redirect()->route('calificacions.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Calificacion $calificacion)
	{
		$calificacion=$calificacion->find($id);
		return view('calificacions.show', compact('calificacion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Calificacion $calificacion)
	{
		$calificacion=$calificacion->find($id);
		return view('calificacions.edit', compact('calificacion'))
			->with( 'list', Calificacion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Calificacion $calificacion)
	{
		$calificacion=$calificacion->find($id);
		return view('calificacions.duplicate', compact('calificacion'))
			->with( 'list', Calificacion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Calificacion $calificacion, updateCalificacion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$calificacion=$calificacion->find($id);
		$calificacion->update( $input );

		return redirect()->route('calificacions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Calificacion $calificacion)
	{
		$calificacion=$calificacion->find($id);
		$calificacion->delete();

		return redirect()->route('calificacions.index')->with('message', 'Registro Borrado.');
	}

}
