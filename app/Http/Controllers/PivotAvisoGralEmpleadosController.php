<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PivotAvisoGralEmpleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePivotAvisoGralEmpleado;
use App\Http\Requests\createPivotAvisoGralEmpleado;

class PivotAvisoGralEmpleadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$pivotAvisoGralEmpleados = PivotAvisoGralEmpleado::getAllData($request);

		return view('pivotAvisoGralEmpleados.index', compact('pivotAvisoGralEmpleados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('pivotAvisoGralEmpleados.create')
			->with( 'list', PivotAvisoGralEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPivotAvisoGralEmpleado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		PivotAvisoGralEmpleado::create( $input );

		return redirect()->route('pivotAvisoGralEmpleados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, PivotAvisoGralEmpleado $pivotAvisoGralEmpleado)
	{
		$pivotAvisoGralEmpleado=$pivotAvisoGralEmpleado->find($id);
		return view('pivotAvisoGralEmpleados.show', compact('pivotAvisoGralEmpleado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, PivotAvisoGralEmpleado $pivotAvisoGralEmpleado)
	{
		$pivotAvisoGralEmpleado=$pivotAvisoGralEmpleado->find($id);
		return view('pivotAvisoGralEmpleados.edit', compact('pivotAvisoGralEmpleado'))
			->with( 'list', PivotAvisoGralEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, PivotAvisoGralEmpleado $pivotAvisoGralEmpleado)
	{
		$pivotAvisoGralEmpleado=$pivotAvisoGralEmpleado->find($id);
		return view('pivotAvisoGralEmpleados.duplicate', compact('pivotAvisoGralEmpleado'))
			->with( 'list', PivotAvisoGralEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, PivotAvisoGralEmpleado $pivotAvisoGralEmpleado, updatePivotAvisoGralEmpleado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$pivotAvisoGralEmpleado=$pivotAvisoGralEmpleado->find($id);
		$pivotAvisoGralEmpleado->update( $input );

		return redirect()->route('pivotAvisoGralEmpleados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,PivotAvisoGralEmpleado $pivotAvisoGralEmpleado)
	{
		$pivotAvisoGralEmpleado=$pivotAvisoGralEmpleado->find($id);
		$avisoGral=$pivotAvisoGralEmpleado->aviso_gral_id;
		$pivotAvisoGralEmpleado->delete();

		return redirect()->route('avisoGrals.edit', $avisoGral)->with('message', 'Registro Borrado.');
	}

	public function enviar($id){
		$pivot=PivotAvisoGralEmpleado::where('aviso_gral_id', '=', $id)->get();
		foreach($pivot as $p){
			$p->enviado=1;
			$p->save();
		}
		return redirect()->route('avisoGrals.edit', $id)->with('message', 'Registro Borrado.');
	}
	public function leido($id){
		$pivot=PivotAvisoGralEmpleado::find($id);
		$pivot->leido=1;
		$pivot->save();
		return redirect()->route('home', $id)->with('message', 'Registro Borrado.');
	}

}
