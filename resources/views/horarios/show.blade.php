@extends('plantillas.admin_template')

@include('horarios._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('horarios.index') }}">@yield('horariosAppTitle')</a></li>
    <li class="active">{{ $horario->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('horariosAppTitle') / Mostrar {{$horario->id}}

            {!! Form::model($horario, array('route' => array('horarios.destroy', $horario->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('horario.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('horarios.edit', $horario->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('horario.destroy')
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
                    <p class="form-control-static">{{$horario->id}}</p>
                </div>
                <div class="form-group">
                     <label for="asignacion_academica_id">ASIGNACION_ACADEMICA_ID</label>
                     <p class="form-control-static">{{$horario->asignacion_academica_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="dia_id">DIA_ID</label>
                     <p class="form-control-static">{{$horario->dia_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="hora">HORA</label>
                     <p class="form-control-static">{{$horario->hora}}</p>
                </div>
                    <div class="form-group">
                     <label for="duracion_clase">DURACION_CLASE</label>
                     <p class="form-control-static">{{$horario->duracion_clase}}</p>
                </div>
                    <div class="form-group">
                     <label for="lectivo_name">LECTIVO_NAME</label>
                     <p class="form-control-static">{{$horario->lectivo->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$horario->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$horario->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('horarios.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection