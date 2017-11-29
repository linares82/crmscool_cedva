<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StCliente;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStCliente;
use App\Http\Requests\createStCliente;

class StClientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stClientes = StCliente::getAllData($request);

		return view('stClientes.index', compact('stClientes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stClientes.create')
			->with( 'list', StCliente::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStCliente $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StCliente::create( $input );

		return redirect()->route('stClientes.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StCliente $stCliente)
	{
		$stCliente=$stCliente->find($id);
		return view('stClientes.show', compact('stCliente'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StCliente $stCliente)
	{
		$stCliente=$stCliente->find($id);
		return view('stClientes.edit', compact('stCliente'))
			->with( 'list', StCliente::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StCliente $stCliente)
	{
		$stCliente=$stCliente->find($id);
		return view('stClientes.duplicate', compact('stCliente'))
			->with( 'list', StCliente::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StCliente $stCliente, updateStCliente $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stCliente=$stCliente->find($id);
		$stCliente->update( $input );

		return redirect()->route('stClientes.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StCliente $stCliente)
	{
		$stCliente=$stCliente->find($id);
		$stCliente->delete();

		return redirect()->route('stClientes.index')->with('message', 'Registro Borrado.');
	}

}
