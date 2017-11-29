@extends('plantillas.admin_template')

@include('tpoExamens._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('tpoExamens.index') }}">@yield('tpoExamensAppTitle')</a></li>
	    <li><a href="{{ route('tpoExamens.show', $tpoExamen->id) }}">{{ $tpoExamen->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('tpoExamensAppTitle') / Editar {{$tpoExamen->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($tpoExamen, array('route' => array('tpoExamens.update', $tpoExamen->id),'method' => 'post')) !!}

@include('tpoExamens._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('tpoExamens.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection