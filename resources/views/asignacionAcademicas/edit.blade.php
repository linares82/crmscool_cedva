@extends('plantillas.admin_template')

@include('asignacionAcademicas._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('asignacionAcademicas.index') }}">@yield('asignacionAcademicasAppTitle')</a></li>
	    <li><a href="{{ route('asignacionAcademicas.show', $asignacionAcademica->id) }}">{{ $asignacionAcademica->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('asignacionAcademicasAppTitle') / Editar {{$asignacionAcademica->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($asignacionAcademica, array('route' => array('asignacionAcademicas.update', $asignacionAcademica->id),'method' => 'post', 'id'=>'frm_asignacion_academica')) !!}

@include('asignacionAcademicas._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('asignacionAcademicas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection