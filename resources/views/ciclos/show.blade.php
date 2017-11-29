@extends('plantillas.admin_template')

@include('ciclos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('ciclos.index') }}">@yield('ciclosAppTitle')</a></li>
    <li class="active">{{ $ciclo->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('ciclosAppTitle') / Mostrar {{$ciclo->id}}

            {!! Form::model($ciclo, array('route' => array('ciclos.destroy', $ciclo->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('ciclo.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('ciclos.edit', $ciclo->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('ciclo.destroy')
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
                    <p class="form-control-static">{{$ciclo->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="name">CICLO</label>
                     <p class="form-control-static">{{$ciclo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$ciclo->usu_alta->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$ciclo->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('ciclos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection