<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Hactividade;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateHactividade;
use App\Http\Requests\createHactividade;

class HactividadesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$hactividades = Hactividade::getAllData($request);

		return view('hactividades.index', compact('hactividades'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('hactividades.create')
			->with( 'list', Hactividade::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createHactividade $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Hactividade::create( $input );

		return redirect()->route('hactividades.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Hactividade $hactividade)
	{
		$hactividade=$hactividade->find($id);
		return view('hactividades.show', compact('hactividade'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Hactividade $hactividade)
	{
		$hactividade=$hactividade->find($id);
		return view('hactividades.edit', compact('hactividade'))
			->with( 'list', Hactividade::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Hactividade $hactividade)
	{
		$hactividade=$hactividade->find($id);
		return view('hactividades.duplicate', compact('hactividade'))
			->with( 'list', Hactividade::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Hactividade $hactividade, updateHactividade $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$hactividade=$hactividade->find($id);
		$hactividade->update( $input );

		return redirect()->route('hactividades.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Hactividade $hactividade)
	{
		$hactividade=$hactividade->find($id);
		$hactividade->delete();

		return redirect()->route('hactividades.index')->with('message', 'Registro Borrado.');
	}

}
