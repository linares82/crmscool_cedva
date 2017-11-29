<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DocAlumno;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateDocAlumno;
use App\Http\Requests\createDocAlumno;

class DocAlumnosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$docAlumnos = DocAlumno::getAllData($request);

		return view('docAlumnos.index', compact('docAlumnos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('docAlumnos.create')
			->with( 'list', DocAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createDocAlumno $request)
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
		DocAlumno::create( $input );

		return redirect()->route('docAlumnos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, DocAlumno $docAlumno)
	{
		$docAlumno=$docAlumno->find($id);
		return view('docAlumnos.show', compact('docAlumno'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, DocAlumno $docAlumno)
	{
		$docAlumno=$docAlumno->find($id);
		return view('docAlumnos.edit', compact('docAlumno'))
			->with( 'list', DocAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, DocAlumno $docAlumno)
	{
		$docAlumno=$docAlumno->find($id);
		return view('docAlumnos.duplicate', compact('docAlumno'))
			->with( 'list', DocAlumno::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, DocAlumno $docAlumno, updateDocAlumno $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['doc_obligatorio'])){
			$input['doc_obligatorio']=0;
		}else{
			$input['doc_obligatorio']=1;
		}
		//update data
		$docAlumno=$docAlumno->find($id);
		$docAlumno->update( $input );

		return redirect()->route('docAlumnos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,DocAlumno $docAlumno)
	{
		$docAlumno=$docAlumno->find($id);
		$docAlumno->delete();

		return redirect()->route('docAlumnos.index')->with('message', 'Registro Borrado.');
	}

}
