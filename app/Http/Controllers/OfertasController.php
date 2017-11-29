<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ofertum;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateOferta;
use App\Http\Requests\createOferta;

class OfertasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//dd($request);
		$ofertas = Ofertum::getAllData($request);

		return view('ofertas.index', compact('ofertas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ofertas.create')
			->with( 'list', Ofertum::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createOferta $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Ofertum::create( $input );

		return redirect()->route('ofertas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Ofertum $ofertum)
	{
		$ofertum=$ofertum->find($id);
		return view('ofertas.show', compact('ofertum'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Ofertum $ofertum)
	{
		$ofertum=$ofertum->find($id);
		return view('ofertas.edit', compact('ofertum'))
			->with( 'list', Ofertum::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Ofertum $ofertum)
	{
		$ofertum=$ofertum->find($id);
		return view('ofertas.duplicate', compact('ofertum'))
			->with( 'list', Ofertum::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Ofertum $oferta, updateOferta $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$oferta=$oferta->find($id);
		$oferta->update( $input );

		return redirect()->route('ofertas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Ofertum $ofertum)
	{
		$ofertum=$ofertum->find($id);
		$ofertum->delete();

		return redirect()->route('ofertas.index')->with('message', 'Registro Borrado.');
	}

}
