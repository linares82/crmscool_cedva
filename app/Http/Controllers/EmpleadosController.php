<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use App\Empleado;
use App\PivotDocEmpleado;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateEmpleado;
use App\Http\Requests\createEmpleado;
use DB;
use Hash;

class EmpleadosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $empleados = Empleado::getAllData($request);

        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //$plantel=DB::table('empleados')->where('user_id', Auth::user()->id)->value('plantel_id');
        $jefes = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                ->where('jefe_bnd', '=', '1')
                //->where('plantel_id', '=', $plantel)
                ->pluck('name', 'id');
        $responsables = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                //->where('plantel_id', '=', $plantel)
                ->pluck('name', 'id');
        return view('empleados.create', compact('jefes', 'responsables'))
                        ->with('list', Empleado::getListFromAllRelationApps())
                        ->with('list1', PivotDocEmpleado::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createEmpleado $request) {

        $input = $request->all();
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;
        if (!isset($input['jefe_bnd'])) {
            $input['jefe_bnd'] = 0;
        } else {
            $input['jefe_bnd'] = 1;
        }
        if (!isset($input['alerta_bnd'])) {
            $input['alerta_bnd'] = 0;
        } else {
            $input['alerta_bnd'] = 1;
        }
        if (!isset($input['alimenticia_bnd'])) {
            $input['alimenticia_bnd'] = 0;
        } else {
            $input['alimenticia_bnd'] = 1;
        }
        if (!isset($input['extranjero_bnd'])) {
            $input['extranjero_bnd'] = 0;
        } else {
            $input['extranjero_bnd'] = 1;
        }

        //dd($input);
        $e = Empleado::create($input);

        if ($request->has('doc_empleado_id') and $request->has('archivo')) {
            $input2['doc_empleado_id'] = $request->get('doc_empleado_id');
            $input2['archivo'] = $request->get('archivo');
            $input2['empleado_id'] = $id;
            $input2['usu_alta_id'] = Auth::user()->id;
            $input2['usu_mod_id'] = Auth::user()->id;
            PivotDocEmpleado::create($input2);
        }

        return redirect()->route('empleados.edit', $e->id)->with('message', 'Registro Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Empleado $empleado) {
        $empleado = $empleado->find($id);
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Empleado $empleado, PivotDocEmpleado $pivotDocEmpleado) {
        $empleado = $empleado->find($id);
        if ($empleado->cve_empleado == "") {
            $empleado->cve_empleado = substr(Hash::make(rand(0, 1000)), 2, 8);
        }
        $jefes = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                ->where('jefe_bnd', '=', '1')
                ->where('plantel_id', '=', $empleado->plantel_id)
                ->pluck('name', 'id');
        $responsables = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                ->where('plantel_id', '=', $empleado->plantel_id)
                ->pluck('name', 'id');
        $doc_existentes = DB::table('pivot_doc_empleados as pde')->select('doc_empleado_id')
                        ->join('empleados as e', 'e.id', '=', 'pde.empleado_id')
                        ->where('e.id', '=', $id)
                        ->where('pde.deleted_at', '=', NULL)->get();

        $de_array = array();
        if ($doc_existentes->isNotEmpty()) {
            foreach ($doc_existentes as $de) {
                array_push($de_array, $de->doc_empleado_id);
            }
            //dd($de_array);
        }

        $documentos_faltantes = DB::table('doc_empleados')
                ->select()
                ->whereNotIn('id', $de_array)
                ->get();
        //dd($documentos_faltantes);
        return view('empleados.edit', compact('empleado', 'pivotDocEmpleado', 'jefes', 'responsables', 'documentos_faltantes'))
                        ->with('list', Empleado::getListFromAllRelationApps())
                        ->with('list1', PivotDocEmpleado::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, Empleado $empleado) {
        $empleado = $empleado->find($id);
        $jefes = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                ->where('jefe_bnd', '=', '1')
                //->where('plantel_id', '=', $plantel)
                ->pluck('name', 'id');
        $responsables = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                ->where('plantel_id', '=', $empleado->plantel_id)
                ->pluck('name', 'id');
        $doc_existentes = DB::table('pivot_doc_empleados as pde')->select('doc_empleado_id')
                        ->join('empleados as e', 'e.id', '=', 'pde.empleado_id')
                        ->where('e.id', '=', $id)
                        ->where('pde.deleted_at', '=', NULL)->get();

        $de_array = array();
        if ($doc_existentes->isNotEmpty()) {
            foreach ($doc_existentes as $de) {
                array_push($de_array, $de->doc_empleado_id);
            }
            //dd($de_array);
        }

        $documentos_faltantes = DB::table('doc_empleados')
                ->select()
                ->whereNotIn('id', $de_array)
                ->get();
        return view('empleados.duplicate', compact('empleado', 'jefes', 'responsables', 'documentos_faltantes'))
                        ->with('list', Empleado::getListFromAllRelationApps())
                        ->with('list1', PivotDocEmpleado::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    //Primera version
    /* public function update($id, Empleado $empleado, updateEmpleado $request)
      {
      $input = $request->all();
      $input['usu_mod_id']=Auth::user()->id;
      //update data
      //dd($request->all());
      $r=$request->hasFile('foto_file');
      //dd($r);
      if($r){
      $foto_file = $request->file('foto_file');
      $input['foto'] = $foto_file->getClientOriginalName();

      }
      $r=$request->hasFile('identificacion_file');
      if($r){
      $identificacion_file = $request->file('identificacion_file');
      $input['identificacion'] = $identificacion_file->getClientOriginalName();
      }
      $r=$request->hasFile('contrato_file');
      if($r){
      $contrato_file = $request->file('contrato_file');
      $input['contrato'] = $contrato_file->getClientOriginalName();
      }
      $r=$request->hasFile('evaluacion_psico_file');
      if($r){
      $evaluacion_psico_file = $request->file('evaluacion_psico_file');
      $input['evaluacion_psico'] = $evaluacion_psico_file->getClientOriginalName();
      }

      //dd($input);
      //dd($request->all());
      $empleado=$empleado->find($id);

      $e=$empleado->update( $input );
      //dd($e);

      if ( $e ){
      $ruta=public_path()."/imagenes/empleados/".$id."/";
      if(!file_exists($ruta)){
      File::makeDirectory($ruta, 0777, true, true);
      }
      if($request->file('foto_file')){
      //Storage::disk('img_plantels')->put($input['logo'],  File::get($logo_file));
      $request->file('foto_file')->move($ruta, $input['foto']);
      }
      if($request->file('identificacion_file')){
      //\Storage::disk('local')->put($input['slogan'],  \File::get($slogan_file));
      $request->file('identificacion_file')->move($ruta, $input['identificacion']);
      }
      if($request->file('contrato_file')){
      //\Storage::disk('local')->put($input['membrete'],  \File::get($membrete_file));
      $request->file('contrato_file')->move($ruta, $input['contrato']);
      }
      if($request->file('evaluacion_psico_file')){
      //\Storage::disk('local')->put($input['membrete'],  \File::get($membrete_file));
      $request->file('evaluacion_psico_file')->move($ruta, $input['evaluacion_psico']);
      }
      }

      return redirect()->route('empleados.index')->with('message', 'Registro Actualizado.');
      }
     */
    public function update($id, Empleado $empleado, updateEmpleado $request) {
        $input = $request->except(['doc_empleado_id', 'archivo']);
        $input['usu_mod_id'] = Auth::user()->id;
        if (!isset($input['jefe_bnd'])) {
            $input['jefe_bnd'] = 0;
        } else {
            $input['jefe_bnd'] = 1;
        }
        if (!isset($input['alerta_bnd'])) {
            $input['alerta_bnd'] = 0;
        } else {
            $input['alerta_bnd'] = 1;
        }

        $empleado = $empleado->find($id);
        $e = $empleado->update($input);
        //dd($request->all());
        if ($request->has('doc_empleado_id') and $request->has('archivo')) {
            $input2['doc_empleado_id'] = $request->get('doc_empleado_id');
            $input2['archivo'] = $request->get('archivo');
            $input2['empleado_id'] = $id;
            $input2['usu_alta_id'] = Auth::user()->id;
            $input2['usu_mod_id'] = Auth::user()->id;
            PivotDocEmpleado::create($input2);
        }

        return redirect()->route('empleados.edit', $id)->with('message', 'Registro Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Empleado $empleado) {
        $empleado = $empleado->find($id);
        $empleado->delete();

        return redirect()->route('empleados.index')->with('message', 'Registro Borrado.');
    }

    public function usuarios(Request $request) {
        //dd($_REQUEST);
        $data = User::select('id as d', "name as n")
                ->where("name", "LIKE", "%" . $request->input('term') . "%")
                ->get();
        //dd($data);
        $results = array();
        foreach ($data as $value) {
            //dd($value);
            $results[] = ['id' => $value->d, 'text' => $value->n];
        }
        return response()->json($results);
    }

    public function getPlantel($id = 0) {
        //dd($_REQUEST['estado']);
        $e = $_REQUEST['empleado'];
        $plantel = Empleado::find($e)->plantel_id;
        //dd($municipios);
        return $plantel;
    }

    public function getEmpleadosXplantelXpuesto(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $plantel = $request->get('plantel_id');
            $puesto = $request->get('puesto_id');
            $empleado = $request->get('empleado_id');

            $final = array();
            $r = DB::table('empleados as e')
                    ->select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as nombre'))
                    ->where('e.plantel_id', '=', $plantel)
                    ->where('e.puesto_id', '=', $puesto)
                    ->where('e.id', '>', '0')
                    ->get();

            //dd($r);
            if (isset($empleado) and $empleado <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $empleado) {
                        array_push($final, array('id' => $r1->id,
                            'nombre' => $r1->nombre,
                            'selectec' => 'Selected'));
                    } else {
                        array_push($final, array('id' => $r1->id,
                            'nombre' => $r1->nombre,
                            'selectec' => ''));
                    }
                }
                return $final;
            } else {
                return $r;
            }
        }
    }

    public function getEmpleadosXplantel(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $input=$request->all();
            if(isset($input['asignacion_academicas.empleado_id_lt'])){
                $plantel = $request->get('plantel_id');
                $empleado = $input['q']['asignacion_academicas.empleado_id_lt'];
            }else{
                $plantel = $request->get('plantel_id');
                $empleado = $request->get('empleado_id');
            }

            $final = array();
            $r = DB::table('empleados as e')
                    ->select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as nombre'))
                    ->where('e.plantel_id', '=', $plantel)
                    ->where('e.id', '>', '0')
                    ->get();

            //dd($r);
            if (isset($empleado) and $empleado <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $empleado) {
                        array_push($final, array('id' => $r1->id,
                            'nombre' => $r1->nombre,
                            'selectec' => 'Selected'));
                    } else {
                        array_push($final, array('id' => $r1->id,
                            'nombre' => $r1->nombre,
                            'selectec' => ''));
                    }
                }
                return $final;
            } else {
                foreach ($r as $r1) {
                    array_push($final, array('id' => $r1->id,
                        'nombre' => $r1->nombre,
                        'selectec' => ''));
                }
                return $final;
                
            }
        }
    }

}
