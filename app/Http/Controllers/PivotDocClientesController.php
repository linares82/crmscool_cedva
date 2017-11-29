<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PivotDocCliente;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePivotDocCliente;
use App\Http\Requests\createPivotDocCliente;

class PivotDocClientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$pivotDocEmpleados = PivotDocEmpleado::getAllData($request);

		return view('pivotDocEmpleados.index', compact('pivotDocEmpleados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pivotDocEmpleados.create')
			->with( 'list', PivotDocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPivotDocEmpleado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		PivotDocEmpleado::create( $input );

		return redirect()->route('pivotDocEmpleados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, PivotDocEmpleado $pivotDocEmpleado)
	{
		$pivotDocEmpleado=$pivotDocEmpleado->find($id);
		return view('pivotDocEmpleados.show', compact('pivotDocEmpleado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, PivotDocEmpleado $pivotDocEmpleado)
	{
		$pivotDocEmpleado=$pivotDocEmpleado->find($id);
		return view('pivotDocEmpleados.edit', compact('pivotDocEmpleado'))
			->with( 'list', PivotDocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, PivotDocEmpleado $pivotDocEmpleado)
	{
		$pivotDocEmpleado=$pivotDocEmpleado->find($id);
		return view('pivotDocEmpleados.duplicate', compact('pivotDocEmpleado'))
			->with( 'list', PivotDocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, PivotDocEmpleado $pivotDocEmpleado, updatePivotDocEmpleado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$pivotDocEmpleado=$pivotDocEmpleado->find($id);
		$pivotDocEmpleado->update( $input );

		return redirect()->route('pivotDocEmpleados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,PivotDocCliente $pivotDocCliente)
	{
		$pivotDocCliente=$pivotDocCliente->find($id);
		$cliente=$pivotDocCliente->cliente_id;
		$pivotDocCliente->delete();


		return redirect()->route('clientes.edit', $cliente)->with('message', 'Registro Borrado.');
	}

}
