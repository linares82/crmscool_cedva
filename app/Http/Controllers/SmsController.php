<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Sm;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSm;
use App\Http\Requests\createSm;

class SmsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$sms = Sm::getAllData($request);

		return view('sms.index', compact('sms'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('sms.create')
			->with( 'list', Sm::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSm $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Sm::create( $input );

		return redirect()->route('sms.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Sm $sm)
	{
		$sm=$sm->find($id);
		return view('sms.show', compact('sm'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Sm $sm)
	{
		$sm=$sm->find($id);
		return view('sms.edit', compact('sm'))
			->with( 'list', Sm::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Sm $sm)
	{
		$sm=$sm->find($id);
		return view('sms.duplicate', compact('sm'))
			->with( 'list', Sm::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Sm $sm, updateSm $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$sm=$sm->find($id);
		$sm->update( $input );

		return redirect()->route('sms.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Sm $sm)
	{
		$sm=$sm->find($id);
		$sm->delete();

		return redirect()->route('sms.index')->with('message', 'Registro Borrado.');
	}

}
