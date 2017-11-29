<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StTarea;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStTarea;
use App\Http\Requests\createStTarea;

class StTareasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stTareas = StTarea::getAllData($request);

		return view('stTareas.index', compact('stTareas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stTareas.create')
			->with( 'list', StTarea::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStTarea $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StTarea::create( $input );

		return redirect()->route('stTareas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StTarea $stTarea)
	{
		$stTarea=$stTarea->find($id);
		return view('stTareas.show', compact('stTarea'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StTarea $stTarea)
	{
		$stTarea=$stTarea->find($id);
		return view('stTareas.edit', compact('stTarea'))
			->with( 'list', StTarea::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StTarea $stTarea)
	{
		$stTarea=$stTarea->find($id);
		return view('stTareas.duplicate', compact('stTarea'))
			->with( 'list', StTarea::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StTarea $stTarea, updateStTarea $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stTarea=$stTarea->find($id);
		$stTarea->update( $input );

		return redirect()->route('stTareas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StTarea $stTarea)
	{
		$stTarea=$stTarea->find($id);
		$stTarea->delete();

		return redirect()->route('stTareas.index')->with('message', 'Registro Borrado.');
	}

}
