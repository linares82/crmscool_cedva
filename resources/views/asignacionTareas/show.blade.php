@extends('plantillas.admin_template')

@include('asignacionTareas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('asignacionTareas.index') }}">@yield('asignacionTareasAppTitle')</a></li>
    <li class="active">{{ $asignacionTarea->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('asignacionTareasAppTitle') / Mostrar {{$asignacionTarea->id}}

            {!! Form::model($asignacionTarea, array('route' => array('asignacionTareas.destroy', $asignacionTarea->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('asignacionTarea.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('asignacionTareas.edit', $asignacionTarea->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('asignacionTarea.destroy')
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
                    <p class="form-control-static">{{$asignacionTarea->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="cliente_id">CLIENTE</label>
                     <p class="form-control-static">{{$asignacionTarea->cliente->nombre}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="empleado_id">EMPLEADO</label>
                     <p class="form-control-static">{{$asignacionTarea->empleado->nombre}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="tarea_name">TAREA</label>
                     <p class="form-control-static">{{$asignacionTarea->tarea->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="asunto">ASUNTO</label>
                     <p class="form-control-static">{{$asignacionTarea->asunto->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="detalle">DETALLE</label>
                     <p class="form-control-static">{{$asignacionTarea->detalle}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="estatus_id">ESTATUS</label>
                     <p class="form-control-static">{{$asignacionTarea->stTarea->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="observaciones">OBSERVACIONES</label>
                     <p class="form-control-static">{{$asignacionTarea->observaciones}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$asignacionTarea->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$asignacionTarea->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('asignacionTareas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection