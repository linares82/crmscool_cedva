@extends('plantillas.admin_template')

@include('materias._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('materias.index') }}">@yield('materiasAppTitle')</a></li>
    <li class="active">{{ $materium->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('materiasAppTitle') / Mostrar {{$materium->id}}

            {!! Form::model($materium, array('route' => array('materias.destroy', $materium->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('materium.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('materias.edit', $materium->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('materium.destroy')
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
                    <p class="form-control-static">{{$materium->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="name">MATERIA</label>
                     <p class="form-control-static">{{$materium->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="abreviatura">ABREVIATURA</label>
                     <p class="form-control-static">{{$materium->abreviatura}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="seriada_bnd">SERIADA</label>
                     <p class="form-control-static">{{$materium->seriada_bnd}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="serie_anterior">SERIE_ANTERIOR</label>
                     <p class="form-control-static">{{$materium->serie_anterior}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="plantel_razon">PLANTEL_RAZON</label>
                     <p class="form-control-static">{{$materium->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$materium->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$materium->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('materias.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection