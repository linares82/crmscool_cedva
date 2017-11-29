@extends('plantillas.admin_template')

@include('cargaPonderacions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('cargaPonderacions.index') }}">@yield('cargaPonderacionsAppTitle')</a></li>
    <li class="active">{{ $cargaPonderacion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('cargaPonderacionsAppTitle') / Mostrar {{$cargaPonderacion->id}}

            {!! Form::model($cargaPonderacion, array('route' => array('cargaPonderacions.destroy', $cargaPonderacion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('cargaPonderacion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('cargaPonderacions.edit', $cargaPonderacion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('cargaPonderacion.destroy')
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
                    <p class="form-control-static">{{$cargaPonderacion->id}}</p>
                </div>
                <div class="form-group">
                     <label for="ponderacion_id">PONDERACION_ID</label>
                     <p class="form-control-static">{{$cargaPonderacion->ponderacion_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$cargaPonderacion->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="porcentaje">PORCENTAJE</label>
                     <p class="form-control-static">{{$cargaPonderacion->porcentaje}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$cargaPonderacion->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$cargaPonderacion->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('cargaPonderacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection