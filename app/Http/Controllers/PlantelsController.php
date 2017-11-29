<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use File as Archi;
use App\Plantel;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\updatePlantel;
use App\Http\Requests\createPlantel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class PlantelsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index(Request $request)
	{
		$plantels = Plantel::getAllData($request);

		return view('plantels.index', compact('plantels'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('plantels.create')
			->with( 'list', Plantel::getListFromAllRelationApps() );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(createPlantel $request)
	{
		$input = $request->all();
                
		$input['usu_alta_id']=Auth::user()->id;
		$input['usu_mod_id']=Auth::user()->id;
		$input['logo']="";
		$r=$request->hasFile('logo_file');
		if($r){
			$logo_file = $request->file('logo_file');
			$input['logo'] = $logo_file->getClientOriginalName();
		}
		$r=$request->hasFile('slogan_file');
		if($r){
			$slogan_file = $request->file('slogan_file');
			$input['slogan'] = $slogan_file->getClientOriginalName();
		}
		$r=$request->hasFile('membrete_file');
		if($r){
			$membrete_file = $request->file('membrete_file');
			$input['membrete'] = $membrete_file->getClientOriginalName();	
		}
                
		//create data
		$e=Plantel::create( $input );
		if ( $e ){
			$ruta=public_path()."/imagenes/planteles/".$e->id."/";
			if(!file_exists($ruta)){
				Archi::makedirectory($ruta, 0777, true, true);
			}
			if($request->file('logo_file')){
				//Storage::disk('img_plantels')->put($input['logo'],  File::get($logo_file));
				$request->file('logo_file')->move($ruta, $input['logo']);
			}
			if($request->file('slogan_file')){
				//\Storage::disk('local')->put($input['slogan'],  \File::get($slogan_file));
				$request->file('slogan_file')->move($ruta, $input['slogan']);
			}
			if($request->file('membrete_file')){
				//\Storage::disk('local')->put($input['membrete'],  \File::get($membrete_file));
				$request->file('membrete_file')->move($ruta, $input['membrete']);
			}
		}

		return redirect()->route('plantels.index')->with('message', 'Registro creado.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, Plantel $plantel)
	{
		$plantel=$plantel->find($id);
		return view('plantels.show', compact('plantel', 'ruta'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, Plantel $plantel)
	{
		$plantel=$plantel->find($id);
		$ruta=public_path()."\\imagenes\\planteles\\".$id."\\";
		return view('plantels.edit', compact('plantel', 'ruta'))
			->with( 'list', Plantel::getListFromAllRelationApps() );
	}

	/**
	 * Show the form for duplicatting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function duplicate($id, Plantel $plantel)
	{
		$plantel=$plantel->find($id);
		return view('plantels.duplicate', compact('plantel'))
			->with( 'list', Plantel::getListFromAllRelationApps() );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update($id, Plantel $plantel, updatePlantel $request)
	{
		//dd($request->all());
		$input = $request->all();
		$input['usu_mod_id']=Auth::user()->id;

		$input['logo']="";
		$r=$request->hasFile('logo_file');
		if($r){
			$logo_file = $request->file('logo_file');
			$input['logo'] = $logo_file->getClientOriginalName();
		}
		$r=$request->hasFile('slogan_file');
		if($r){
			$slogan_file = $request->file('slogan_file');
			$input['slogan'] = $slogan_file->getClientOriginalName();
		}
		$r=$request->hasFile('membrete_file');
		if($r){
			$membrete_file = $request->file('membrete_file');
			$input['membrete'] = $membrete_file->getClientOriginalName();	
		}

		$plantel=$plantel->find($id);

		//update data
		$e=$plantel->update($input);
		if ( $e ){
			$ruta=public_path()."/imagenes/planteles/".$id."/";
			if(!file_exists($ruta)){
				Archi::makedirectory($ruta, 0777, true, true);
			}
			if($request->file('logo_file')){
				//$logo_file = $request->file('logo_file');
				//Storage::disk('img_plantels')->put($input['logo'],  File::get($logo_file));
				$request->file('logo_file')->move($ruta, $input['logo']);
			}
			if($request->file('slogan_file')){
				//\Storage::disk('local')->put($input['slogan'],  \File::get($slogan_file));
				$request->file('slogan_file')->move($ruta, $input['slogan']);
			}
			if($request->file('membrete_file')){
				//\Storage::disk('local')->put($input['membrete'],  \File::get($membrete_file));
				$request->file('membrete_file')->move($ruta, $input['membrete']);
			}
		}

		return redirect()->route('plantels.index')->with('message', 'Registro actualizado.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Plantel $plantel)
	{
		$plantel=$plantel->find($id);

		$plantel->delete();

		return redirect()->route('plantels.index')->with('message', 'Registro borrado.');
	}

}
