@extends('plantillas.admin_template')

@include('inscripcions._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('inscripcions.index') }}">@yield('inscripcionsAppTitle')</a></li>
	    <li><a href="{{ route('inscripcions.show', $inscripcion->id) }}">{{ $inscripcion->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('inscripcionsAppTitle') / Editar {{$inscripcion->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($inscripcion, array('route' => array('inscripcions.update', $inscripcion->id),'method' => 'post')) !!}

@include('inscripcions._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('inscripcions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection