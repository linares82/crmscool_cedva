@extends('plantillas.admin_template')

@include('preguntas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('preguntas.index') }}">@yield('preguntasAppTitle')</a></li>
    <li class="active">{{ $preguntum->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('preguntasAppTitle') / Mostrar {{$preguntum->id}}

            {!! Form::model($preguntum, array('route' => array('preguntas.destroy', $preguntum->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('preguntum.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('preguntas.edit', $preguntum->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('preguntum.destroy')
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
                    <p class="form-control-static">{{$preguntum->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">PREGUNTA</label>
                     <p class="form-control-static">{{$preguntum->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$preguntum->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$preguntum->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('preguntas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection