@extends('plantillas.admin_template')

@include('seguimientoTareas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('seguimientoTareas.index') }}">@yield('seguimientoTareasAppTitle')</a></li>
    <li class="active">{{ $seguimientoTarea->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('seguimientoTareasAppTitle') / Mostrar {{$seguimientoTarea->id}}

            {!! Form::model($seguimientoTarea, array('route' => array('seguimientoTareas.destroy', $seguimientoTarea->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('seguimientoTarea.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('seguimientoTareas.edit', $seguimientoTarea->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('seguimientoTarea.destroy')
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
                    <p class="form-control-static">{{$seguimientoTarea->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="asignacion_tarea_id">ASIGNACION_TAREA_ID</label>
                     <p class="form-control-static">{{$seguimientoTarea->asignacion_tarea_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="estatus_id">ESTATUS_ID</label>
                     <p class="form-control-static">{{$seguimientoTarea->estatus_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="detalle">DETALLE</label>
                     <p class="form-control-static">{{$seguimientoTarea->detalle}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$seguimientoTarea->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$seguimientoTarea->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('seguimientoTareas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection