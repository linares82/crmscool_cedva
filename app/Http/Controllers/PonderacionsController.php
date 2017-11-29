<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ponderacion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePonderacion;
use App\Http\Requests\createPonderacion;

class PonderacionsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$ponderacions = Ponderacion::getAllData($request);

		return view('ponderacions.index', compact('ponderacions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('ponderacions.create')
			->with( 'list', Ponderacion::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPonderacion $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Ponderacion::create( $input );

		return redirect()->route('ponderacions.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Ponderacion $ponderacion)
	{
		$ponderacion=$ponderacion->find($id);
		return view('ponderacions.show', compact('ponderacion'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Ponderacion $ponderacion)
	{
		$ponderacion=$ponderacion->find($id);
		return view('ponderacions.edit', compact('ponderacion'))
			->with( 'list', Ponderacion::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Ponderacion $ponderacion)
	{
		$ponderacion=$ponderacion->find($id);
		return view('ponderacions.duplicate', compact('ponderacion'))
			->with( 'list', Ponderacion::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Ponderacion $ponderacion, updatePonderacion $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$ponderacion=$ponderacion->find($id);
		$ponderacion->update( $input );

		return redirect()->route('ponderacions.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Ponderacion $ponderacion)
	{
		$ponderacion=$ponderacion->find($id);
		$ponderacion->delete();

		return redirect()->route('ponderacions.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbPonderacion(Request $request){
		if($request->ajax()){
			//dd($request->get('plantel_id'));
			$plantel=$request->get('plantel_id');
			$especialidad=$request->get('especialidad_id');
			$nivel=$request->get('nivel_id');
			$final = array();
			$r = DB::table('nivels as n')
					->select('n.id', 'n.name')
					->where('n.plantel_id', '=', $plantel)
					->where('n.especialidad_id', '=', $especialidad)
					->where('n.id', '>', '0')
					->get();
			//dd($r);
			if(isset($nivel) and $nivel<>0){
				foreach($r as $r1){
					if($r1->id==$nivel){
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
}
