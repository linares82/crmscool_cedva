@extends('plantillas.admin_template')

@include('docAlumnos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('docAlumnos.index') }}">@yield('docAlumnosAppTitle')</a></li>
    <li class="active">{{ $docAlumno->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('docAlumnosAppTitle') / Mostrar {{$docAlumno->id}}

            {!! Form::model($docAlumno, array('route' => array('docAlumnos.destroy', $docAlumno->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('docAlumno.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('docAlumnos.edit', $docAlumno->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('docAlumno.destroy')
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
                    <p class="form-control-static">{{$docAlumno->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="name">DOCUMENTO</label>
                     <p class="form-control-static">{{$docAlumno->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="doc_obligatorio">OBLIGATORIO</label>
                     <p class="form-control-static">{{$docAlumno->doc_obligatorio}}</p>
                </div>
                    
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$docAlumno->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$docAlumno->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('docAlumnos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection