<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dium;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateDium;
use App\Http\Requests\createDium;

class DiasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$dias = Dium::getAllData($request);

		return view('dias.index', compact('dias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('dias.create')
			->with( 'list', Dium::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createDium $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Dium::create( $input );

		return redirect()->route('dias.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Dium $dium)
	{
		$dium=$dium->find($id);
		return view('dias.show', compact('dium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Dium $dium)
	{
		$dium=$dium->find($id);
		return view('dias.edit', compact('dium'))
			->with( 'list', Dium::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Dium $dium)
	{
		$dium=$dium->find($id);
		return view('dias.duplicate', compact('dium'))
			->with( 'list', Dium::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Dium $dium, updateDium $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$dium=$dium->find($id);
		$dium->update( $input );

		return redirect()->route('dias.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Dium $dium)
	{
		$dium=$dium->find($id);
		$dium->delete();

		return redirect()->route('dias.index')->with('message', 'Registro Borrado.');
	}

}
