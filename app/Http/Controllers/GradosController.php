<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Grado;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateGrado;
use App\Http\Requests\createGrado;
use DB;

class GradosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $grados = Grado::getAllData($request);

        return view('grados.index', compact('grados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('grados.create')
                        ->with('list', Grado::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createGrado $request) {

        $input = $request->all();
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;

        //create data
        Grado::create($input);

        return redirect()->route('grados.index')->with('message', 'Registro Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Grado $grado) {
        $grado = $grado->find($id);
        return view('grados.show', compact('grado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Grado $grado) {
        $grado = $grado->find($id);
        return view('grados.edit', compact('grado'))
                        ->with('list', Grado::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, Grado $grado) {
        $grado = $grado->find($id);
        return view('grados.duplicate', compact('grado'))
                        ->with('list', Grado::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Grado $grado, updateGrado $request) {
        $input = $request->all();
        $input['usu_mod_id'] = Auth::user()->id;
        //update data
        $grado = $grado->find($id);
        $grado->update($input);

        return redirect()->route('grados.index')->with('message', 'Registro Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Grado $grado) {
        $grado = $grado->find($id);
        $grado->delete();

        return redirect()->route('grados.index')->with('message', 'Registro Borrado.');
    }

    public function getCmbGrados(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $plantel = $request->get('plantel_id');
            $especialidad = $request->get('especialidad_id');
            $nivel = $request->get('nivel_id');
            $grado = $request->get('grado_id');
            $final = array();
            $r = DB::table('grados as g')
                    ->select('g.id', 'g.name')
                    ->where('g.plantel_id', '=', $plantel)
                    ->where('g.especialidad_id', '=', $especialidad)
                    ->where('g.nivel_id', '=', $nivel)
                    ->where('g.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($grado) and $grado <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $grado) {
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

    public function getCmbGradosXalumno(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $cve_alumno = $request->get('cve_alumno');
            $grado = $request->get('grado_id');

            $final = array();
            $r = DB::table('grados as g')
                    ->join('inscripcions as i', 'i.grado_id', '=', 'g.id')
                    ->join('clientes as c', 'i.cliente_id', '=', 'c.id')
                    ->select('g.id', 'g.name')
                    ->where('c.cve_alumno', '=', $cve_alumno)
                    ->where('g.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($grado) and $grado <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $grado) {
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
