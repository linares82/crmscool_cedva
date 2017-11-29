<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StSeguimiento;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStSeguimiento;
use App\Http\Requests\createStSeguimiento;

class StSeguimientosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stSeguimientos = StSeguimiento::getAllData($request);

		return view('stSeguimientos.index', compact('stSeguimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stSeguimientos.create')
			->with( 'list', StSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStSeguimiento $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StSeguimiento::create( $input );

		return redirect()->route('stSeguimientos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StSeguimiento $stSeguimiento)
	{
		$stSeguimiento=$stSeguimiento->find($id);
		return view('stSeguimientos.show', compact('stSeguimiento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StSeguimiento $stSeguimiento)
	{
		$stSeguimiento=$stSeguimiento->find($id);
		return view('stSeguimientos.edit', compact('stSeguimiento'))
			->with( 'list', StSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StSeguimiento $stSeguimiento)
	{
		$stSeguimiento=$stSeguimiento->find($id);
		return view('stSeguimientos.duplicate', compact('stSeguimiento'))
			->with( 'list', StSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StSeguimiento $stSeguimiento, updateStSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stSeguimiento=$stSeguimiento->find($id);
		$stSeguimiento->update( $input );

		return redirect()->route('stSeguimientos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StSeguimiento $stSeguimiento)
	{
		$stSeguimiento=$stSeguimiento->find($id);
		$stSeguimiento->delete();

		return redirect()->route('stSeguimientos.index')->with('message', 'Registro Borrado.');
	}

}
