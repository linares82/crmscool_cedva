@extends('plantillas.admin_template')

@include('seguimientoTareas._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('seguimientoTareas.index') }}">@yield('seguimientoTareasAppTitle')</a></li>
	    <li><a href="{{ route('seguimientoTareas.show', $seguimientoTarea->id) }}">{{ $seguimientoTarea->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('seguimientoTareasAppTitle') / Editar {{$seguimientoTarea->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($seguimientoTarea, array('route' => array('seguimientoTareas.update', $seguimientoTarea->id),'method' => 'post')) !!}

@include('seguimientoTareas._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('seguimientoTareas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection