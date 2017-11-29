<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Salon;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateSalon;
use App\Http\Requests\createSalon;
use DB;
class SalonsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$salons = Salon::getAllData($request);

		return view('salons.index', compact('salons'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('salons.create')
			->with( 'list', Salon::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createSalon $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Salon::create( $input );

		return redirect()->route('salons.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Salon $salon)
	{
		$salon=$salon->find($id);
		return view('salons.show', compact('salon'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Salon $salon)
	{
		$salon=$salon->find($id);
		return view('salons.edit', compact('salon'))
			->with( 'list', Salon::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Salon $salon)
	{
		$salon=$salon->find($id);
		return view('salons.duplicate', compact('salon'))
			->with( 'list', Salon::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Salon $salon, updateSalon $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$salon=$salon->find($id);
		$salon->update( $input );

		return redirect()->route('salons.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Salon $salon)
	{
		$salon=$salon->find($id);
		$salon->delete();

		return redirect()->route('salons.index')->with('message', 'Registro Borrado.');
	}

	public function getCmbSalon(Request $request){
		if($request->ajax()){
			//dd($request->get('plantel_id'));
			$plantel=$request->get('plantel_id');
			$salon=$request->get('salon_id');
			
			$final = array();
			$r = DB::table('salons as s')
					->select('s.id', 's.name')
					->where('s.plantel_id', '=', $plantel)
					->where('s.id', '>', '0')
					->get();
			//dd($r);
			if(isset($salon) and $salon<>0){
				foreach($r as $r1){
					if($r1->id==$salon){
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
