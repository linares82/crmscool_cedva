<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StEmpleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStEmpleado;
use App\Http\Requests\createStEmpleado;

class StEmpleadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stEmpleados = StEmpleado::getAllData($request);

		return view('stEmpleados.index', compact('stEmpleados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stEmpleados.create')
			->with( 'list', StEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStEmpleado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StEmpleado::create( $input );

		return redirect()->route('stEmpleados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StEmpleado $stEmpleado)
	{
		$stEmpleado=$stEmpleado->find($id);
		return view('stEmpleados.show', compact('stEmpleado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StEmpleado $stEmpleado)
	{
		$stEmpleado=$stEmpleado->find($id);
		return view('stEmpleados.edit', compact('stEmpleado'))
			->with( 'list', StEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StEmpleado $stEmpleado)
	{
		$stEmpleado=$stEmpleado->find($id);
		return view('stEmpleados.duplicate', compact('stEmpleado'))
			->with( 'list', StEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StEmpleado $stEmpleado, updateStEmpleado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stEmpleado=$stEmpleado->find($id);
		$stEmpleado->update( $input );

		return redirect()->route('stEmpleados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StEmpleado $stEmpleado)
	{
		$stEmpleado=$stEmpleado->find($id);
		$stEmpleado->delete();

		return redirect()->route('stEmpleados.index')->with('message', 'Registro Borrado.');
	}

}
