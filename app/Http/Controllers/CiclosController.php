<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ciclo;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCiclo;
use App\Http\Requests\createCiclo;

class CiclosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$ciclos = Ciclo::getAllData($request);

		return view('ciclos.index', compact('ciclos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ciclos.create')
			->with( 'list', Ciclo::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCiclo $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Ciclo::create( $input );

		return redirect()->route('ciclos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Ciclo $ciclo)
	{
		$ciclo=$ciclo->find($id);
		return view('ciclos.show', compact('ciclo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Ciclo $ciclo)
	{
		$ciclo=$ciclo->find($id);
		return view('ciclos.edit', compact('ciclo'))
			->with( 'list', Ciclo::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Ciclo $ciclo)
	{
		$ciclo=$ciclo->find($id);
		return view('ciclos.duplicate', compact('ciclo'))
			->with( 'list', Ciclo::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Ciclo $ciclo, updateCiclo $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$ciclo=$ciclo->find($id);
		$ciclo->update( $input );

		return redirect()->route('ciclos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Ciclo $ciclo)
	{
		$ciclo=$ciclo->find($id);
		$ciclo->delete();

		return redirect()->route('ciclos.index')->with('message', 'Registro Borrado.');
	}

}
