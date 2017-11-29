<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Diplomado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateDiplomado;
use App\Http\Requests\createDiplomado;

class DiplomadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$diplomados = Diplomado::getAllData($request);

		return view('diplomados.index', compact('diplomados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('diplomados.create')
			->with( 'list', Diplomado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createDiplomado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Diplomado::create( $input );

		return redirect()->route('diplomados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Diplomado $diplomado)
	{
		$diplomado=$diplomado->find($id);
		return view('diplomados.show', compact('diplomado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Diplomado $diplomado)
	{
		$diplomado=$diplomado->find($id);
		return view('diplomados.edit', compact('diplomado'))
			->with( 'list', Diplomado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Diplomado $diplomado)
	{
		$diplomado=$diplomado->find($id);
		return view('diplomados.duplicate', compact('diplomado'))
			->with( 'list', Diplomado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Diplomado $diplomado, updateDiplomado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$diplomado=$diplomado->find($id);
		$diplomado->update( $input );

		return redirect()->route('diplomados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Diplomado $diplomado)
	{
		$diplomado=$diplomado->find($id);
		$diplomado->delete();

		return redirect()->route('diplomados.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbSubdiplomados($id=0){
		//dd($_REQUEST['estado']);
		$e = $_REQUEST['diplomado'];
        $subdiplomados = Diplomado::find($e)->subdiplomados;
        //dd($municipios);
        return $subdiplomados->pluck('name', 'id');

	}
}
