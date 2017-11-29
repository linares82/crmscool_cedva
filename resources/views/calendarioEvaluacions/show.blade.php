@extends('plantillas.admin_template')

@include('calendarioEvaluacions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('calendarioEvaluacions.index') }}">@yield('calendarioEvaluacionsAppTitle')</a></li>
    <li class="active">{{ $calendarioEvaluacion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('calendarioEvaluacionsAppTitle') / Mostrar {{$calendarioEvaluacion->id}}

            {!! Form::model($calendarioEvaluacion, array('route' => array('calendarioEvaluacions.destroy', $calendarioEvaluacion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('calendarioEvaluacion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('calendarioEvaluacions.edit', $calendarioEvaluacion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('calendarioEvaluacion.destroy')
                    <button type="submit" class="btn btn-danger">Borrar <i class="glyphicon glyphicon-trash"></i><
                    /button>
                    @endpermission
                </div>
            {!! Form::close() !!}

        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group col-sm-4">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$calendarioEvaluacion->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="lectivo_name">LECTIVO</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->lectivo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="ponderacion_name">PONDERACION</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->ponderacion->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="carga_ponderacion_name">CARGA PONDERACION</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->cargaPonderacion->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="v_inicio">INICIO</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->v_inicio}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="v_fin">FIN</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->v_fin}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$calendarioEvaluacion->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('calendarioEvaluacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection