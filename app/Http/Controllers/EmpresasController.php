<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Empresa;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateEmpresa;
use App\Http\Requests\createEmpresa;
use DB;

class EmpresasController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $empresas = Empresa::getAllData($request);

        return view('empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $p = Empleado::where('user_id', '=', Auth::user()->id)
                ->value('plantel_id');

        return view('empresas.create', compact('p'))
                        ->with('list', Empresa::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createEmpresa $request) {

        $input = $request->all();
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;

        //create data
        Empresa::create($input);

        return redirect()->route('empresas.index')->with('message', 'Registro Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Empresa $empresa) {
        $empresa = $empresa->find($id);
        return view('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Empresa $empresa) {
        $empresa = $empresa->find($id);
        $p = Empleado::where('user_id', '=', Auth::user()->id)
                ->value('plantel_id');
        return view('empresas.edit', compact('empresa', 'p'))
                        ->with('list', Empresa::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, Empresa $empresa) {
        $empresa = $empresa->find($id);
        return view('empresas.duplicate', compact('empresa'))
                        ->with('list', Empresa::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Empresa $empresa, updateEmpresa $request) {
        $input = $request->all();
        $input['usu_mod_id'] = Auth::user()->id;
        //update data
        $empresa = $empresa->find($id);
        $empresa->update($input);

        return redirect()->route('empresas.index')->with('message', 'Registro Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Empresa $empresa) {
        $empresa = $empresa->find($id);
        $empresa->delete();

        return redirect()->route('empresas.index')->with('message', 'Registro Borrado.');
    }

    public function getEmpleadosXmail(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $mail = $request->get('correo');
            $nombre=$request->get('nombre');
            //dd($mail);
            
            $sr = DB::table('empresas as e')
                    ->join('clientes as c', 'c.empresa_id', '=', 'e.id')
                    ->select('c.id','c.mail', 'c.nombre')
                    ->where('e.correo1', '=', $mail)
                    ->whereNotNull('c.mail')
                    ->get();
            //dd($sr->toArray());
            $resultado=array();
            $lcorreos=$mail.",";
            $lnombres=$nombre.",";
            
                    
            foreach($sr as $r){
                $lcorreos=$lcorreos.$r->mail.",";
                $lnombres=$lnombres.$r->nombre.",";
            }
            $resultado=array(substr($lcorreos, 0, -1), substr($lnombres, 0, -2));
            return $resultado;
            //dd($r);
            
        }
    }

}
