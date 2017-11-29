<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Promocion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePromocion;
use App\Http\Requests\createPromocion;

class PromocionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$promocions = Promocion::getAllData($request);

		return view('promocions.index', compact('promocions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('promocions.create')
			->with( 'list', Promocion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPromocion $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		if(!isset($input['activa'])){
			$input['activa']=0;
		}else{
			$input['activa']=1;
		}

		//create data
		Promocion::create( $input );

		return redirect()->route('promocions.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Promocion $promocion)
	{
		$promocion=$promocion->find($id);
		return view('promocions.show', compact('promocion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Promocion $promocion)
	{
		$promocion=$promocion->find($id);
		return view('promocions.edit', compact('promocion'))
			->with( 'list', Promocion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Promocion $promocion)
	{
		$promocion=$promocion->find($id);
		return view('promocions.duplicate', compact('promocion'))
			->with( 'list', Promocion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Promocion $promocion, updatePromocion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['activa'])){
			$input['activa']=0;
		}else{
			$input['activa']=1;
		}
		//update data
		$promocion=$promocion->find($id);
		$promocion->update( $input );

		return redirect()->route('promocions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Promocion $promocion)
	{
		$promocion=$promocion->find($id);
		$promocion->delete();

		return redirect()->route('promocions.index')->with('message', 'Registro Borrado.');
	}

}
