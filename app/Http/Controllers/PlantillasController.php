<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Plantilla;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePlantilla;
use App\Http\Requests\createPlantilla;
use Storage;

class PlantillasController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$plantillas = Plantilla::getAllData($request);

		return view('plantillas.index', compact('plantillas'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('plantillas.create')
			->with( 'list', Plantilla::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPlantilla $request)
	{

		$input = $request->all();
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		$input['periodo_id']=2;
                /*if ($request->hasFile('file')) {
                    $containfile = true;
                    $file = $request->file('file');
                    $input['img1'] = $file->getClientOriginalName();
                }*/
		if($input['inicio']=="" or $input['inicio']=="0000-00-00"){$input['inicio']=date('Y-m-d');}
		if($input['fin']=="" or $input['fin']=="0000-00-00"){$input['fin']=date('Y-m-d');}
		if(!isset($input['activo_bnd'])){
			$input['activo_bnd']=0;
		}else{
			$input['activo_bnd']=1;
		}
		if(!isset($input['sms_bnd'])){
			$input['sms_bnd']=0;
		}else{
			$input['sms_bnd']=1;
		}
		if(!isset($input['mail_bnd'])){
			$input['mail_bnd']=0;
		}else{
			$input['mail_bnd']=1;
		}
		$h=str_replace('http:/', 'http://', $input['plantilla']);
		$h=str_replace('&gt;', '>', $h);
		$input['plantilla']=$h;
		//dd($input);
		//create data
		$p=Plantilla::create( $input );
		/*$file = fopen(base_path('resources\views\emails\\'.$p->id.'.blade.php'), "w+");
		fwrite($file, $input['plantilla']);
		fclose($file);
                */
		return redirect()->route('plantillas.index')->with('message', 'Registro Creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Plantilla $plantilla)
	{
		$plantilla=$plantilla->find($id);
		return view('plantillas.show', compact('plantilla'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Plantilla $plantilla)
	{
		$plantilla=$plantilla->find($id);
		return view('plantillas.edit', compact('plantilla'))
			->with( 'list', Plantilla::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Plantilla $plantilla)
	{
		$plantilla=$plantilla->find($id);
		return view('plantillas.duplicate', compact('plantilla'))
			->with( 'list', Plantilla::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Plantilla $plantilla, updatePlantilla $request)
	{
		$input = $request->all();
                //dd($input);
		$input['usu_mod_id']=Auth::user()->id;
		$input['periodo_id']=2;
		$st=$input['st_cliente'];	
		unset($input['st_cliente']);
                unset($input['file']);
		//$esp=$input['especialidad_id'];
		//unset($input['especialidad_id']);
		$input['st_cliente_id']=0;
		/*if ($request->hasFile('file')) {
                    $containfile = true;
                    $file = $request->file('file');
                    $input['img1'] = $file->getClientOriginalName();
                }*/
                if(!isset($input['activo_bnd'])){
			$input['activo_bnd']=0;
		}else{
			$input['activo_bnd']=1;
		}
		if(!isset($input['sms_bnd'])){
			$input['sms_bnd']=0;
		}else{
			$input['sms_bnd']=1;
		}
		if(!isset($input['mail_bnd'])){
			$input['mail_bnd']=0;
		}else{
			$input['mail_bnd']=1;
		}
		$h=str_replace('http:/', 'http://', $input['plantilla']);
		$h=str_replace('&gt;', '>', $h);
		$input['plantilla']=$h;
		//dd($input);
		//update data
		if($input['inicio']=="" or $input['inicio']=="0000-00-00"){$input['inicio']=date('Y-m-d');}
		if($input['fin']=="" or $input['fin']=="0000-00-00"){$input['fin']=date('Y-m-d');}
		
		$plantilla=$plantilla->find($id);
                //dd($input);
		$plantilla->update( $input );

		//dd($input);
		if($st<>0){
			$plantilla->estatus()->attach($st);	
		}
		//dd($esp);
		/*if($esp<>0){
			$plantilla->especialidad()->attach($esp);	
		}*/
		
		//dd($input['plantilla']);
		/*$file = fopen(base_path('resources\views\emails\\'.$id.'.blade.php'), "w+");
		
		
		//dd($h);
		fwrite($file, $h);
		fclose($file);
*/
		return redirect()->route('plantillas.edit', $id)->with('message', 'Registro Actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id,Plantilla $plantilla)
	{
		$plantilla=$plantilla->find($id);
		$plantilla->delete();

		return redirect()->route('plantillas.index')->with('message', 'Registro Borrado.');
	}


	public function eliminarEstatus(Request $request, Plantilla $p){
		$p=$p->find($_GET['plantilla']);
		//dd($p);
		$p->estatus()->detach($_GET['st']);
		return redirect()->route('plantillas.edit', $p->id)->with('message', 'Registro Actualizado.');
	}	
	public function eliminarEspecialidad(Request $request, Plantilla $p){
		$p=$p->find($_GET['plantilla']);
		//dd($p);
		$p->especialidad()->detach($_GET['esp']);
		return redirect()->route('plantillas.edit', $p->id)->with('message', 'Registro Actualizado.');
	}	
        
    public function cargaArchivoCorreo(Request $request) {
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $nombre = $file->getClientOriginalName();
            $r = Storage::disk('plantillas_correos')->put($nombre, \File::get($file));
        } else {

            return "no";
        }

        if ($r) {
            return $nombre;
        } else {
            return "Error vuelva a intentarlo";
        }
    }
}
