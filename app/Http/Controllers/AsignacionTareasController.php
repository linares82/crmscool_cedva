<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AsignacionTarea;
use App\Cliente;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAsignacionTarea;
use App\Http\Requests\createAsignacionTarea;

class AsignacionTareasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$asignacionTareas = AsignacionTarea::getAllData($request);

		return view('asignacionTareas.index', compact('asignacionTareas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$c=Cliente::select('id','nombre', 'nombre2', 'ape_paterno', 'ape_materno', 'mail')->get();
		return view('asignacionTareas.create', compact('c'))
			->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAsignacionTarea $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		AsignacionTarea::create( $input );

		return redirect()->route('asignacionTareas.index')->with('message', 'Registro Creado.');
	}

	public function storeModal(createAsignacionTarea $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		//dd($input);
		//create data
		$a=AsignacionTarea::create( $input );
		
		return redirect()->route('seguimientos.show', $a->cliente_id)->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		return view('asignacionTareas.show', compact('asignacionTarea'));
	}

	public function seguimiento($id, AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		return view('asignacionTareas.seguimiento', compact('asignacionTarea'))
				->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		return view('asignacionTareas.edit', compact('asignacionTarea'))
			->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		return view('asignacionTareas.duplicate', compact('asignacionTarea'))
			->with( 'list', AsignacionTarea::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, AsignacionTarea $asignacionTarea, updateAsignacionTarea $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$asignacionTarea=$asignacionTarea->find($id);
		$asignacionTarea->update( $input );

		return redirect()->route('asignacionTareas.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		$asignacionTarea->delete();

		return redirect()->route('asignacionTareas.index')->with('message', 'Registro Borrado.');
	}

	public function destroyModal($id,AsignacionTarea $asignacionTarea)
	{
		$asignacionTarea=$asignacionTarea->find($id);
		$c=$asignacionTarea->cliente_id;
		$asignacionTarea->delete();

		return redirect()->route('seguimientos.show', $c)->with('message', 'Registro Borrado.');
	}

}
