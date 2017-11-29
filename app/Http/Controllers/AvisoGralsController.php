<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AvisoGral;
use App\PivotAvisoGralEmpleado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateAvisoGral;
use App\Http\Requests\createAvisoGral;

class AvisoGralsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$avisoGrals = AvisoGral::getAllData($request);
		//dd($avisoGrals);
		return view('avisoGrals.index', compact('avisoGrals'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('avisoGrals.create')
			->with( 'list', AvisoGral::getListFromAllRelationApps() )
			->with( 'list1', PivotAvisoGralEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createAvisoGral $request)
	{
		//dd($request->all());
		$input = $request->except('empleado_id-field');
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
	    $ag=AvisoGral::create( $input );
		$empleados=$request->get('empleado_id-field');
		if(isset($empleados)){	
			foreach($empleados as $e){
				//dd($e);
				$input2['aviso_gral_id']=$ag->id;
				$input2['empleado_id']=$e;
				$input2['leido']=0;
				$input2['enviado']=0;
				$input2['usu_mod_id']=Auth::user()->id;
				$input2['usu_alta_id']=Auth::user()->id;
				PivotAvisoGralEmpleado::create($input2);
			}
		}

		return redirect()->route('avisoGrals.edit', $ag->id)->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, AvisoGral $avisoGral)
	{
		$avisoGral=$avisoGral->find($id);
		return view('avisoGrals.show', compact('avisoGral'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, AvisoGral $avisoGral)
	{
		$avisoGral=$avisoGral->find($id);
		return view('avisoGrals.edit', compact('avisoGral'))
			->with( 'list', AvisoGral::getListFromAllRelationApps() )
			->with( 'list1', PivotAvisoGralEmpleado::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, AvisoGral $avisoGral)
	{
		$avisoGral=$avisoGral->find($id);
		return view('avisoGrals.duplicate', compact('avisoGral'))
			->with( 'list', AvisoGral::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, AvisoGral $avisoGral, updateAvisoGral $request)
	{
		$input = $request->except('empleado_id-field');
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$avisoGral=$avisoGral->find($id);
		$avisoGral->update( $input );

		$empleados=$request->get('empleado_id-field');
		if(isset($empleados)){	
			foreach($empleados as $e){
				//dd($e);
				$input2['aviso_gral_id']=$id;
				$input2['empleado_id']=$e;
				$input2['leido']=0;
				$input2['enviado']=0;
				$input2['usu_mod_id']=Auth::user()->id;
				$input2['usu_alta_id']=Auth::user()->id;
				PivotAvisoGralEmpleado::create($input2);
			}
		}

		return redirect()->route('avisoGrals.edit', $id)->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,AvisoGral $avisoGral)
	{
		$avisoGral=$avisoGral->find($id);
		$avisoGral->delete();

		return redirect()->route('avisoGrals.index')->with('message', 'Registro Borrado.');
	}

	public function showModal(){
		$id=$_GET['id'];
    	return view('avisoGrals.showModal', compact('id'));
    }

    public function showDetalleModal(){
		$id=$_GET['id'];
		$avisoGral=AvisoGral::find($id);
        return view('avisoGrals.showDetalleModal', compact('avisoGral'));
    }
}
