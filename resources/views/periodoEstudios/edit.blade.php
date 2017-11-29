@extends('plantillas.admin_template')

@include('periodoEstudios._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('periodoEstudios.index') }}">@yield('periodoEstudiosAppTitle')</a></li>
	    <li><a href="{{ route('periodoEstudios.show', $periodoEstudio->id) }}">{{ $periodoEstudio->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('periodoEstudiosAppTitle') / Editar {{$periodoEstudio->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($periodoEstudio, array('route' => array('periodoEstudios.update', $periodoEstudio->id),'method' => 'post')) !!}

@include('periodoEstudios._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('periodoEstudios.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection