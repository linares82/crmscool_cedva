<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Param;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateParam;
use App\Http\Requests\createParam;

class ParamsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$params = Param::getAllData($request);

		return view('params.index', compact('params'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('params.create')
			->with( 'list', Param::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createParam $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Param::create( $input );

		return redirect()->route('params.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Param $param)
	{
		$param=$param->find($id);
		return view('params.show', compact('param'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Param $param)
	{
		$param=$param->find($id);
		return view('params.edit', compact('param'))
			->with( 'list', Param::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Param $param)
	{
		$param=$param->find($id);
		return view('params.duplicate', compact('param'))
			->with( 'list', Param::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Param $param, updateParam $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$param=$param->find($id);
		$param->update( $input );

		return redirect()->route('params.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Param $param)
	{
		$param=$param->find($id);
		$param->delete();

		return redirect()->route('params.index')->with('message', 'Registro Borrado.');
	}

}
