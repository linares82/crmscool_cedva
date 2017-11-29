<?php

/**
Copyright (c) 2016 dog-ears

This software is released under the MIT License.
http://dog-ears.net/
*/

namespace App\Traits;

use App\Http\Requests;
use Illuminate\Http\Request;
use dogears\CrudDscaffold\Traits\NameSolverTrait;
use App\Empleado;
use Auth;

trait GetAllDataTrait {

    use NameSolverTrait;

    /**
     * Get all data with condition formated like ransack
     *
     * @param  string $request, integer $paginate
     * @return LengthAwarePaginator Class
     */

    public static function getAllData( Request $request, $paginate=20 ){

        $myObj = new self;
        $myQuery = $myObj;

        $names = explode('\\', get_class($myObj) );
        $baseTable = $myObj->solveName( end($names), config('CrudDscaffold.app_name_rules.app_migrate_tablename') );    //ex).apples
        if($baseTable=='est_asistencia'){
           $baseTable=$baseTable.'s';
        }
        
        //(i) join relation table

        if( is_array( $myObj->relationApps ) ){

            foreach( $myObj->relationApps as $className => $classObj ){
    
                $relationTable = $myObj->solveName( $className, config('CrudDscaffold.app_name_rules.app_migrate_tablename') );    //ex).apple_types
                $relationColumnInBaseTable = $myObj->solveName( $className, config('CrudDscaffold.app_name_rules.name_name') ).'_id';    //ex).apple_type_id

                $myQuery = $myQuery->leftJoin( $relationTable, $baseTable.'.'.$relationColumnInBaseTable, '=', $relationTable.'.id' );  //ex).leftJoin( 'apple_types', 'apples.apple_type_id', '=', 'apple_types.id' )
                
                //Log::error("FLC: ".$relationTable);
                
            }
        }

        //(ii) add Constrain

        if( is_array($request->input('q')) ){

            foreach( $request->input('q') as $key => $value){
    
                //skip s value that is for ordering
                if( $key === 's' ){ continue; }

                //skip if value is blank
                if( $value === '' ){ continue; }
                //dd($request);
                if( preg_match('#(.*)_([^_]*?)$#', $key, $m) ){
                    $column = $m[1];
                    $operator = $m[2];
                }else{
                    abort(500, 'query parameter has wrong value');
                }

                //if column is not relation table's column, add base table name at head.
                if( strpos($column,'.') === false ){
                    $column = $baseTable.'.'.$column;
                }

                if( $operator === 'cont' ){
                    $myQuery = $myQuery->Where($column, 'LIKE', '%'.$value.'%');
                } elseif( $operator === 'lt' and $value<>0){
                    $myQuery = $myQuery->Where($column, '=', $value);                
                }/*elseif( $operator === 'gt' ){
                    $myQuery = $myQuery->where($column, '>=', $value);                
                }*/
            }
        }

        //(iii) order setting

        if( is_array($request->input('q')) && array_key_exists( 's', $request->input('q')) && $request->input('q')['s'] !== '' ){

            if( preg_match('#(.*)_([^_]*?)$#', $request->input('q')['s'], $m) ){
                $column = $m[1];
                $order_dir = $m[2];

                if( mb_strtoupper($order_dir) !== 'ASC' && mb_strtoupper($order_dir) !== 'DESC' ){
                    //abort(500, 'query parameter q[s] has wrong value');
                    $column = 'id';
                    $order_dir = 'desc';
                }
            }else{
                //abort(500, 'query parameter q[s] has wrong value');
                $column = 'id';
                $order_dir = 'desc';
            }

            //if column is not relation table's column, add base table name at head.
            if( strpos($column,'.') === false ){
                $column = $baseTable.'.'.$column;
            }

        }else{
            $column = $baseTable.'.id';
            $order_dir = 'DESC';
        }
        //dd(Auth::user()->can('IfiltroClientesXPlantel'));
        //dd();
        $empleado=Empleado::where('user_id', '=', Auth::user()->id)->first();
        
        //dd($baseTable);
        switch($baseTable){
            case "clientes":
                if($baseTable=="clientes" and (Auth::user()->can('IfiltroClientesXPlantel'))){
                    $myQuery=$myQuery->where('clientes.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "empleados":
                if($baseTable=="empleados" and Auth::user()->can('IfiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('empleados.plantel_id', '=', $empleado->plantel_id);
                }
                
                break;
            case "grupos":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    //dd("fil");
                    $myQuery=$myQuery->where('grupos.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "materia":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('materia.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "salons":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('salons.plantel_id', '=', $empleado->plantel_id);
                }
                
                break;
            case "periodo_estudios":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('periodo_estudios.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "asignacion_academica":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('asignacion_academicas.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "alumnos":
                if(Auth::user()->can('IFiltroEmpleadosXPlantel')){
                    $myQuery=$myQuery->where('alumnos.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "seguimientos":
                if($baseTable=="seguimientos" and Auth::user()->can('IfiltroClientesXEmpleado')){
                    //dd(Auth::user()->id);
                    $es=Empleado::where('user_id', '=', Auth::user()->id)->get();
                    //dd($es->toArray());
                    $cade="";
                    $cade_a=array();
                    $aux=0;
                    foreach($es as $e){
                        //dd($e->toArray());
                        array_push($cade_a, $e->id);
                        if($aux==0){
                            
                            $cade=$cade.$e->id;
                            $aux=1;
                        }else{
                            $cade=$cade.",".$e->id;
                        }
                    }
                    //dd($cade_a);
                    $myQuery=$myQuery->whereIn('clientes.empleado_id', $cade_a);
                    //dd($myQuery);
                }
                if($baseTable=="seguimientos" and Auth::user()->can('IfiltroClientesXPlantel')){
                    $myQuery=$myQuery->where('clientes.plantel_id', '=', $empleado->plantel_id)
                                     ->where('st_seguimiento_id', '<>', '3');
                }
                break;
            case "pivot_aviso_gral_empleados":
                if($baseTable=="pivot_aviso_gral_empleados" and Auth::user()->can('IfiltroAvisosXempleado')){
                    $myQuery=$myQuery->where('pivot_aviso_gral_empleados.empleado_id', '=', $empleado->id);
                }        
                break;
            case "nivels":
                //dd(Auth::user()->can('IfiltroNivelXplantel'));
                if($baseTable=="nivels" and Auth::user()->can('IfiltroNivelXplantel')){
                    $myQuery=$myQuery->where('nivels.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "calendario_evaluacions":
                if($baseTable=="calendario_evaluacions" ){
                    $myQuery=$myQuery->where('calendario_evaluacions.plantel_id', '=', $empleado->plantel_id);
                }
                break;
            case "asignacion_academicas":
                if(Auth::user()->can('asistenciasRs.create')){
                    $myQuery=$myQuery->where('asignacion_academicas.plantel_id', '=', $empleado->plantel_id)
                                    ->where('empleado_id', '=', $empleado->id);
                }
                break;
            case "subcursos":
                break;
            case "diplomados":
                break;
            case "subdiplomados":
                break;
            case "otros":
                break;
            case "subotros":
                break;
        }
        
        
        
        //dd(Auth::user()->can('IfiltroAvisosXempleado'));
        
        
        $myQuery = $myQuery->orderBy( $column, $order_dir);

        //(iv) get base table data

        $myQuery = $myQuery->select([ $baseTable.'.*' ]);

        //(v) pagenate

        return $myQuery->paginate($paginate);

    }
}