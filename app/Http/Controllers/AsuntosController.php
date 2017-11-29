<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Asunto;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAsunto;
use App\Http\Requests\createAsunto;

class AsuntosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$asuntos = Asunto::getAllData($request);

		return view('asuntos.index', compact('asuntos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('asuntos.create')
			->with( 'list', Asunto::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAsunto $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Asunto::create( $input );

		return redirect()->route('asuntos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Asunto $asunto)
	{
		$asunto=$asunto->find($id);
		return view('asuntos.show', compact('asunto'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Asunto $asunto)
	{
		$asunto=$asunto->find($id);
		return view('asuntos.edit', compact('asunto'))
			->with( 'list', Asunto::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Asunto $asunto)
	{
		$asunto=$asunto->find($id);
		return view('asuntos.duplicate', compact('asunto'))
			->with( 'list', Asunto::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Asunto $asunto, updateAsunto $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$asunto=$asunto->find($id);
		$asunto->update( $input );

		return redirect()->route('asuntos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Asunto $asunto)
	{
		$asunto=$asunto->find($id);
		$asunto->delete();

		return redirect()->route('asuntos.index')->with('message', 'Registro Borrado.');
	}

}
