<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CambioStSeguimiento;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCambioStSeguimiento;
use App\Http\Requests\createCambioStSeguimiento;

class CambioStSeguimientosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$cambioStSeguimientos = CambioStSeguimiento::getAllData($request);

		return view('cambioStSeguimientos.index', compact('cambioStSeguimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cambioStSeguimientos.create')
			->with( 'list', CambioStSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCambioStSeguimiento $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		CambioStSeguimiento::create( $input );

		return redirect()->route('cambioStSeguimientos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, CambioStSeguimiento $cambioStSeguimiento)
	{
		$cambioStSeguimiento=$cambioStSeguimiento->find($id);
		return view('cambioStSeguimientos.show', compact('cambioStSeguimiento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, CambioStSeguimiento $cambioStSeguimiento)
	{
		$cambioStSeguimiento=$cambioStSeguimiento->find($id);
		return view('cambioStSeguimientos.edit', compact('cambioStSeguimiento'))
			->with( 'list', CambioStSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, CambioStSeguimiento $cambioStSeguimiento)
	{
		$cambioStSeguimiento=$cambioStSeguimiento->find($id);
		return view('cambioStSeguimientos.duplicate', compact('cambioStSeguimiento'))
			->with( 'list', CambioStSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, CambioStSeguimiento $cambioStSeguimiento, updateCambioStSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$cambioStSeguimiento=$cambioStSeguimiento->find($id);
		$cambioStSeguimiento->update( $input );

		return redirect()->route('cambioStSeguimientos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,CambioStSeguimiento $cambioStSeguimiento)
	{
		$cambioStSeguimiento=$cambioStSeguimiento->find($id);
		$cambioStSeguimiento->delete();

		return redirect()->route('cambioStSeguimientos.index')->with('message', 'Registro Borrado.');
	}

}
