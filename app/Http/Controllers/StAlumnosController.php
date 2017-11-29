<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StAlumno;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateStAlumno;
use App\Http\Requests\createStAlumno;

class StAlumnosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$stAlumnos = StAlumno::getAllData($request);

		return view('stAlumnos.index', compact('stAlumnos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('stAlumnos.create')
			->with( 'list', StAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createStAlumno $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		StAlumno::create( $input );

		return redirect()->route('stAlumnos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, StAlumno $stAlumno)
	{
		$stAlumno=$stAlumno->find($id);
		return view('stAlumnos.show', compact('stAlumno'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, StAlumno $stAlumno)
	{
		$stAlumno=$stAlumno->find($id);
		return view('stAlumnos.edit', compact('stAlumno'))
			->with( 'list', StAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, StAlumno $stAlumno)
	{
		$stAlumno=$stAlumno->find($id);
		return view('stAlumnos.duplicate', compact('stAlumno'))
			->with( 'list', StAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, StAlumno $stAlumno, updateStAlumno $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$stAlumno=$stAlumno->find($id);
		$stAlumno->update( $input );

		return redirect()->route('stAlumnos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,StAlumno $stAlumno)
	{
		$stAlumno=$stAlumno->find($id);
		$stAlumno->delete();

		return redirect()->route('stAlumnos.index')->with('message', 'Registro Borrado.');
	}

}
