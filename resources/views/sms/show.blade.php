@extends('plantillas.admin_template')

@include('sms._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('sms.index') }}">@yield('smsAppTitle')</a></li>
    <li class="active">{{ $sm->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('smsAppTitle') / Mostrar {{$sm->id}}

            {!! Form::model($sm, array('route' => array('sms.destroy', $sm->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('sm.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('sms.edit', $sm->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('sm.destroy')
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
                    <p class="form-control-static">{{$sm->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="usu_envio_id">USU_ENVIO_ID</label>
                     <p class="form-control-static">{{$sm->usu_envio_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="cliente_id">CLIENTE_ID</label>
                     <p class="form-control-static">{{$sm->cliente_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="fecha_envio">FECHA_ENVIO</label>
                     <p class="form-control-static">{{$sm->fecha_envio}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$sm->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$sm->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('sms.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection