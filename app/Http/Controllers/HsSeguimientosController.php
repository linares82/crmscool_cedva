<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\HsSeguimiento;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateHsSeguimiento;
use App\Http\Requests\createHsSeguimiento;

class HsSeguimientosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$hsSeguimientos = HsSeguimiento::getAllData($request);

		return view('hsSeguimientos.index', compact('hsSeguimientos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('hsSeguimientos.create')
			->with( 'list', HsSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createHsSeguimiento $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		HsSeguimiento::create( $input );

		return redirect()->route('hsSeguimientos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, HsSeguimiento $hsSeguimiento)
	{
		$hsSeguimiento=$hsSeguimiento->find($id);
		return view('hsSeguimientos.show', compact('hsSeguimiento'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, HsSeguimiento $hsSeguimiento)
	{
		$hsSeguimiento=$hsSeguimiento->find($id);
		return view('hsSeguimientos.edit', compact('hsSeguimiento'))
			->with( 'list', HsSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, HsSeguimiento $hsSeguimiento)
	{
		$hsSeguimiento=$hsSeguimiento->find($id);
		return view('hsSeguimientos.duplicate', compact('hsSeguimiento'))
			->with( 'list', HsSeguimiento::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, HsSeguimiento $hsSeguimiento, updateHsSeguimiento $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$hsSeguimiento=$hsSeguimiento->find($id);
		$hsSeguimiento->update( $input );

		return redirect()->route('hsSeguimientos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,HsSeguimiento $hsSeguimiento)
	{
		$hsSeguimiento=$hsSeguimiento->find($id);
		$hsSeguimiento->delete();

		return redirect()->route('hsSeguimientos.index')->with('message', 'Registro Borrado.');
	}

}
