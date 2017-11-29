@extends('plantillas.admin_template')

@include('apples._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('apples.index') }}">@yield('applesAppTitle')</a></li>
    <li class="active">{{ $apple->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('applesAppTitle') / Mostrar {{$apple->id}}

            {!! Form::model($apple, array('route' => array('apples.destroy', $apple->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('apples.edit', $apple->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
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
                    <p class="form-control-static">{{$apple->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">NAME</label>
                     <p class="form-control-static">{{$apple->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="apple_type_id">APPLE_TYPE_ID</label>
                     <p class="form-control-static">{{$apple->apple_type_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('apples.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection