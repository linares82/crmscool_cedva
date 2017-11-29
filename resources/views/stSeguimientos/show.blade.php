@extends('plantillas.admin_template')

@include('stSeguimientos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('stSeguimientos.index') }}">@yield('stSeguimientosAppTitle')</a></li>
    <li class="active">{{ $stSeguimiento->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('stSeguimientosAppTitle') / Mostrar {{$stSeguimiento->id}}

            {!! Form::model($stSeguimiento, array('route' => array('stSeguimientos.destroy', $stSeguimiento->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('stSeguimiento.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('stSeguimientos.edit', $stSeguimiento->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('stSeguimiento.destroy')
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
                    <p class="form-control-static">{{$stSeguimiento->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">ESTATUS</label>
                     <p class="form-control-static">{{$stSeguimiento->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$stSeguimiento->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$stSeguimiento->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('stSeguimientos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection