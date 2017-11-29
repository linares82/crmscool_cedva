<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CargaPonderacion;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCargaPonderacion;
use App\Http\Requests\createCargaPonderacion;
use DB;

class CargaPonderacionsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $cargaPonderacions = CargaPonderacion::getAllData($request);

        return view('cargaPonderacions.index', compact('cargaPonderacions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('cargaPonderacions.create')
                        ->with('list', CargaPonderacion::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createCargaPonderacion $request) {

        $input = $request->all();
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;

        //create data
        CargaPonderacion::create($input);

        return redirect()->route('cargaPonderacions.index')->with('message', 'Registro Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, CargaPonderacion $cargaPonderacion) {
        $cargaPonderacion = $cargaPonderacion->find($id);
        return view('cargaPonderacions.show', compact('cargaPonderacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, CargaPonderacion $cargaPonderacion) {
        $cargaPonderacion = $cargaPonderacion->find($id);
        return view('cargaPonderacions.edit', compact('cargaPonderacion'))
                        ->with('list', CargaPonderacion::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, CargaPonderacion $cargaPonderacion) {
        $cargaPonderacion = $cargaPonderacion->find($id);
        return view('cargaPonderacions.duplicate', compact('cargaPonderacion'))
                        ->with('list', CargaPonderacion::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, CargaPonderacion $cargaPonderacion, updateCargaPonderacion $request) {
        $input = $request->all();
        $input['usu_mod_id'] = Auth::user()->id;
        //update data
        $cargaPonderacion = $cargaPonderacion->find($id);
        $cargaPonderacion->update($input);

        return redirect()->route('cargaPonderacions.index')->with('message', 'Registro Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, CargaPonderacion $cargaPonderacion) {
        $cargaPonderacion = $cargaPonderacion->find($id);
        $cargaPonderacion->delete();

        return redirect()->route('cargaPonderacions.index')->with('message', 'Registro Borrado.');
    }

    public function getCmbCarga(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $ponderacion = $request->get('ponderacion_id');
            $carga_ponderacion = $request->get('carga_ponderacion_id');

            $final = array();
            $r = DB::table('carga_ponderacions as cp')
                    ->select('cp.id', 'cp.name')
                    ->where('cp.ponderacion_id', '=', $ponderacion)
                    ->where('cp.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($carga_ponderacion) and $carga_ponderacion <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $carga_ponderacion) {
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
