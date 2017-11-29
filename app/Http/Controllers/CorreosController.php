<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Correo;
use App\Empresa;
use App\Cliente;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updateCorreo;
use App\Http\Requests\createCorreo;
use Mail;
use Storage;

class CorreosController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        $correos = Correo::getAllData($request);

        return view('correos.index', compact('correos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('correos.create')
                        ->with('list', Correo::getListFromAllRelationApps());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(createCorreo $request) {

        $input = $request->all();
        $input['usu_alta_id'] = Auth::user()->id;
        $input['usu_mod_id'] = Auth::user()->id;

        //create data
        Correo::create($input);

        return redirect()->route('correos.index')->with('message', 'Registro Creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Correo $correo) {
        $correo = $correo->find($id);
        return view('correos.show', compact('correo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id, Correo $correo) {
        $correo = $correo->find($id);
        return view('correos.edit', compact('correo'))
                        ->with('list', Correo::getListFromAllRelationApps());
    }

    /**
     * Show the form for duplicatting the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function duplicate($id, Correo $correo) {
        $correo = $correo->find($id);
        return view('correos.duplicate', compact('correo'))
                        ->with('list', Correo::getListFromAllRelationApps());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Correo $correo, updateCorreo $request) {
        $input = $request->all();
        $input['usu_mod_id'] = Auth::user()->id;
        //update data
        $correo = $correo->find($id);
        $correo->update($input);

        return redirect()->route('correos.index')->with('message', 'Registro Actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Correo $correo) {
        $correo = $correo->find($id);
        $correo->delete();

        return redirect()->route('correos.index')->with('message', 'Registro Borrado.');
    }

    public function redactar($mail="Sin correo", $nombre="", $empresa=0) {
        $mail = $mail;
        $nombre = $nombre;
        $empresa=$empresa;
        return view('correos.version2.frm_envio', compact('mail', 'nombre', 'empresa'));
    }

    public function cargaArchivoCorreo(Request $request) {
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $nombre = $file->getClientOriginalName();
            $r = Storage::disk('tmp_correos')->put($nombre, \File::get($file));
        } else {

            return "no";
        }

        if ($r) {
            return $nombre;
        } else {
            return "Error vuelva a intentarlo";
        }
    }

    public function enviarCorreo(Request $request) {
        //dd($request->all());
        $pathToFile = "";
        $containfile = false;
        if ($request->hasFile('file')) {
            $containfile = true;
            $file = $request->file('file');
            $nombre = $file->getClientOriginalName();
            $pathToFile = storage_path('app') . "/tmp_correos/" . $nombre;
        }
        /*
        
        if(isset($request->input("persona_bnd"))){
            $cli=Cliente::where('mail', '=', $request->input("persona_bnd"))->first();
        }
        */
        $f=$request->all();
        //dd($f);
        $destinatario = $request->input("destinatario");
        $n = $request->input("nombre");
        $asunto = $request->input("asunto");
        $contenido = $request->input("contenido_mail");


        $data = array('contenido' => $contenido, 'nombre' => $n);
        $r = \Mail::send('correos.version2.correo_individual', $data, function ($message)
                    use ($asunto, $destinatario, $containfile, $pathToFile, $n) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->to($destinatario, $n)->subject($asunto);
                    if ($containfile) {
                        $message->attach($pathToFile);
                    }
                });
        
        if(isset($f['empresa_bnd']) and $f['empresa_bnd']==1){
            $e=Empresa::where('correo1', '=', $destinatario)->first();
            //dd($e->toArray());
            $clientes=Cliente::where('empresa_id', '=', $e->id)->get();
            //dd($clientes->toArray());
            foreach($clientes as $c){
                //dd($c);
                $data = array('contenido' => $contenido, 'nombre' => $c->nombre);
                $r = \Mail::send('correos.version2.correo_individual', $data, function ($message)
                    use ($asunto, $containfile, $pathToFile, $c) {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->to($c->mail, $c->nombre)->subject($asunto);
                    if ($containfile) {
                        $message->attach($pathToFile);
                    }
                });
            }
        }
        //dd($r);
        //if ($r) {
            if ($containfile) {
                Storage::disk('local')->delete($nombre);
            }
            return view("correos.version2.msj_correcto")->with("msj", "Correo enviado correctamente");
        /*} else {
            return view("correos.version2.msj_rechazado")->with("msj", "Se presentó un error vuelva a intentarlo");
        }*/
    }

}
