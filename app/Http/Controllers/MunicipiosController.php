<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Municipio;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateMunicipio;
use App\Http\Requests\createMunicipio;

class MunicipiosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$municipios = Municipio::getAllData($request);

		return view('municipios.index', compact('municipios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('municipios.create')
			->with( 'list', Municipio::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createMunicipio $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Municipio::create( $input );

		return redirect()->route('municipios.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Municipio $municipio)
	{
		$municipio=$municipio->find($id);
		return view('municipios.show', compact('municipio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Municipio $municipio)
	{
		$municipio=$municipio->find($id);
		return view('municipios.edit', compact('municipio'))
			->with( 'list', Municipio::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Municipio $municipio)
	{
		$municipio=$municipio->find($id);
		return view('municipios.duplicate', compact('municipio'))
			->with( 'list', Municipio::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Municipio $municipio, updateMunicipio $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$municipio=$municipio->find($id);
		$municipio->update( $input );

		return redirect()->route('municipios.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Municipio $municipio)
	{
		$municipio=$municipio->find($id);
		$municipio->delete();

		return redirect()->route('municipios.index')->with('message', 'Registro Borrado.');
	}

	

}
