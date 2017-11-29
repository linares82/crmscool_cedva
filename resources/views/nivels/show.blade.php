@extends('plantillas.admin_template')

@include('nivels._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('nivels.index') }}">@yield('nivelsAppTitle')</a></li>
    <li class="active">{{ $nivel->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('nivelsAppTitle') / Mostrar {{$nivel->id}}

            {!! Form::model($nivel, array('route' => array('nivels.destroy', $nivel->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('nivel.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('nivels.edit', $nivel->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('nivel.destroy')
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
                    <p class="form-control-static">{{$nivel->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">NIVEL</label>
                     <p class="form-control-static">{{$nivel->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USUARIO ALTA</label>
                     <p class="form-control-static">{{$nivel->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{$nivel->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('nivels.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection