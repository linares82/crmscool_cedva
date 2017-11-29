@extends('plantillas.admin_template')

@include('calificacionPonderacions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('calificacionPonderacions.index') }}">@yield('calificacionPonderacionsAppTitle')</a></li>
    <li class="active">{{ $calificacionPonderacion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('calificacionPonderacionsAppTitle') / Mostrar {{$calificacionPonderacion->id}}

            {!! Form::model($calificacionPonderacion, array('route' => array('calificacionPonderacions.destroy', $calificacionPonderacion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('calificacionPonderacion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('calificacionPonderacions.edit', $calificacionPonderacion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('calificacionPonderacion.destroy')
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
                    <p class="form-control-static">{{$calificacionPonderacion->id}}</p>
                </div>
                <div class="form-group">
                     <label for="calificacion_id">CALIFICACION_ID</label>
                     <p class="form-control-static">{{$calificacionPonderacion->calificacion_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="ponderacion_id">PONDERACION_ID</label>
                     <p class="form-control-static">{{$calificacionPonderacion->ponderacion_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="calificacion_parcial">CALIFICACION_PARCIAL</label>
                     <p class="form-control-static">{{$calificacionPonderacion->calificacion_parcial}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$calificacionPonderacion->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$calificacionPonderacion->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('calificacionPonderacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection