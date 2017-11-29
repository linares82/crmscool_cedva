@extends('plantillas.admin_template')

@include('calificacions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('calificacions.index') }}">@yield('calificacionsAppTitle')</a></li>
    <li class="active">{{ $calificacion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('calificacionsAppTitle') / Mostrar {{$calificacion->id}}

            {!! Form::model($calificacion, array('route' => array('calificacions.destroy', $calificacion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('calificacion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('calificacions.edit', $calificacion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('calificacion.destroy')
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
                    <p class="form-control-static">{{$calificacion->id}}</p>
                </div>
                <div class="form-group">
                     <label for="hacademica_id">HACADEMICA_ID</label>
                     <p class="form-control-static">{{$calificacion->hacademica_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="examen_id">EXAMEN_ID</label>
                     <p class="form-control-static">{{$calificacion->examen_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="calificacion">CALIFICACION</label>
                     <p class="form-control-static">{{$calificacion->calificacion}}</p>
                </div>
                    <div class="form-group">
                     <label for="fecha">FECHA</label>
                     <p class="form-control-static">{{$calificacion->fecha}}</p>
                </div>
                    <div class="form-group">
                     <label for="reporte_bnd">REPORTE_BND</label>
                     <p class="form-control-static">{{$calificacion->reporte_bnd}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$calificacion->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$calificacion->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('calificacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection