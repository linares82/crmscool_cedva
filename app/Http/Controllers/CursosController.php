<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Curso;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCurso;
use App\Http\Requests\createCurso;

class CursosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$cursos = Curso::getAllData($request);

		return view('cursos.index', compact('cursos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cursos.create')
			->with( 'list', Curso::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createCurso $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Curso::create( $input );

		return redirect()->route('cursos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Curso $curso)
	{
		$curso=$curso->find($id);
		return view('cursos.show', compact('curso'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Curso $curso)
	{
		$curso=$curso->find($id);
		return view('cursos.edit', compact('curso'))
			->with( 'list', Curso::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Curso $curso)
	{
		$curso=$curso->find($id);
		return view('cursos.duplicate', compact('curso'))
			->with( 'list', Curso::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Curso $curso, updateCurso $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$curso=$curso->find($id);
		$curso->update( $input );

		return redirect()->route('cursos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Curso $curso)
	{
		$curso=$curso->find($id);
		$curso->delete();

		return redirect()->route('cursos.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbSubcursos($id=0){
		//dd($_REQUEST['curso']);
		$e = $_REQUEST['curso'];
        $subcursos = Curso::find($e)->subcursos;
        //dd($municipios);
        return $subcursos->pluck('name', 'id');

	}

}
