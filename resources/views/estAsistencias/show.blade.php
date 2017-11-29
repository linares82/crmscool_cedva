@extends('plantillas.admin_template')

@include('estAsistencias._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('estAsistencias.index') }}">@yield('estAsistenciasAppTitle')</a></li>
    <li class="active">{{ $estAsistencium->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('estAsistenciasAppTitle') / Mostrar {{$estAsistencium->id}}

            {!! Form::model($estAsistencium, array('route' => array('estAsistencias.destroy', $estAsistencium->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('estAsistencium.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('estAsistencias.edit', $estAsistencium->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('estAsistencium.destroy')
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
                    <p class="form-control-static">{{$estAsistencium->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="est_asistencia">VALOR ASISTENCIA</label>
                     <p class="form-control-static">{{$estAsistencium->est_asistencia}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$estAsistencium->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$estAsistencium->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('estAsistencias.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection