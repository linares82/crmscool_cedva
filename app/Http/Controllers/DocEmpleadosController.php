<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DocEmpleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateDocEmpleado;
use App\Http\Requests\createDocEmpleado;

class DocEmpleadosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$docEmpleados = DocEmpleado::getAllData($request);

		return view('docEmpleados.index', compact('docEmpleados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('docEmpleados.create')
			->with( 'list', DocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createDocEmpleado $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['doc_obligatorio'])){
			$input['doc_obligatorio']=0;
		}else{
			$input['doc_obligatorio']=1;
		}
		//create data
		DocEmpleado::create( $input );

		return redirect()->route('docEmpleados.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, DocEmpleado $docEmpleado)
	{
		$docEmpleado=$docEmpleado->find($id);
		return view('docEmpleados.show', compact('docEmpleado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, DocEmpleado $docEmpleado)
	{
		$docEmpleado=$docEmpleado->find($id);
		return view('docEmpleados.edit', compact('docEmpleado'))
			->with( 'list', DocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, DocEmpleado $docEmpleado)
	{
		$docEmpleado=$docEmpleado->find($id);
		return view('docEmpleados.duplicate', compact('docEmpleado'))
			->with( 'list', DocEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, DocEmpleado $docEmpleado, updateDocEmpleado $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['doc_obligatorio'])){
			$input['doc_obligatorio']=0;
		}else{
			$input['doc_obligatorio']=1;
		}
		//update data
		$docEmpleado=$docEmpleado->find($id);
		$docEmpleado->update( $input );

		return redirect()->route('docEmpleados.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,DocEmpleado $docEmpleado)
	{
		$docEmpleado=$docEmpleado->find($id);
		$docEmpleado->delete();

		return redirect()->route('docEmpleados.index')->with('message', 'Registro Borrado.');
	}

}
