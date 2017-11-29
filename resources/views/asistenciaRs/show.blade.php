@extends('plantillas.admin_template')

@include('asistenciaRs._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('asistenciaRs.index') }}">@yield('asistenciaRsAppTitle')</a></li>
    <li class="active">{{ $asistenciaR->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('asistenciaRsAppTitle') / Mostrar {{$asistenciaR->id}}

            {!! Form::model($asistenciaR, array('route' => array('asistenciaRs.destroy', $asistenciaR->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('asistenciaR.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('asistenciaRs.edit', $asistenciaR->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('asistenciaR.destroy')
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
                    <p class="form-control-static">{{$asistenciaR->id}}</p>
                </div>
                <div class="form-group">
                     <label for="asistencias_c_id">ASISTENCIAS_C_ID</label>
                     <p class="form-control-static">{{$asistenciaR->asistencias_c_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="fecha">FECHA</label>
                     <p class="form-control-static">{{$asistenciaR->fecha}}</p>
                </div>
                    <div class="form-group">
                     <label for="cliente_id">CLIENTE_ID</label>
                     <p class="form-control-static">{{$asistenciaR->cliente_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="est_asistencia_id">EST_ASISTENCIA_ID</label>
                     <p class="form-control-static">{{$asistenciaR->est_asistencia_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$asistenciaR->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$asistenciaR->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('asistenciaRs.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection