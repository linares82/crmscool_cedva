<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CalendarioEvaluacion;
use App\Empleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCalendarioEvaluacion;
use App\Http\Requests\createCalendarioEvaluacion;

class CalendarioEvaluacionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$calendarioEvaluacions = CalendarioEvaluacion::getAllData($request);

		return view('calendarioEvaluacions.index', compact('calendarioEvaluacions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('calendarioEvaluacions.create')
			->with( 'list', CalendarioEvaluacion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCalendarioEvaluacion $request)
	{
		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
                $input['plantel_id']=Empleado::where('user_id', '=', Auth::user()->id)
                                                ->value('plantel_id');
		//create data
		CalendarioEvaluacion::create( $input );

		return redirect()->route('calendarioEvaluacions.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, CalendarioEvaluacion $calendarioEvaluacion)
	{
		$calendarioEvaluacion=$calendarioEvaluacion->find($id);
		return view('calendarioEvaluacions.show', compact('calendarioEvaluacion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, CalendarioEvaluacion $calendarioEvaluacion)
	{
		$calendarioEvaluacion=$calendarioEvaluacion->find($id);
		return view('calendarioEvaluacions.edit', compact('calendarioEvaluacion'))
			->with( 'list', CalendarioEvaluacion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, CalendarioEvaluacion $calendarioEvaluacion)
	{
		$calendarioEvaluacion=$calendarioEvaluacion->find($id);
		return view('calendarioEvaluacions.duplicate', compact('calendarioEvaluacion'))
			->with( 'list', CalendarioEvaluacion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, CalendarioEvaluacion $calendarioEvaluacion, updateCalendarioEvaluacion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
                $input['plantel_id']=Empleado::where('user_id', '=', Auth::user()->id)
                                                ->value('plantel_id');
		//update data
		$calendarioEvaluacion=$calendarioEvaluacion->find($id);
		$calendarioEvaluacion->update( $input );

		return redirect()->route('calendarioEvaluacions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,CalendarioEvaluacion $calendarioEvaluacion)
	{
		$calendarioEvaluacion=$calendarioEvaluacion->find($id);
		$calendarioEvaluacion->delete();

		return redirect()->route('calendarioEvaluacions.index')->with('message', 'Registro Borrado.');
	}

}
