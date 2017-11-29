<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Bandera;
use Illuminate\Http\Request;

class BanderasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$banderas = Bandera::getAllData($request);

		return view('banderas.index', compact('banderas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('banderas.create')
			->with( 'list', Bandera::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{

		//create data
		Bandera::create( $request->all() );

		return redirect()->route('banderas.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Bandera $bandera)
	{
		return view('banderas.show', compact('bandera'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Bandera $bandera)
	{
		
		return view('banderas.edit', compact('bandera'))
			->with( 'list', Bandera::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate(Bandera $bandera)
	{
		return view('banderas.duplicate', compact('bandera'))
			->with( 'list', Bandera::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Bandera $bandera, Request $request)
	{
		//update data
		$bandera->update($request->all());

		return redirect()->route('banderas.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Bandera $bandera)
	{
		$bandera->delete();

		return redirect()->route('banderas.index')->with('message', 'Item deleted successfully.');
	}

}
