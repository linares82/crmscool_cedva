<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use App\Alumno;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAlumno;
use App\Http\Requests\createAlumno;

class AlumnosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$alumnos = Alumno::getAllData($request);

		return view('alumnos.index', compact('alumnos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('alumnos.create')
			->with( 'list', Alumno::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAlumno $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['extranjero'])){
			$input['extranjero']=0;
		}else{
			$input['extranjero']=1;
		}
		//create data
		Alumno::create( $input );

		return redirect()->route('alumnos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Alumno $alumno)
	{
		$alumno=$alumno->find($id);
		return view('alumnos.show', compact('alumno'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Alumno $alumno)
	{
		$alumno=$alumno->find($id);
		return view('alumnos.edit', compact('alumno'))
			->with( 'list', Alumno::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Alumno $alumno)
	{
		$alumno=$alumno->find($id);
		return view('alumnos.duplicate', compact('alumno'))
			->with( 'list', Alumno::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Alumno $alumno, updateAlumno $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		if(!isset($input['extranjero'])){
			$input['extranjero']=0;
		}else{
			$input['extranjero']=1;
		}
		//update data
		$alumno=$alumno->find($id);
		$alumno->update( $input );

		return redirect()->route('alumnos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Alumno $alumno)
	{
		$alumno=$alumno->find($id);
		$alumno->delete();

		return redirect()->route('alumnos.index')->with('message', 'Registro Borrado.');
	}

	public function inscribir(Request $request){
		$input=$request->all();
		//dd($c);
		$c=Cliente::find($input['c']);
		//dd($cliente);
		$a['nombre']=$c->nombre;
		$a['nombre2']=$c->nombre2;
		$a['ape_paterno']=$c->ape_paterno;
		$a['ape_materno']=$c->ape_materno;
		$a['tel_fijo']=$c->tel_fijo;
		$a['tel_cel']=$c->tel_cel;
		$a['mail']=$c->mail;
		$a['calle']=$c->calle;
		$a['no_interior']=$c->no_interior;
		$a['no_exterior']=$c->no_exterior;
		$a['colonia']=$c->colonia;
		$a['cp']=$c->cp;
		$a['municipio_id']=$c->municipio_id;
		$a['estado_id']=$c->estado_id;
		$a['st_alumno_id']=1;
		$a['plantel_id']=$c->plantel_id;
		$a['especialidad_id']=$c->especialidad_id;
		$a['nivel_id']=$c->nivel_id;
		$a['grado_id']=$c->grado_id;
		$a['grupo_id']=0;
		$a['genero']=0;
		$a['extranjero']=0;
		$a['fec_inscripcion']=date('Y-m-d');
		$a['lectivo_id']=1;
		$a['usu_alta_id']=Auth::user()->id;
		$a['usu_mod_id']=Auth::user()->id;
		$r=Alumno::create( $a );		
		return redirect()->route('alumnos.edit', $r->id)->with('message', 'Registro Creado.');
	}

	
	}
}
