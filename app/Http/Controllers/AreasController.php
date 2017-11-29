<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Area;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateArea;
use App\Http\Requests\createArea;

class AreasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$areas = Area::getAllData($request);

		return view('areas.index', compact('areas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('areas.create')
			->with( 'list', Area::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createArea $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Area::create( $input );

		return redirect()->route('areas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Area $area)
	{
		$area=$area->find($id);
		return view('areas.show', compact('area'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Area $area)
	{
		$area=$area->find($id);
		return view('areas.edit', compact('area'))
			->with( 'list', Area::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Area $area)
	{
		$area=$area->find($id);

		return view('areas.duplicate', compact('area'))
			->with( 'list', Area::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Area $area, updateArea $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		
		$area=$area->find($id);
		$area->update( $input );

		return redirect()->route('areas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Area $area)
	{
		$area=$area->find($id);
		$area->delete();

		return redirect()->route('areas.index')->with('message', 'Registro Borrado.');
	}

}
