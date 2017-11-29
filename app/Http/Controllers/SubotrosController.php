<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Subotro;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSubotro;
use App\Http\Requests\createSubotro;

class SubotrosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$subotros = Subotro::getAllData($request);

		return view('subotros.index', compact('subotros'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('subotros.create')
			->with( 'list', Subotro::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSubotro $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Subotro::create( $input );

		return redirect()->route('subotros.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Subotro $subotro)
	{
		$subotro=$subotro->find($id);
		return view('subotros.show', compact('subotro'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Subotro $subotro)
	{
		$subotro=$subotro->find($id);
		return view('subotros.edit', compact('subotro'))
			->with( 'list', Subotro::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Subotro $subotro)
	{
		$subotro=$subotro->find($id);
		return view('subotros.duplicate', compact('subotro'))
			->with( 'list', Subotro::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Subotro $subotro, updateSubotro $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$subotro=$subotro->find($id);
		$subotro->update( $input );

		return redirect()->route('subotros.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Subotro $subotro)
	{
		$subotro=$subotro->find($id);
		$subotro->delete();

		return redirect()->route('subotros.index')->with('message', 'Registro Borrado.');
	}

}
