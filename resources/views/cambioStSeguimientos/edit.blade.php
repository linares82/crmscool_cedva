@extends('plantillas.admin_template')

@include('cambioStSeguimientos._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('cambioStSeguimientos.index') }}">@yield('cambioStSeguimientosAppTitle')</a></li>
	    <li><a href="{{ route('cambioStSeguimientos.show', $cambioStSeguimiento->id) }}">{{ $cambioStSeguimiento->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('cambioStSeguimientosAppTitle') / Editar {{$cambioStSeguimiento->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($cambioStSeguimiento, array('route' => array('cambioStSeguimientos.update', $cambioStSeguimiento->id),'method' => 'post')) !!}

@include('cambioStSeguimientos._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('cambioStSeguimientos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection