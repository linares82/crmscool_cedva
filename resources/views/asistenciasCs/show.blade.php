@extends('plantillas.admin_template')

@include('asistenciasCs._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('asistenciasCs.index') }}">@yield('asistenciasCsAppTitle')</a></li>
    <li class="active">{{ $asistenciasC->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('asistenciasCsAppTitle') / Mostrar {{$asistenciasC->id}}

            {!! Form::model($asistenciasC, array('route' => array('asistenciasCs.destroy', $asistenciasC->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('asistenciasC.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('asistenciasCs.edit', $asistenciasC->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('asistenciasC.destroy')
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
                    <p class="form-control-static">{{$asistenciasC->id}}</p>
                </div>
                <div class="form-group">
                     <label for="empleado_nombre">EMPLEADO_NOMBRE</label>
                     <p class="form-control-static">{{$asistenciasC->empleado->nombre}}</p>
                </div>
                    <div class="form-group">
                     <label for="materia_id">MATERIA_ID</label>
                     <p class="form-control-static">{{$asistenciasC->materia_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="grupo_name">GRUPO_NAME</label>
                     <p class="form-control-static">{{$asistenciasC->grupo->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$asistenciasC->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$asistenciasC->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('asistenciasCs.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection