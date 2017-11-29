<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File;
use App\Cliente;
use App\Seguimiento;
use App\Sm;
use App\Correo;
use App\Empleado;
use App\PreguntaCliente;
use App\Estado;
use App\Municipio;
use App\PivotDocCliente;
use App\Preguntum;
use App\Param;
use App\Plantilla;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCliente;
use App\Http\Requests\createCliente;
use App\Http\Requests\Carga;
use Sms;
use Session;
use Hash;
use DB;
use Excel;
//use App\Mail\CorreoBienvenida as Envia_mail;

class ClientesController extends Controller {

    private $meta_residuo = 0;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        /* $c=Cliente::find(86);
          dd($c); */
        $clientes = Seguimiento::getAllData($request);
        //dd($clientes);
        return view('clientes.index', compact('clientes'))
                        ->with('list', Seguimiento::getListFromAllRelationApps())
                        ->with('list1', Cliente::getListFromAllRelationApps());
    }

    public function index2(Request $request) {
        //dd($request);
        $clientes = Cliente::getAllData($request);
        //dd($clientes);
        return view('clientes.index2', compact('clientes'))
                        ->with('list', Seguimiento::getListFromAllRelationApps())
                        ->with('list1', Cliente::getListFromAllRelationApps());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {

        //dd(Municipio::get());
        $p = Auth::user()->can('IfiltroEmpleadosXPlantel');
        if ($p) {
            $e = Empleado::where('user_id', '=', Auth::user()->id)->first();
            $empleados = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                    ->where('plantel_id', '=', $e->plantel_id)
                    ->where('puesto_id', '=', 2)
                    ->pluck('name', 'id');
        } else {
            $empleados = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                    ->where('puesto_id', '=', 2)
                    ->pluck('name', 'id');
        }
        $empleados = $empleados->reverse();
        $empleados->put(0, 'Seleccionar Opción');
        $empleados = $empleados->reverse();
        //dd($empleados);
        return view('clientes.create', compact('empleados'))
                        ->with('list', Cliente::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createCliente $request) {
        $id = 0;
        $input = $request->all();
        //$empleado=Empleado::find($request->input('empleado_id'));
        //$input['plantelplantel_id']=$empleado->plantel->id;
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;
        $param=Param::where('llave', '=', 'msj_text')->first();
        if ($input['cve_cliente'] == "") {
            $input['cve_cliente'] = 'Codigo: ' . substr(Hash::make(rand(0, 1000)), 2, 8) . $param->valor;
        }
        if (!isset($input['promociones'])) {
            $input['promociones'] = 0;
        } else {
            $input['promociones'] = 1;
        }
        if (!isset($input['promo_cel'])) {
            $input['promo_cel'] = 0;
        } else {
            $input['promo_cel'] = 1;
        }
        if (!isset($input['promo_correo'])) {
            $input['promo_correo'] = 0;
        } else {
            $input['promo_correo'] = 1;
        }
        if (!isset($input['celular_confirmado'])) {
            $input['celular_confirmado'] = 0;
        } else {
            $input['celular_confirmado'] = 1;
        }
        if (!isset($input['extranjero'])) {
            $input['extranjero'] = 0;
        } else {
            $input['extranjero'] = 1;
        }
        //dd($input);
        //create data
        try {
            //dd($input);
            $c = Cliente::create($input);
            $id = $c->id;
            $input_seguimiento['cliente_id'] = $c->id;
            $input_seguimiento['st_seguimiento_id'] = 1;
            $input_seguimiento['mes'] = date('m');
            $input_seguimiento['usu_alta_id'] = Auth::user()->id;
            $input_seguimiento['usu_mod_id'] = Auth::user()->id;
            $s = Seguimiento::create($input_seguimiento);
        } catch (\PDOException $e) {
            dd($e);
            if ($e->getCode() == 23000) {
                //dd($e);
                return redirect()->route('clientes.edit', $id)->with('message', 'Registro guardado');
            }
        }
        return redirect()->route('clientes.edit', $id)->with('message', 'Registro Creado.')->with('list', Cliente::getListFromAllRelationApps());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Cliente $cliente) {
        $cliente = $cliente->find($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Cliente $cliente) {
        $cliente = $cliente->find($id);
        $p = Auth::user()->can('IfiltroEmpleadosXPlantel');
        //dd($p);
        if ($p) {
            $e = Empleado::where('user_id', '=', Auth::user()->id)->first();
            $empleados = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                    ->where('plantel_id', '=', $e->plantel_id)
                    ->where('puesto_id', '=', 2)
                    ->pluck('name', 'id');
        } else {
            $empleados = Empleado::select('id', DB::raw('concat(nombre," ",ape_paterno," ",ape_materno) as name'))
                    ->where('puesto_id', '=', 2)
                    ->pluck('name', 'id');
        }
        $empleados = $empleados->reverse();
        $empleados->put(0, 'Seleccionar Opción');
        $empleados = $empleados->reverse();
        $cp = PreguntaCliente::where('cliente_id', '=', $id)->get();
        $preguntas = Preguntum::pluck('name', 'id');
        //dd($cp);
        //dd($preguntas);
        $doc_existentes = DB::table('pivot_doc_clientes as pde')->select('doc_alumno_id')
                        ->join('clientes as c', 'c.id', '=', 'pde.cliente_id')
                        ->where('c.id', '=', $id)
                        ->where('pde.deleted_at', '=', NULL)->get();

        $de_array = array();
        if ($doc_existentes->isNotEmpty()) {
            foreach ($doc_existentes as $de) {
                array_push($de_array, $de->doc_alumno_id);
            }
            //dd($de_array);
        }

        $documentos_faltantes = DB::table('doc_alumnos')
                ->select()
                ->whereNotIn('id', $de_array)
                ->get();
        //dd($cliente->toArray());
        return view('clientes.edit', compact('cliente', 'preguntas', 'cp', 'documentos_faltantes', 'empleados'))
                        ->with('list', Cliente::getListFromAllRelationApps())
                        ->with('list1', PivotDocCliente::getListFromAllRelationApps());
    }

    public function getReasignar() {
        return view('clientes.frm_reasignar')
                        ->with('list', Cliente::getListFromAllRelationApps());
    }

    public function getCuenta(Request $request) {
        //dd($request->input('plantel_id'));
        $plantel = $request->input('plantel_id');
        $empleado = $request->input('empleado_id');
        $estatus = $request->input('st_cliente_id');
        $cuenta = Cliente::where('plantel_id', '=', $plantel)
                ->where('empleado_id', '=', $empleado)
                ->where('st_cliente_id', '=', $estatus)
                ->count();

        return $cuenta;
    }

    public function postReasignar(Request $request) {
        $input = $request->all();
        //dd($input);
        Cliente::where('plantel_id', '=', $input['plantel_id'])
                ->where('empleado_id', '=', $input['empleado_id'])
                ->where('st_cliente_id', '=', $input['st_cliente_id'])
                ->update(['empleado_id' => $input['empleado_id2']]);

        return redirect()->route('clientes.index');
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, Cliente $cliente) {
        $cliente = $cliente->find($id);
        $preguntas = Preguntum::pluck('name', 'id');
        $cp = PreguntaCliente::where('cliente_id', '=', $id)->get();
        return view('clientes.duplicate', compact('cliente', 'preguntas', 'cp'))
                        ->with('list', Cliente::getListFromAllRelationApps())
                        ->with('list1', Cliente::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Cliente $cliente, updateCliente $request) {
        //dd("fil");
        $input = $request->all();
        $input['usu_mod_id'] = Auth::user()->id;
        //$empleado=Empleado::find($request->input('empleado_id'));
        //$input['plantel_id']=$empleado->plantel->id;
        $pc['cliente_id'] = $id;
        $pc['pregunta_id'] = $input['pregunta_id'];
        $pc['respuesta'] = $input['respuesta'];
        $pc['usu_alta_id'] = Auth::user()->id;
        $pc['usu_mod_id'] = Auth::user()->id;
        //dd($pc);
        unset($input['pregunta_id']);
        unset($input['respuesta']);
        //dd($input);
        if (!isset($input['promociones'])) {
            $input['promociones'] = 0;
        } else {
            $input['promociones'] = 1;
        }
        if (!isset($input['promo_cel'])) {
            $input['promo_cel'] = 0;
        } else {
            $input['promo_cel'] = 1;
        }
        if (!isset($input['promo_correo'])) {
            $input['promo_correo'] = 0;
        } else {
            $input['promo_correo'] = 1;
        }
        if (!isset($input['celular_confirmado'])) {
            $input['celular_confirmado'] = 0;
        } else {
            $input['celular_confirmado'] = 1;
        }
        if (!isset($input['extranjero'])) {
            $input['extranjero'] = 0;
        } else {
            $input['extranjero'] = 1;
        }
        //dd($input);
        //update data
        $cliente = $cliente->find($id);
        $cliente->update($input);
        if ($request->has('doc_cliente_id') and $request->has('archivo')) {
            $input2['doc_alumno_id'] = $request->get('doc_cliente_id');
            $input2['archivo'] = $request->get('archivo');
            $input2['cliente_id'] = $id;
            $input2['usu_alta_id'] = Auth::user()->id;
            $input2['usu_mod_id'] = Auth::user()->id;
            PivotDocCliente::create($input2);
        }

        if ($pc['pregunta_id'] <> 0) {
            PreguntaCliente::create($pc);
        }



        return redirect()->route('clientes.edit', $id)->with('message', 'Registro Actualizado.');
    }

    public function confirmaCorreo($id, Cliente $cliente, Request $request) {
        $cliente = $cliente->find($id);
        $cliente->correo_confirmado = 1;
        $cliente->save();

        //dd('Agradecemos tu tiempo, tu correo fue confirmado.');
        return view('clientes.confirmaCorreo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Cliente $cliente, Seguimiento $s) {
        $cliente = $cliente->find($id);
        $cliente->delete();
        $s->where('cliente_id', '=', $id)->delete();

        return redirect()->route('clientes.index')->with('message', 'Registro Borrado.');
    }

    public function autocomplete(Request $request) {
        //dd($_REQUEST);
        $data = Cliente::select("expo as descripcion")
                ->where("expo", "LIKE", "%" . $request->input('term') . "%")
                ->get();
        //dd($data);
        $results = array();
        foreach ($data as $value) {
            //dd($value);
            $results[] = ['label' => $value->descripcion];
        }
        return response()->json($results);
    }

    public function carga() {
        return view('clientes.carga')
                        ->with('list', Empleado::getListFromAllRelationApps());
    }

    public function cargaFile(Carga $request) {
        $procesados = 0;
        //Define datos de trabajo
        $p = $request->input('plantel_id');
        $r = $request->hasFile('archivo');
        $total_archivo = $request->input('no_registros');

        //
        $total_empleados = Empleado::where('st_empleado_id', '=', '1')->count();
        $total_asignado = Empleado::where('st_empleado_id', '=', '1')->sum('pendientes');

        $total_meta = $total_asignado + $total_archivo;
        $meta_individual = (($total_meta - ($total_meta % $total_empleados)) / $total_empleados);
        $this->meta_residuo = $total_meta % $total_empleados;

        //dd($r);
        //dd(getdate());

        if ($r) {
            //Carga Archivo
            $archivo = $request->file('archivo');
            $a = $archivo->getClientOriginalName();
            $ruta = public_path() . "/files/carga/" . $p . "/" . date("dmY_his") . "/";
            if (!file_exists($ruta)) {
                File::makedirectory($ruta, 0777, true, true);
            }
            $request->file('archivo')->move($ruta, $a);

            //Abre Archivo
            $fileD = fopen($ruta . $a, "r");
            $column = fgetcsv($fileD);
            while (!feof($fileD)) {
                $rowData[] = fgetcsv($fileD);
            }

            //dd($rowData);

            foreach ($rowData as $key => $value) {
                try {
                    $linea = explode(';', $value[0]);
                    //dd($linea);
                    $input['nombre'] = $linea[1];
                    $input['mail'] = $linea[2];
                    $input['tel_fijo'] = $linea[3];
                    $input['tel_cel'] = $linea[4];

                    //$empleado=Empleado::find($request->input('empleado_id'));
                    $input['plantel_id'] = $p;
                    $input['usu_alta_id'] = Auth::user()->id;
                    $input['usu_mod_id'] = Auth::user()->id;
                    $input['promociones'] = 0;
                    $input['promo_cel'] = 0;
                    $input['promo_correo'] = 0;
                    $input['municipio_id'] = 0;
                    $input['estado_id'] = 0;
                    $input['st_cliente_id'] = 1;
                    $input['ofertum_id'] = 0;
                    $input['medio_id'] = 0;
                    $input['empleado_id'] = $this->defineEmpleado($meta_individual);
                    $input['nivel_id'] = 0;
                    $input['grado_id'] = 0;
                    $input['curso_id'] = 0;
                    $input['subcurso_id'] = 0;
                    $input['diplomado_id'] = 0;
                    $input['subdiplomado_id'] = 0;
                    $input['otro_id'] = 0;
                    $input['subotro_id'] = 0;

                    if (Cliente::create($input)) {
                        $procesados++;
                    }
                } catch (\Exception $e) {
                    
                }
            }
        }

        //unlink($ruta.$a);

        return view('clientes.carga', compact('procesados'))
                        ->with('list', Empleado::getListFromAllRelationApps());
    }

    public function defineEmpleado($meta_individual) {
        $empleados = Empleado::select('id', 'pendientes')->where('st_empleado_id', '=', '1')->get();
        foreach ($empleados as $e) {
            $pendientes = Empleado::where('id', '=', $e->id)->value('pendientes');
            if ($pendientes < $meta_individual) {
                return $e->id;
            }
        }
        foreach ($empleados as $e) {
            if ($this->meta_residuo > 0) {
                $this->meta_residuo--;
                return $e->id;
            }
        }
    }

    public function enviaSms(Request $request) {
        //dd($_REQUEST);
        if ($request->ajax()) {
            try {
                $r = Param::where('llave', '=', 'sms')->first();
                $no= Param::where('llave', '=', 'num_twilio')->first();
                $to = '+52' . e($request->input('tel_cel'));
                //dd($to);
                $message = e($request->input('cve_cliente'));
                $from = $no->valor;
                
                //dd($r->valor);
                if ($r->valor == 'activo') {
                    if (Sms::send($message, $to, $from)) {
                        $input['usu_envio_id'] = Auth::user()->id;
                        $input['cliente_id'] = e($request->input('id'));
                        $input['fecha_envio'] = date("Y/m/d");
                        $input['usu_alta_id'] = Auth::user()->id;
                        $input['usu_mod_id'] = Auth::user()->id;
                        Sm::create($input);
                        //dd("msj");
                    }
                }
                //return true;
            } catch (\Exception $e) {
                dd($e);
                //return false;
            }
        }
    }

    /* public function enviaMail(Request $request){
      //dd($_REQUEST);
      if($request->ajax()){
      try{
      $r=Param::where('llave','=', 'correo_electronico')->first();
      if($r->valor=='activo'){
      //dd($r->id);
      //$data=$r->toArray();
      //dd($data);
      \Mail::send('emails.2', array(), function($message) use ($request)
      {
      $message->to(e($request->mail), e($request->nombre)." ".e($request->ape_paterno)." ".e($request->ape_materno));
      $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
      $message->subject("Bienvenido");
      });

      $cli=Cliente::find(e($request->id));

      $nombre=e($request->nombre)." ".e($request->ape_paterno)." ".e($request->ape_materno);
      $mail=e($request->mail);
      $m=\Mail::to($mail, $nombre);
      $m->queue(new Envia_mail($cli));

      $input2['usu_envio_id']=Auth::user()->id;
      $input2['cliente_id']=e($request->input('id'));
      $input2['fecha_envio']=date("Y/m/d");
      $input2['cantidad']=1;
      $input2['usu_alta_id']=Auth::user()->id;
      $input2['usu_mod_id']=Auth::user()->id;
      //dd("f");
      Correo::create($input2);
      }

      return true;
      }catch(\Exception $e){
      dd($e);
      //return false;
      }


      }
      } */

    public function enviaMail(Request $request) {
        //dd($_REQUEST);
        $r = 0;
        $cli = Cliente::find(e($request->id));
        $pla = Plantilla::find(2);
        //dd($pla);
        $p=array();
        $p['img1']=$pla->img1;
        $p['plantilla']=$pla->plantilla;
        $p['id']=$cli->id;
        //dd($pla);
        
        if ($request->ajax()) {
            try {
                $r = Param::where('llave', '=', 'correo_electronico')->first();
                if ($r->valor == 'activo') {
                    \Mail::send('emails.7', $p, function($message) use ($request) {
                        $message->to(e($request->mail), e($request->nombre) . " " . e($request->ape_paterno) . " " . e($request->ape_materno));
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                        $message->subject("Bienvenido");
                    });
                    
                    $input2['usu_envio_id'] = Auth::user()->id;
                    $input2['cliente_id'] = e($request->input('id'));
                    $input2['fecha_envio'] = date("Y/m/d");
                    $input2['cantidad'] = 1;
                    $input2['usu_alta_id'] = Auth::user()->id;
                    $input2['usu_mod_id'] = Auth::user()->id;
                    Correo::create($input2);
                }

                //return true;
            } catch (\Exception $e) {
                //dd($e);
                return $e;
            }
        }
    }

    public function cmbMClientes() {
        $c = Cliente::select('id', 'nombre', 'nombre2', 'ape_paterno', 'ape_materno', 'mail')->get();
        //return response()->json($c);
        echo json_encode($c);
    }

    public function indexLista() {
        return view('clientes.modal_search');
    }

    public function lista(Request $request) {
        //dd(Session::get('cliente_field'));
        Session::put('cliente_search', $request->has('ok') ? $request->input('search') : (Session::has('cliente_search') ? Session::get('cliente_search') : ''));
        Session::put('nombre2_search', $request->has('ok') ? $request->input('search2') : (Session::has('nombre2_search') ? Session::get('nombre2_search') : ''));
        Session::put('ape_paterno_search', $request->has('ok') ? $request->input('search3') : (Session::has('ape_paterno_search') ? Session::get('ape_paterno_search') : ''));
        Session::put('ape_materno_search', $request->has('ok') ? $request->input('search4') : (Session::has('ape_materno_search') ? Session::get('ape_materno_search') : ''));
        //Session::put('cliente_field', $request->has('field') ? $request->input('field') : (Session::has('cliente_field') ? Session::get('cliente_field') : 'nombre'));
        //Session::put('cliente_sort', $request->has('sort') ? $request->input('sort') : (Session::has('cliente_sort') ? Session::get('cliente_sort') : 'asc'));
        $clientes = Cliente::where('nombre', 'like', '%' . Session::get('cliente_search') . '%')
                ->where('nombre2', 'like', '%' . Session::get('nombre2_search') . '%')
                ->where('ape_paterno', 'like', '%' . Session::get('ape_paterno_search') . '%')
                ->where('ape_materno', 'like', '%' . Session::get('ape_materno_search') . '%')
                ->paginate(8);
        //->orderBy(Session::get('cliente_field'), Session::get('cliente_sort'))->paginate(8);

        return view('clientes.modal_list', ['clientes' => $clientes]);
    }

    public function getCmbAlumno(Request $request) {
        if ($request->ajax()) {
            //dd($request->all());
            $plantel = $request->get('plantel_id');
            $especialidad = $request->get('especialidad_id');
            $nivel = $request->get('nivel_id');
            $grado = $request->get('grado_id');
            $grupo = $request->get('grupo_id');
            //dd($request->all());
            $cliente = $request->get('cliente_id');
            $final = array();
            $r = DB::table('inscripcions as i')
                    ->select('c.id', DB::raw('concat(c.nombre," ",c.ape_paterno," ",c.ape_paterno) as name'))
                    ->join('clientes as c', 'c.id', '=', 'i.cliente_id')
                    ->where('i.plantel_id', '=', $plantel)
                    ->where('i.especialidad_id', '=', $especialidad)
                    ->where('i.nivel_id', '=', $nivel)
                    ->where('i.grado_id', '=', $grado)
                    ->where('i.grupo_id', '=', $grupo)
                    ->where('i.id', '>', '0')
                    ->get();
            //dd($r);
            if (isset($cliente) and $cliente <> 0) {
                foreach ($r as $r1) {
                    if ($r1->id == $cliente) {
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
    
    public function descargaClientes(){
        
        $clientes = Cliente::select('clientes.fec_registro as FechaRegistro', 'clientes.nombre as PrimerNombre', 
                        'clientes.nombre2 as SegundoNombre', 'clientes.ape_paterno as ApellidoPaterno', 'clientes.ape_materno as ApellidoMaterno',
                        'clientes.tel_fijo as Telefono', 'clientes.tel_cel as Celular', 'clientes.mail as Email', 
                        'clientes.escuela_procedencia as EscuelaProcedencia', 'm.name as medio as Medio')
                        ->join('medios as m', 'm.id', '=', 'clientes.medio_id')
                        //->limit(20)
                        ->get();
        //dd($clientes);
        /*$clientes_array=array();
        $encabezados=array('Fecha', 'P. Nombre', 'S. Nombre', 'A. Paterno', 'A. Materno', 'Teléfono', 
                        'Celular', 'Mail', 'Escuela Procedencia', 'Medio');
        array_push($clientes_array, $encabezados);
        //dd($clientes_array);
         
        foreach($clientes as $c){
            //$clientes_array=$c->toArray();
            array_push($clientes_array, $c);
        }
        dd($clientes_array);
         * 
         */
        //dd("excel inicia");
        Excel::create('Clientes', function($excel) use ($clientes) {
            $excel->sheet('Clientes', function($sheet) use ($clientes) {
                $sheet->fromArray($clientes->toArray());
            });
        })->download('xlsx');
        dd("excel terminado");
    }

}
