<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TpoExamen;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateTpoExamen;
use App\Http\Requests\createTpoExamen;

class TpoExamensController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$tpoExamens = TpoExamen::getAllData($request);

		return view('tpoExamens.index', compact('tpoExamens'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tpoExamens.create')
			->with( 'list', TpoExamen::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createTpoExamen $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		TpoExamen::create( $input );

		return redirect()->route('tpoExamens.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, TpoExamen $tpoExamen)
	{
		$tpoExamen=$tpoExamen->find($id);
		return view('tpoExamens.show', compact('tpoExamen'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, TpoExamen $tpoExamen)
	{
		$tpoExamen=$tpoExamen->find($id);
		return view('tpoExamens.edit', compact('tpoExamen'))
			->with( 'list', TpoExamen::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, TpoExamen $tpoExamen)
	{
		$tpoExamen=$tpoExamen->find($id);
		return view('tpoExamens.duplicate', compact('tpoExamen'))
			->with( 'list', TpoExamen::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, TpoExamen $tpoExamen, updateTpoExamen $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$tpoExamen=$tpoExamen->find($id);
		$tpoExamen->update( $input );

		return redirect()->route('tpoExamens.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,TpoExamen $tpoExamen)
	{
		$tpoExamen=$tpoExamen->find($id);
		$tpoExamen->delete();

		return redirect()->route('tpoExamens.index')->with('message', 'Registro Borrado.');
	}

}
