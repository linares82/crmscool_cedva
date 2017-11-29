<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AsistenciasC;
use App\Empleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAsistenciasC;
use App\Http\Requests\createAsistenciasC;


class AsistenciasCsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$asistenciasCs = AsistenciasC::getAllData($request);

		return view('asistenciasCs.index', compact('asistenciasCs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
                $e=Empleado::where('user_id', '=', Auth::user()->id)->first();
                
		return view('asistenciasCs.create', compact('e'))
			->with( 'list', AsistenciasC::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAsistenciasC $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		AsistenciasC::create( $input );

		return redirect()->route('asistenciasCs.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, AsistenciasC $asistenciasC)
	{
		$asistenciasC=$asistenciasC->find($id);
		return view('asistenciasCs.show', compact('asistenciasC'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, AsistenciasC $asistenciasC)
	{
		$asistenciasC=$asistenciasC->find($id);
		return view('asistenciasCs.edit', compact('asistenciasC'))
			->with( 'list', AsistenciasC::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, AsistenciasC $asistenciasC)
	{
		$asistenciasC=$asistenciasC->find($id);
		return view('asistenciasCs.duplicate', compact('asistenciasC'))
			->with( 'list', AsistenciasC::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, AsistenciasC $asistenciasC, updateAsistenciasC $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$asistenciasC=$asistenciasC->find($id);
		$asistenciasC->update( $input );

		return redirect()->route('asistenciasCs.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,AsistenciasC $asistenciasC)
	{
		$asistenciasC=$asistenciasC->find($id);
		$asistenciasC->delete();

		return redirect()->route('asistenciasCs.index')->with('message', 'Registro Borrado.');
	}

}
