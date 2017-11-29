@extends('plantillas.admin_template')

@include('correos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('correos.index') }}">@yield('correosAppTitle')</a></li>
    <li class="active">{{ $correo->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('correosAppTitle') / Mostrar {{$correo->id}}

            {!! Form::model($correo, array('route' => array('correos.destroy', $correo->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('correo.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('correos.edit', $correo->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('correo.destroy')
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
                    <p class="form-control-static">{{$correo->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="usu_envio_id">USU_ENVIO_ID</label>
                     <p class="form-control-static">{{$correo->usu_envio_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="cliente_id">CLIENTE_ID</label>
                     <p class="form-control-static">{{$correo->cliente_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="fecha_envio">FECHA_ENVIO</label>
                     <p class="form-control-static">{{$correo->fecha_envio}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$correo->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$correo->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('correos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection