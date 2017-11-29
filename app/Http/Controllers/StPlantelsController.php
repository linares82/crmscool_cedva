<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StPlantel;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStPlantel;
use App\Http\Requests\createStPlantel;

class StPlantelsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stPlantels = StPlantel::getAllData($request);

		return view('stPlantels.index', compact('stPlantels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stPlantels.create')
			->with( 'list', StPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStPlantel $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StPlantel::create( $input );

		return redirect()->route('stPlantels.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StPlantel $stPlantel)
	{
		$stPlantel=$stPlantel->find($id);
		return view('stPlantels.show', compact('stPlantel'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StPlantel $stPlantel)
	{
		$stPlantel=$stPlantel->find($id);
		return view('stPlantels.edit', compact('stPlantel'))
			->with( 'list', StPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StPlantel $stPlantel)
	{
		$stPlantel=$stPlantel->find($id);
		return view('stPlantels.duplicate', compact('stPlantel'))
			->with( 'list', StPlantel::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StPlantel $stPlantel, updateStPlantel $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stPlantel=$stPlantel->find($id);
		$stPlantel->update( $input );

		return redirect()->route('stPlantels.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StPlantel $stPlantel)
	{
		$stPlantel=$stPlantel->find($id);
		$stPlantel->delete();

		return redirect()->route('stPlantels.index')->with('message', 'Registro Borrado.');
	}

}
