<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subdiplomado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSubdiplomado;
use App\Http\Requests\createSubdiplomado;

class SubdiplomadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$subdiplomados = Subdiplomado::getAllData($request);

		return view('subdiplomados.index', compact('subdiplomados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('subdiplomados.create')
			->with( 'list', Subdiplomado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSubdiplomado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Subdiplomado::create( $input );

		return redirect()->route('subdiplomados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Subdiplomado $subdiplomado)
	{
		$subdiplomado=$subdiplomado->find($id);
		return view('subdiplomados.show', compact('subdiplomado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Subdiplomado $subdiplomado)
	{
		$subdiplomado=$subdiplomado->find($id);
		return view('subdiplomados.edit', compact('subdiplomado'))
			->with( 'list', Subdiplomado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Subdiplomado $subdiplomado)
	{
		$subdiplomado=$subdiplomado->find($id);
		return view('subdiplomados.duplicate', compact('subdiplomado'))
			->with( 'list', Subdiplomado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Subdiplomado $subdiplomado, updateSubdiplomado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$subdiplomado=$subdiplomado->find($id);
		$subdiplomado->update( $input );

		return redirect()->route('subdiplomados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Subdiplomado $subdiplomado)
	{
		$subdiplomado=$subdiplomado->find($id);
		$subdiplomado->delete();

		return redirect()->route('subdiplomados.index')->with('message', 'Registro Borrado.');
	}

}
