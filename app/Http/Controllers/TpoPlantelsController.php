<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TpoPlantel;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateTpoPlantel;
use App\Http\Requests\createTpoPlantel;

class TpoPlantelsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$tpoPlantels = TpoPlantel::getAllData($request);

		return view('tpoPlantels.index', compact('tpoPlantels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tpoPlantels.create')
			->with( 'list', TpoPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createTpoPlantel $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		TpoPlantel::create( $input );

		return redirect()->route('tpoPlantels.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, TpoPlantel $tpoPlantel)
	{
		$tpoPlantel=$tpoPlantel->find($id);
		return view('tpoPlantels.show', compact('tpoPlantel'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, TpoPlantel $tpoPlantel)
	{
		$tpoPlantel=$tpoPlantel->find($id);
		return view('tpoPlantels.edit', compact('tpoPlantel'))
			->with( 'list', TpoPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, TpoPlantel $tpoPlantel)
	{
		$tpoPlantel=$tpoPlantel->find($id);
		return view('tpoPlantels.duplicate', compact('tpoPlantel'))
			->with( 'list', TpoPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, TpoPlantel $tpoPlantel, updateTpoPlantel $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$tpoPlantel=$tpoPlantel->find($id);
		$tpoPlantel->update( $input );

		return redirect()->route('tpoPlantels.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,TpoPlantel $tpoPlantel)
	{
		$tpoPlantel=$tpoPlantel->find($id);
		$tpoPlantel->delete();

		return redirect()->route('tpoPlantels.index')->with('message', 'Registro Borrado.');
	}

}
