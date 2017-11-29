<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Giro;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateGiro;
use App\Http\Requests\createGiro;

class GirosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$giros = Giro::getAllData($request);

		return view('giros.index', compact('giros'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('giros.create')
			->with( 'list', Giro::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createGiro $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Giro::create( $input );

		return redirect()->route('giros.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Giro $giro)
	{
		$giro=$giro->find($id);
		return view('giros.show', compact('giro'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Giro $giro)
	{
		$giro=$giro->find($id);
		return view('giros.edit', compact('giro'))
			->with( 'list', Giro::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Giro $giro)
	{
		$giro=$giro->find($id);
		return view('giros.duplicate', compact('giro'))
			->with( 'list', Giro::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Giro $giro, updateGiro $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$giro=$giro->find($id);
		$giro->update( $input );

		return redirect()->route('giros.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Giro $giro)
	{
		$giro=$giro->find($id);
		$giro->delete();

		return redirect()->route('giros.index')->with('message', 'Registro Borrado.');
	}

}
