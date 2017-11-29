@extends('plantillas.admin_template')

@include('calificacionPonderacions._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('calificacionPonderacions.index') }}">@yield('calificacionPonderacionsAppTitle')</a></li>
	    <li><a href="{{ route('calificacionPonderacions.show', $calificacionPonderacion->id) }}">{{ $calificacionPonderacion->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('calificacionPonderacionsAppTitle') / Editar {{$calificacionPonderacion->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($calificacionPonderacion, array('route' => array('calificacionPonderacions.update', $calificacionPonderacion->id),'method' => 'post')) !!}

@include('calificacionPonderacions._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('calificacionPonderacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection