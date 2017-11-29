@extends('plantillas.admin_template')

@include('plantillas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('plantillas.index') }}">@yield('plantillasAppTitle')</a></li>
    <li class="active">{{ $plantilla->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('plantillasAppTitle') / Mostrar {{$plantilla->id}}

            {!! Form::model($plantilla, array('route' => array('plantillas.destroy', $plantilla->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('plantilla.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('plantillas.edit', $plantilla->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('plantilla.destroy')
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
                    <p class="form-control-static">{{$plantilla->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="plantilla">PLANTILLA</label>
                     <p class="form-control-static">{{$plantilla->plantilla}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="st_cliente_id">ST_CLIENTE_ID</label>
                     <p class="form-control-static">{{$plantilla->st_cliente_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="periodo_id">PERIODO_ID</label>
                     <p class="form-control-static">{{$plantilla->periodo_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="dia">DIA</label>
                     <p class="form-control-static">{{$plantilla->dia}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$plantilla->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$plantilla->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('plantillas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection