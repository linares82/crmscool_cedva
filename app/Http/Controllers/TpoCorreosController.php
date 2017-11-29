<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TpoCorreo;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateTpoCorreo;
use App\Http\Requests\createTpoCorreo;

class TpoCorreosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$tpoCorreos = TpoCorreo::getAllData($request);

		return view('tpoCorreos.index', compact('tpoCorreos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tpoCorreos.create')
			->with( 'list', TpoCorreo::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createTpoCorreo $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		TpoCorreo::create( $input );

		return redirect()->route('tpoCorreos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, TpoCorreo $tpoCorreo)
	{
		$tpoCorreo=$tpoCorreo->find($id);
		return view('tpoCorreos.show', compact('tpoCorreo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, TpoCorreo $tpoCorreo)
	{
		$tpoCorreo=$tpoCorreo->find($id);
		return view('tpoCorreos.edit', compact('tpoCorreo'))
			->with( 'list', TpoCorreo::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, TpoCorreo $tpoCorreo)
	{
		$tpoCorreo=$tpoCorreo->find($id);
		return view('tpoCorreos.duplicate', compact('tpoCorreo'))
			->with( 'list', TpoCorreo::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, TpoCorreo $tpoCorreo, updateTpoCorreo $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$tpoCorreo=$tpoCorreo->find($id);
		$tpoCorreo->update( $input );

		return redirect()->route('tpoCorreos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,TpoCorreo $tpoCorreo)
	{
		$tpoCorreo=$tpoCorreo->find($id);
		$tpoCorreo->delete();

		return redirect()->route('tpoCorreos.index')->with('message', 'Registro Borrado.');
	}

}
