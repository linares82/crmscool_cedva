@extends('plantillas.admin_template')

@include('asignacionAcademicas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('asignacionAcademicas.index') }}">@yield('asignacionAcademicasAppTitle')</a></li>
    <li class="active">{{ $asignacionAcademica->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('asignacionAcademicasAppTitle') / Mostrar {{$asignacionAcademica->id}}

            {!! Form::model($asignacionAcademica, array('route' => array('asignacionAcademicas.destroy', $asignacionAcademica->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('asignacionAcademica.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('asignacionAcademicas.edit', $asignacionAcademica->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('asignacionAcademica.destroy')
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
                    <p class="form-control-static">{{$asignacionAcademica->id}}</p>
                </div>
                <div class="form-group col-md-4 ">
                     <label for="empleado_nombre">EMPLEADO</label>
                     <p class="form-control-static">{{$asignacionAcademica->empleado}}</p>
                </div>
                    <div class="form-group col-md-4 ">
                     <label for="materia_id">MATERIA</label>
                     <p class="form-control-static">{{$asignacionAcademica->materia->name}}</p>
                </div>
                    <div class="form-group col-md-4 ">
                     <label for="grupo_name">GRUPO</label>
                     <p class="form-control-static">{{$asignacionAcademica->grupo->name}}</p>
                </div>
                    <div class="form-group col-md-4 ">
                     <label for="horas">HORAS</label>
                     <p class="form-control-static">{{$asignacionAcademica->horas}}</p>
                </div>
                    <div class="form-group col-md-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$asignacionAcademica->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-md-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$asignacionAcademica->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('asignacionAcademicas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection