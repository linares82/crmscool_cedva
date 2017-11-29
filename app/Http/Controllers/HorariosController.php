<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Horario;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateHorario;
use App\Http\Requests\createHorario;

class HorariosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$horarios = Horario::getAllData($request);

		return view('horarios.index', compact('horarios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('horarios.create')
			->with( 'list', Horario::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createHorario $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Horario::create( $input );

		return redirect()->route('horarios.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Horario $horario)
	{
		$horario=$horario->find($id);
		return view('horarios.show', compact('horario'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Horario $horario)
	{
		$horario=$horario->find($id);
		return view('horarios.edit', compact('horario'))
			->with( 'list', Horario::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Horario $horario)
	{
		$horario=$horario->find($id);
		return view('horarios.duplicate', compact('horario'))
			->with( 'list', Horario::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Horario $horario, updateHorario $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$horario=$horario->find($id);
		$horario->update( $input );

		return redirect()->route('horarios.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Horario $horario)
	{
		$horario=$horario->find($id);
		$aa=$horario->asignacion_academica_id;
		$horario->delete();

		return redirect()->route('asignacionAcademicas.edit', $aa)->with('message', 'Registro Borrado.');
	}

}
