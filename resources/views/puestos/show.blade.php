@extends('plantillas.admin_template')

@include('puestos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('puestos.index') }}">@yield('puestosAppTitle')</a></li>
    <li class="active">{{ $puesto->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('puestosAppTitle') / Mostrar {{$puesto->id}}

            {!! Form::model($puesto, array('route' => array('puestos.destroy', $puesto->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('puesto.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('puestos.edit', $puesto->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('puesto.destroy')
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
                    <p class="form-control-static">{{$puesto->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">PUESTO</label>
                     <p class="form-control-static">{{$puesto->name}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$puesto->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{$puesto->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('puestos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection