<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subcurso;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSubcurso;
use App\Http\Requests\createSubcurso;

class SubcursosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$subcursos = Subcurso::getAllData($request);

		return view('subcursos.index', compact('subcursos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('subcursos.create')
			->with( 'list', Subcurso::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSubcurso $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Subcurso::create( $input );

		return redirect()->route('subcursos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Subcurso $subcurso)
	{
		$subcurso=$subcurso->find($id);
		return view('subcursos.show', compact('subcurso'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Subcurso $subcurso)
	{
		$subcurso=$subcurso->find($id);
		return view('subcursos.edit', compact('subcurso'))
			->with( 'list', Subcurso::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Subcurso $subcurso)
	{
		$subcurso=$subcurso->find($id);
		return view('subcursos.duplicate', compact('subcurso'))
			->with( 'list', Subcurso::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Subcurso $subcurso, updateSubcurso $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$subcurso=$subcurso->find($id);
		$subcurso->update( $input );

		return redirect()->route('subcursos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Subcurso $subcurso)
	{
		$subcurso=$subcurso->find($id);
		$subcurso->delete();

		return redirect()->route('subcursos.index')->with('message', 'Registro Borrado.');
	}

}
