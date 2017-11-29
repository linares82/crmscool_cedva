@extends('plantillas.admin_template')

@include('stSeguimientos._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('stSeguimientos.index') }}">@yield('stSeguimientosAppTitle')</a></li>
	    <li><a href="{{ route('stSeguimientos.show', $stSeguimiento->id) }}">{{ $stSeguimiento->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('stSeguimientosAppTitle') / Editar {{$stSeguimiento->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($stSeguimiento, array('route' => array('stSeguimientos.update', $stSeguimiento->id),'method' => 'post')) !!}

@include('stSeguimientos._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('stSeguimientos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection