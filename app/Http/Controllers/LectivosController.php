<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lectivo;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateLectivo;
use App\Http\Requests\createLectivo;

class LectivosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$lectivos = Lectivo::getAllData($request);

		return view('lectivos.index', compact('lectivos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('lectivos.create')
			->with( 'list', Lectivo::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createLectivo $request)
	{
		//dd($request->all());
		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['activo'])){
			$input['activo']=0;
		}else{
			$input['activo']=1;
		}
                if(!isset($input['bachillerato_bnd'])){
			$input['bachillerato_bnd']=0;
		}else{
			$input['bachillerato_bnd']=1;
		}
                if(!isset($input['carrera_bnd'])){
			$input['carrera_bnd']=0;
		}else{
			$input['carrera_bnd']=1;
		}
		//create data
		if (Lectivo::create( $input )){
			return redirect()->route('lectivos.index')->with('message', 'Registro creado.');	
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Lectivo $lectivo)
	{
		$lectivo=$lectivo->find($id);
		return view('lectivos.show', compact('lectivo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Lectivo $lectivo)
	{
		$lectivo = $lectivo->find($id);
		//dd($lectivo);
		return view('lectivos.edit', compact('lectivo'))
			->with( 'list', Lectivo::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate(Lectivo $lectivo)
	{
		return view('lectivos.duplicate', compact('lectivo'))
			->with( 'list', Lectivo::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Lectivo $lectivo, updateLectivo $request)
	{
		
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//dd($input);
		if(!isset($input['activo'])){
			$input['activo']=0;
		}else{
			$input['activo']=1;
		}
                if(!isset($input['bachillerato_bnd'])){
			$input['bachillerato_bnd']=0;
		}else{
			$input['bachillerato_bnd']=1;
		}
                if(!isset($input['carrera_bnd'])){
			$input['carrera_bnd']=0;
		}else{
			$input['carrera_bnd']=1;
		}

		$lectivo=$lectivo->find($id);
		//update data
		
		if ($lectivo->update($input)){
			return redirect()->route('lectivos.index')->with('message', 'Registro creado.');	
		} 

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Lectivo $lectivo)
	{
		$lectivo=$lectivo->find($id);
		$lectivo->delete();

		return redirect()->route('lectivos.index')->with('message', 'Registro borrado.');
	}

}
