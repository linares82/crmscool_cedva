@extends('plantillas.admin_template')

@include('tpoCorreos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('tpoCorreos.index') }}">@yield('tpoCorreosAppTitle')</a></li>
    <li class="active">{{ $tpoCorreo->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('tpoCorreosAppTitle') / Mostrar {{$tpoCorreo->id}}

            {!! Form::model($tpoCorreo, array('route' => array('tpoCorreos.destroy', $tpoCorreo->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('tpoCorreo.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('tpoCorreos.edit', $tpoCorreo->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('tpoCorreo.destroy')
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
                    <p class="form-control-static">{{$tpoCorreo->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$tpoCorreo->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$tpoCorreo->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$tpoCorreo->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('tpoCorreos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection