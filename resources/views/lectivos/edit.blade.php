@extends('plantillas.admin_template')

@include('lectivos._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('lectivos.index') }}">@yield('lectivosAppTitle')</a></li>
	    <li><a href="{{ route('lectivos.show', $lectivo->id) }}">{{ $lectivo->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>



    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('lectivosAppTitle') / Editar {{$lectivo->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($lectivo, array('route' => array('lectivos.update', $lectivo->id),'method' => 'post')) !!}

@include('lectivos._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('lectivos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection