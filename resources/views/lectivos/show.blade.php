@extends('plantillas.admin_template')

@include('lectivos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('lectivos.index') }}">@yield('lectivosAppTitle')</a></li>
    <li class="active">{{ $lectivo->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('lectivosAppTitle') / Mostrar {{$lectivo->id}}

            {!! Form::model($lectivo, array('route' => array('lectivos.destroy', $lectivo->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('lectivos.edit', $lectivo->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <button type="submit" class="btn btn-danger">Borrar <i class="glyphicon glyphicon-trash"></i></button>
                </div>
            {!! Form::close() !!}

        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$lectivo->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$lectivo->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="activo">ACTIVO</label>
                     <p class="form-control-static">{{$lectivo->activo}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="inicio">Inicio</label>
                     <p class="form-control-static">{{$lectivo->inicio}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="fin">FIN</label>
                     <p class="form-control-static">{{$lectivo->fin}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$lectivo->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{$lectivo->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('lectivos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection