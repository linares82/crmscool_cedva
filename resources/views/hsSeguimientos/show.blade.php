@extends('plantillas.admin_template')

@include('hsSeguimientos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('hsSeguimientos.index') }}">@yield('hsSeguimientosAppTitle')</a></li>
    <li class="active">{{ $hsSeguimiento->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('hsSeguimientosAppTitle') / Mostrar {{$hsSeguimiento->id}}

            {!! Form::model($hsSeguimiento, array('route' => array('hsSeguimientos.destroy', $hsSeguimiento->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('hsSeguimiento.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('hsSeguimientos.edit', $hsSeguimiento->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('hsSeguimiento.destroy')
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
                    <p class="form-control-static">{{$hsSeguimiento->id}}</p>
                </div>
                <div class="form-group">
                     <label for="seguimiento_id">SEGUIMIENTO_ID</label>
                     <p class="form-control-static">{{$hsSeguimiento->seguimiento_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="cliente_id">CLIENTE_ID</label>
                     <p class="form-control-static">{{$hsSeguimiento->cliente_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="st_seguimiento_id">ST_SEGUIMIENTO_ID</label>
                     <p class="form-control-static">{{$hsSeguimiento->st_seguimiento_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="mes">MES</label>
                     <p class="form-control-static">{{$hsSeguimiento->mes}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$hsSeguimiento->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$hsSeguimiento->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('hsSeguimientos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection