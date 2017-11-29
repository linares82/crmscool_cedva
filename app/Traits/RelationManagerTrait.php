<?php

/**
Copyright (c) 2016 dog-ears

This software is released under the MIT License.
http://dog-ears.net/
*/

namespace App\Traits;
use App\Empleado;
use App\Nivel;
use Auth;
use DB;
trait RelationManagerTrait {

    /**
     * The relation App.
     *
     * @var relationApps
     */
    protected $relationApps;

    /**
     * Add relation App to list
     *
     * @param  string  $path
     * @return string
     */
    protected function addRelationApp($app, $relation_display_column = 'name'){

		if( !is_object($app) ){
			throw new \Exception( "Argument is not Object!" );
		}

		$appNames = explode( '\\', get_class($app) );
		$appName = end($appNames);

    	$this->relationApps[$appName]['app'] = $app;
    	$this->relationApps[$appName]['relation_display_column'] = $relation_display_column;
    }

    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function getListFromAllRelationApps()
    {
    	$list = [];

        if( $this->relationApps ){
    		foreach ( $this->relationApps as $relationAppName => $relationAppArray ){
          
          $relatedObjList = $relationAppArray['app']::where('id', '>', 0)->pluck($relationAppArray['relation_display_column'], 'id');
          $e=Empleado::where('user_id', '=', Auth::user()->id)->first();
          
          if($relationAppName=="Empleado" and Auth::user()->can('IfiltroEmpleadosXPlantelRelacion')){
            //dd($relationAppName);
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                        ->pluck($relationAppArray['relation_display_column'], 'id');
            //dd($relatedObjList);
          }
          if($relationAppName=="Empleado"){
            //dd($relationAppName);
            $relatedObjList = $relationAppArray['app']::select(DB::raw('concat(empleados.nombre, " ",empleados.ape_paterno, " ",empleados.ape_materno) as relacion, empleados.id'))
                                                        ->pluck('relacion', 'id');
            //dd($relatedObjList);
          }
          if($relationAppName=="TpoExamen"){
            
            $relatedObjList = $relationAppArray['app']::where('id', '>', 1)->pluck($relationAppArray['relation_display_column'], 'id');
            //dd($relatedObjList);
          }
          if($relationAppName=="Ponderacion"){
            //dd($relationAppName);
            $relatedObjList = $relationAppArray['app']::where('id', '>', 2)->pluck($relationAppArray['relation_display_column'], 'id');
            //dd($relatedObjList);
          }
          if($relationAppName=="Empresa"){
            //dd($relationAppName);
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)->pluck($relationAppArray['relation_display_column'], 'id');
              
            //dd($relatedObjList);
          }
          /*if($relationAppName=="StCliente"){
            $v=DB::table('params')->where('llave','=', 'st_cliente_final')->first();
            $relatedObjList = $relationAppArray['app']::whereNotIn('id', [$v->valor])->pluck($relationAppArray['relation_display_column'], 'id');
              
            //dd($relatedObjList);
          }*/

          /*if($relationAppName=="Lectivo"){
            //dd($relationAppName);
            $fecha=date('Y-m-d');
            $relatedObjList = $relationAppArray['app']::where('inicio', '<=', $fecha)
                                                      ->where('fin', '>=', $fecha)
                                                      ->pluck($relationAppArray['relation_display_column'], 'id');
            
          }*/

          /*
          if($relationAppName=="Especialidad" and Auth::user()->can('IfiltroEspecialidadsXPlantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'especialidads.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, especialidads.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Especialidad"){
            //dd("fil");
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'especialidads.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",p.cve_plantel, "-",razon) as relacion, especialidads.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'nivels.id');
            //dd($relatedObjList);
          }
          if($relationAppName=="Nivel" and Auth::user()->can('IfiltroNivelXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'nivels.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, nivels.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Nivel"){
            //dd("fil");
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'nivels.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",p.cve_plantel, "-",razon) as relacion, nivels.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'nivels.id');
            //dd($relatedObjList);
          }
          
          if($relationAppName=="Grado" and Auth::user()->can('IfiltroGradoXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'grados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, grados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'grados.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Grado"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'grados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel,"-",razon) as relacion, grados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'grados.id');
          }
          
          if($relationAppName=="Curso" and Auth::user()->can('IfiltroCursoXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'cursos.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, cursos.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'cursos.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Curso"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'cursos.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, cursos.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'cursos.id');
          }
          if($relationAppName=="Subcurso" and Auth::user()->can('IfiltroSubcursoXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'subcursos.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subcursos.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subcursos.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Subcurso"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'subcursos.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subcursos.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subcursos.id');
          }
          if($relationAppName=="Diplomado" and Auth::user()->can('IfiltroDiplomadoXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'diplomados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, diplomados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'diplomados.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Diplomado"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'diplomados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, diplomados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'diplomados.id');
          }
          if($relationAppName=="Subdiplomado" and Auth::user()->can('IfiltroSubdiplomadoXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'subdiplomados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subdiplomados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subdiplomados.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Subdiplomado"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'subdiplomados.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subdiplomados.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subdiplomados.id');
          }

          if($relationAppName=="Otro" and Auth::user()->can('IfiltroOtroXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'otros.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, otros.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'otros.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Otro"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'otros.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, otros.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'otros.id');
          }
          if($relationAppName=="Subotro" and Auth::user()->can('IfiltroSubotroXplantel')){
            $relatedObjList = $relationAppArray['app']::where('plantel_id', '=', $e->plantel_id)
                                                      ->join('plantels as p', 'p.id', '=', 'subotros.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subotros.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subotros.id');
            //dd($relatedObjList);
          }elseif($relationAppName=="Subotro"){
            $relatedObjList = $relationAppArray['app']::join('plantels as p', 'p.id', '=', 'subotros.plantel_id')
                                                      ->select(DB::raw('concat(name, "-",cve_plantel, "-",razon) as relacion, subotros.id'))
                                                      ->orderBy('p.id')
                                                      ->pluck('relacion', 'subotros.id');
          }
          //$relatedObjList = $relationAppArray['app']::pluck($relationAppArray['relation_display_column'], 'id');
    			*/
          //dd($opt0);
          $reverse=$relatedObjList->reverse(); 
          
          $reverse->put(0,'Seleccionar Opción');
          //dd($reverse->reverse());
          //$relatedObjList
          $list[$relationAppName] = $reverse->reverse(); 
          //dd($list[$relationAppName]);
    		}
        }
		return $list;
    }
}