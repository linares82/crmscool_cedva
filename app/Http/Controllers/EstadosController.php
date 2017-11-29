<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Estado;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateEstado;
use App\Http\Requests\createEstado;

class EstadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$estados = Estado::getAllData($request);

		return view('estados.index', compact('estados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('estados.create')
			->with( 'list', Estado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createEstado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Estado::create( $input );

		return redirect()->route('estados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Estado $estado)
	{
		$estado=$estado->find($id);
		return view('estados.show', compact('estado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Estado $estado)
	{
		$estado=$estado->find($id);
		return view('estados.edit', compact('estado'))
			->with( 'list', Estado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Estado $estado)
	{
		$estado=$estado->find($id);
		return view('estados.duplicate', compact('estado'))
			->with( 'list', Estado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Estado $estado, updateEstado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$estado=$estado->find($id);
		$estado->update( $input );

		return redirect()->route('estados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Estado $estado)
	{
		$estado=$estado->find($id);
		$estado->delete();

		return redirect()->route('estados.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbMunicipios($id=0){
		//dd($_REQUEST['estado']);
		$e = $_REQUEST['estado'];
        $municipios = Estado::find($e)->municipios;
        //dd($municipios);
        return $municipios->pluck('name', 'id');

	}

}
