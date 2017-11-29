@extends('plantillas.admin_template')

@include('promocions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('promocions.index') }}">@yield('promocionsAppTitle')</a></li>
    <li class="active">{{ $promocion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('promocionsAppTitle') / Mostrar {{$promocion->id}}

            {!! Form::model($promocion, array('route' => array('promocions.destroy', $promocion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('promocion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('promocions.edit', $promocion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('promocion.destroy')
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
                    <p class="form-control-static">{{$promocion->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">PROMOCION</label>
                     <p class="form-control-static">{{$promocion->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="inicio">INICIO</label>
                     <p class="form-control-static">{{$promocion->inicio}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="fin">FIN</label>
                     <p class="form-control-static">{{$promocion->fin}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="activa">ACTIVA</label>
                     <p class="form-control-static">{{$promocion->activa}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$promocion->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$promocion->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('promocions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection