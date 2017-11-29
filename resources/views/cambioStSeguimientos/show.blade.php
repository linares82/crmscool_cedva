@extends('plantillas.admin_template')

@include('cambioStSeguimientos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('cambioStSeguimientos.index') }}">@yield('cambioStSeguimientosAppTitle')</a></li>
    <li class="active">{{ $cambioStSeguimiento->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('cambioStSeguimientosAppTitle') / Mostrar {{$cambioStSeguimiento->id}}

            {!! Form::model($cambioStSeguimiento, array('route' => array('cambioStSeguimientos.destroy', $cambioStSeguimiento->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('cambioStSeguimiento.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('cambioStSeguimientos.edit', $cambioStSeguimiento->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('cambioStSeguimiento.destroy')
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
                    <p class="form-control-static">{{$cambioStSeguimiento->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="estatus_id">ESTATUS_ID</label>
                     <p class="form-control-static">{{$cambioStSeguimiento->estatus_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="fecha">FECHA</label>
                     <p class="form-control-static">{{$cambioStSeguimiento->fecha}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$cambioStSeguimiento->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$cambioStSeguimiento->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('cambioStSeguimientos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection