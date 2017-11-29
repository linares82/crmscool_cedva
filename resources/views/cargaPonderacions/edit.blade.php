@extends('plantillas.admin_template')

@include('cargaPonderacions._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('cargaPonderacions.index') }}">@yield('cargaPonderacionsAppTitle')</a></li>
	    <li><a href="{{ route('cargaPonderacions.show', $cargaPonderacion->id) }}">{{ $cargaPonderacion->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('cargaPonderacionsAppTitle') / Editar {{$cargaPonderacion->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($cargaPonderacion, array('route' => array('cargaPonderacions.update', $cargaPonderacion->id),'method' => 'post')) !!}

@include('cargaPonderacions._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('cargaPonderacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection