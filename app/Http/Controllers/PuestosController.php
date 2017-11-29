<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Puesto;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePuesto;
use App\Http\Requests\createPuesto;

class PuestosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$puestos = Puesto::getAllData($request);

		return view('puestos.index', compact('puestos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('puestos.create')
			->with( 'list', Puesto::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPuesto $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Puesto::create( $input );

		return redirect()->route('puestos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Puesto $puesto)
	{
		$puesto=$puesto->find($id);
		return view('puestos.show', compact('puesto'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Puesto $puesto)
	{
		$puesto=$puesto->find($id);
		return view('puestos.edit', compact('puesto'))
			->with( 'list', Puesto::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Puesto $puesto)
	{
		$puesto=$puesto->find($id);
		return view('puestos.duplicate', compact('puesto'))
			->with( 'list', Puesto::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Puesto $puesto, updatePuesto $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		

		$puesto=$puesto->find($id);
		$puesto->update( $input );

		return redirect()->route('puestos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Puesto $puesto)
	{
		$puesto=$puesto->find($id);
		$puesto->delete();

		return redirect()->route('puestos.index')->with('message', 'Registro Borrado.');
	}

}
