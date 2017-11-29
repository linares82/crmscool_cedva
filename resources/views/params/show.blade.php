@extends('plantillas.admin_template')

@include('params._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('params.index') }}">@yield('paramsAppTitle')</a></li>
    <li class="active">{{ $param->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('paramsAppTitle') / Mostrar {{$param->id}}

            {!! Form::model($param, array('route' => array('params.destroy', $param->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('param.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('params.edit', $param->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('param.destroy')
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
                    <p class="form-control-static">{{$param->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="llave">LLAVE</label>
                     <p class="form-control-static">{{$param->llave}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="valor">VALOR</label>
                     <p class="form-control-static">{{$param->valor}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('params.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection