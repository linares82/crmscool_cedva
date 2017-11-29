<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AsistenciaR;
use App\AsignacionAcademica;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAsistenciaR;
use App\Http\Requests\createAsistenciaR;

class AsistenciaRsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$asistenciaRs = AsistenciaR::getAllData($request);

		return view('asistenciaRs.index', compact('asistenciaRs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
                $asignacion_academica = AsignacionAcademica::find($id);
                //$p=$asignacion_academica->grupo->inscripciones->toArray();
                //dd($p);
		return view('asistenciaRs.create', compact('asignacion_academica'))
			->with( 'list', AsistenciaR::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAsistenciaR $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		AsistenciaR::create( $input );

		return redirect()->route('asistenciaRs.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, AsistenciaR $asistenciaR)
	{
		$asistenciaR=$asistenciaR->find($id);
		return view('asistenciaRs.show', compact('asistenciaR'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, AsistenciaR $asistenciaR)
	{
		$asistenciaR=$asistenciaR->find($id);
		return view('asistenciaRs.edit', compact('asistenciaR'))
			->with( 'list', AsistenciaR::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, AsistenciaR $asistenciaR)
	{
		$asistenciaR=$asistenciaR->find($id);
		return view('asistenciaRs.duplicate', compact('asistenciaR'))
			->with( 'list', AsistenciaR::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, AsistenciaR $asistenciaR, updateAsistenciaR $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$asistenciaR=$asistenciaR->find($id);
		$asistenciaR->update( $input );

		return redirect()->route('asistenciaRs.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,AsistenciaR $asistenciaR)
	{
		$asistenciaR=$asistenciaR->find($id);
		$asistenciaR->delete();

		return redirect()->route('asistenciaRs.index')->with('message', 'Registro Borrado.');
	}

}
