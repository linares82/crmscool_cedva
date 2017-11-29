@extends('plantillas.admin_template')

@include('estAsistencias._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('estAsistencias.index') }}">@yield('estAsistenciasAppTitle')</a></li>
	    <li><a href="{{ route('estAsistencias.show', $estAsistencium->id) }}">{{ $estAsistencium->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('estAsistenciasAppTitle') / Editar {{$estAsistencium->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($estAsistencium, array('route' => array('estAsistencias.update', $estAsistencium->id),'method' => 'post')) !!}

@include('estAsistencias._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('estAsistencias.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection