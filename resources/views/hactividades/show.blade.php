@extends('plantillas.admin_template')

@include('hactividades._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('hactividades.index') }}">@yield('hactividadesAppTitle')</a></li>
    <li class="active">{{ $hactividade->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('hactividadesAppTitle') / Mostrar {{$hactividade->id}}

            {!! Form::model($hactividade, array('route' => array('hactividades.destroy', $hactividade->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('hactividade.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('hactividades.edit', $hactividade->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('hactividade.destroy')
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
                    <p class="form-control-static">{{$hactividade->id}}</p>
                </div>
                <div class="form-group">
                     <label for="tarea">TAREA</label>
                     <p class="form-control-static">{{$hactividade->tarea}}</p>
                </div>
                    <div class="form-group">
                     <label for="fecha">FECHA</label>
                     <p class="form-control-static">{{$hactividade->fecha}}</p>
                </div>
                    <div class="form-group">
                     <label for="hora">HORA</label>
                     <p class="form-control-static">{{$hactividade->hora}}</p>
                </div>
                    <div class="form-group">
                     <label for="asunto">ASUNTO</label>
                     <p class="form-control-static">{{$hactividade->asunto}}</p>
                </div>
                    <div class="form-group">
                     <label for="detalle">DETALLE</label>
                     <p class="form-control-static">{{$hactividade->detalle}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$hactividade->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$hactividade->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('hactividades.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection