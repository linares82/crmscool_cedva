<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Apple;
use Illuminate\Http\Request;

class ApplesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$apples = Apple::getAllData($request);

		return view('apples.index', compact('apples'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('apples.create')
			->with( 'list', Apple::getListFromAllRelationApps() );
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
		Apple::create( $request->all() );

		return redirect()->route('apples.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Apple $apple)
	{
		return view('apples.show', compact('apple'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Apple $apple)
	{
		return view('apples.edit', compact('apple'))
			->with( 'list', Apple::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate(Apple $apple)
	{
		return view('apples.duplicate', compact('apple'))
			->with( 'list', Apple::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Apple $apple, Request $request)
	{
		//update data
		$apple->update($request->all());

		return redirect()->route('apples.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy(Apple $apple)
	{
		$apple->delete();

		return redirect()->route('apples.index')->with('message', 'Item deleted successfully.');
	}

}
