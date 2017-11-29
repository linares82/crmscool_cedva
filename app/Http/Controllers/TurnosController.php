<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Turno;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateTurno;
use App\Http\Requests\createTurno;

class TurnosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$turnos = Turno::getAllData($request);

		return view('turnos.index', compact('turnos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('turnos.create')
			->with( 'list', Turno::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createTurno $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;

		//create data
		Turno::create( $input );

		return redirect()->route('turnos.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Turno $turno)
	{
		$turno=$turno->find($id);
		return view('turnos.show', compact('turno'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Turno $turno)
	{
		$turno=$turno->find($id);
		return view('turnos.edit', compact('turno'))
			->with( 'list', Turno::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Turno $turno)
	{
		$turno=$turno->find($id);
		return view('turnos.duplicate', compact('turno'))
			->with( 'list', Turno::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Turno $turno, updateTurno $request)
	{
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;
		//update data
		$turno=$turno->find($id);
		$turno->update( $input );

		return redirect()->route('turnos.index')->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Turno $turno)
	{
		$turno=$turno->find($id);
		$turno->delete();

		return redirect()->route('turnos.index')->with('message', 'Registro Borrado.');
	}
        
        public function getCmbTurno(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $plantel = $request->get('plantel_id');
            $especialidad = $request->get('especialidad_id');
            $nivel = $request->get('nivel_id');
            $grado = $request->get('grado_id');
            $turno = $request->get('turno_id');
            $final = array();
            $r = DB::table('turnos as t')
                    ->select('t.id', 't.name')
                    ->where('t.plantel_id', '=', $plantel)
                    ->where('t.especialidad_id', '=', $especialidad)
                    ->where('t.grado_id', '=', $grado)
                    ->where('t.nivel_id', '=', $nivel)
                    ->where('t.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($turno) and $turno <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $turno) {
                        array_push($final, array('id' => $r1->id,
                            'name' => $r1->name,
                            'selectec' => 'Selected'));
                    } else {
                        array_push($final, array('id' => $r1->id,
                            'name' => $r1->name,
                            'selectec' => ''));
                    }
                }
                return $final;
            } else {
                return $r;
            }
        }
    }

}
