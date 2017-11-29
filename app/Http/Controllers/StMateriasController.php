<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StMateria;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStMateria;
use App\Http\Requests\createStMateria;

class StMateriasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stMaterias = StMateria::getAllData($request);

		return view('stMaterias.index', compact('stMaterias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stMaterias.create')
			->with( 'list', StMateria::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStMateria $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StMateria::create( $input );

		return redirect()->route('stMaterias.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StMateria $stMateria)
	{
		$stMateria=$stMateria->find($id);
		return view('stMaterias.show', compact('stMateria'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StMateria $stMateria)
	{
		$stMateria=$stMateria->find($id);
		return view('stMaterias.edit', compact('stMateria'))
			->with( 'list', StMateria::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StMateria $stMateria)
	{
		$stMateria=$stMateria->find($id);
		return view('stMaterias.duplicate', compact('stMateria'))
			->with( 'list', StMateria::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StMateria $stMateria, updateStMateria $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stMateria=$stMateria->find($id);
		$stMateria->update( $input );

		return redirect()->route('stMaterias.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StMateria $stMateria)
	{
		$stMateria=$stMateria->find($id);
		$stMateria->delete();

		return redirect()->route('stMaterias.index')->with('message', 'Registro Borrado.');
	}

}
