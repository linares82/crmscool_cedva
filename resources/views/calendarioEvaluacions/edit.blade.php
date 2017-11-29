@extends('plantillas.admin_template')

@include('calendarioEvaluacions._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('calendarioEvaluacions.index') }}">@yield('calendarioEvaluacionsAppTitle')</a></li>
	    <li><a href="{{ route('calendarioEvaluacions.show', $calendarioEvaluacion->id) }}">{{ $calendarioEvaluacion->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('calendarioEvaluacionsAppTitle') / Editar {{$calendarioEvaluacion->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($calendarioEvaluacion, array('route' => array('calendarioEvaluacions.update', $calendarioEvaluacion->id),'method' => 'post')) !!}

@include('calendarioEvaluacions._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('calendarioEvaluacions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection