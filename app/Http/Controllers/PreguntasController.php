<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Preguntum;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePreguntum;
use App\Http\Requests\createPreguntum;

class PreguntasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$preguntas = Preguntum::getAllData($request);

		return view('preguntas.index', compact('preguntas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('preguntas.create')
			->with( 'list', Preguntum::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPreguntum $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Preguntum::create( $input );

		return redirect()->route('preguntas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Preguntum $preguntum)
	{
		$preguntum=$preguntum->find($id);
		return view('preguntas.show', compact('preguntum'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Preguntum $preguntum)
	{
		$preguntum=$preguntum->find($id);
		return view('preguntas.edit', compact('preguntum'))
			->with( 'list', Preguntum::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Preguntum $preguntum)
	{
		$preguntum=$preguntum->find($id);
		return view('preguntas.duplicate', compact('preguntum'))
			->with( 'list', Preguntum::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Preguntum $preguntum, updatePreguntum $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$preguntum=$preguntum->find($id);
		$preguntum->update( $input );

		return redirect()->route('preguntas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Preguntum $preguntum)
	{
		$preguntum=$preguntum->find($id);
		$preguntum->delete();

		return redirect()->route('preguntas.index')->with('message', 'Registro Borrado.');
	}

}
