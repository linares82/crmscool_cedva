<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Otro;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateOtro;
use App\Http\Requests\createOtro;

class OtrosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$otros = Otro::getAllData($request);

		return view('otros.index', compact('otros'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('otros.create')
			->with( 'list', Otro::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createOtro $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Otro::create( $input );

		return redirect()->route('otros.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Otro $otro)
	{
		$otro=$otro->find($id);
		return view('otros.show', compact('otro'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Otro $otro)
	{
		$otro=$otro->find($id);
		return view('otros.edit', compact('otro'))
			->with( 'list', Otro::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Otro $otro)
	{
		$otro=$otro->find($id);
		return view('otros.duplicate', compact('otro'))
			->with( 'list', Otro::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Otro $otro, updateOtro $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$otro=$otro->find($id);
		$otro->update( $input );

		return redirect()->route('otros.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Otro $otro)
	{
		$otro=$otro->find($id);
		$otro->delete();

		return redirect()->route('otros.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbSubotros($id=0){
		//dd($_REQUEST['otro']);
		$e = $_REQUEST['otro'];
        $subotros = Otro::find($e)->subotros;
        //dd($municipios);
        return $subotros->pluck('name', 'id');

	}
}
