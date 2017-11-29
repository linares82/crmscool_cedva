<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PreguntaCliente;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePreguntaCliente;
use App\Http\Requests\createPreguntaCliente;

class PreguntaClientesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$preguntaClientes = PreguntaCliente::getAllData($request);

		return view('preguntaClientes.index', compact('preguntaClientes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('preguntaClientes.create')
			->with( 'list', PreguntaCliente::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPreguntaCliente $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		PreguntaCliente::create( $input );

		return redirect()->route('preguntaClientes.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, PreguntaCliente $preguntaCliente)
	{
		$preguntaCliente=$preguntaCliente->find($id);
		return view('preguntaClientes.show', compact('preguntaCliente'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, PreguntaCliente $preguntaCliente)
	{
		$preguntaCliente=$preguntaCliente->find($id);
		return view('preguntaClientes.edit', compact('preguntaCliente'))
			->with( 'list', PreguntaCliente::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, PreguntaCliente $preguntaCliente)
	{
		$preguntaCliente=$preguntaCliente->find($id);
		return view('preguntaClientes.duplicate', compact('preguntaCliente'))
			->with( 'list', PreguntaCliente::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, PreguntaCliente $preguntaCliente, updatePreguntaCliente $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$preguntaCliente=$preguntaCliente->find($id);
		$preguntaCliente->update( $input );

		return redirect()->route('preguntaClientes.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,PreguntaCliente $preguntaCliente)
	{
		$preguntaCliente=$preguntaCliente->find($id);
		$preguntaCliente->delete();

		return redirect()->route('clientes.edit', $preguntaCliente->cliente_id)->with('message', 'Registro Borrado.');
	}

}
