<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Medio;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateMedio;
use App\Http\Requests\createMedio;

class MediosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$medios = Medio::getAllData($request);

		return view('medios.index', compact('medios'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('medios.create')
			->with( 'list', Medio::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createMedio $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Medio::create( $input );

		return redirect()->route('medios.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Medio $medio)
	{
		$medio=$medio->find($id);
		return view('medios.show', compact('medio'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Medio $medio)
	{
		$medio=$medio->find($id);
		return view('medios.edit', compact('medio'))
			->with( 'list', Medio::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Medio $medio)
	{
		$medio=$medio->find($id);
		return view('medios.duplicate', compact('medio'))
			->with( 'list', Medio::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Medio $medio, updateMedio $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$medio=$medio->find($id);
		$medio->update( $input );

		return redirect()->route('medios.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Medio $medio)
	{
		$medio=$medio->find($id);
		$medio->delete();

		return redirect()->route('medios.index')->with('message', 'Registro Borrado.');
	}

}
