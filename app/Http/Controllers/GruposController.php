<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Grupo;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateGrupo;
use App\Http\Requests\createGrupo;
use DB;

class GruposController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$grupos = Grupo::getAllData($request);

		return view('grupos.index', compact('grupos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('grupos.create')
			->with( 'list', Grupo::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createGrupo $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Grupo::create( $input );

		return redirect()->route('grupos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Grupo $grupo)
	{
		$grupo=$grupo->find($id);
		return view('grupos.show', compact('grupo'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Grupo $grupo)
	{
		$grupo=$grupo->find($id);
		return view('grupos.edit', compact('grupo'))
			->with( 'list', Grupo::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Grupo $grupo)
	{
		$grupo=$grupo->find($id);
		return view('grupos.duplicate', compact('grupo'))
			->with( 'list', Grupo::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Grupo $grupo, updateGrupo $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$grupo=$grupo->find($id);
		$grupo->update( $input );

		return redirect()->route('grupos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Grupo $grupo)
	{
		$grupo=$grupo->find($id);
		$grupo->delete();

		return redirect()->route('grupos.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbGrupo(Request $request){
		if($request->ajax()){
			//dd($request->get('plantel_id'));
			$plantel=$request->get('plantel_id');
			$grupo=$request->get('grupo_id');			
			$final = array();
			$r = DB::table('grupos as g')
					->select('g.id', 'g.name')
					->where('g.plantel_id', '=', $plantel)					
					->where('g.id', '>', '0')
					->get();
			//dd($r);
			if(isset($grupo) and $grupo<>0){
				foreach($r as $r1){
					if($r1->id==$grupo){
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>'Selected'));
					}else{
						array_push($final, array('id'=>$r1->id, 
												 'name'=>$r1->name, 
												 'selectec'=>''));
					}
				}
				return $final;
			}else{
				return $r;	
			}
			
		}
	}

	public function getDisponibles(Request $request){
		$r=DB::table('grupos as g')->find($request->input('grupo_id'));
		//dd($r->registrados);
		return $r->limite_alumnos-$r->registrados;
 	}
	
}
