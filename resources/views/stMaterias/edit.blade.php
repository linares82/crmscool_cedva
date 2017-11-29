@extends('plantillas.admin_template')

@include('stMaterias._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('stMaterias.index') }}">@yield('stMateriasAppTitle')</a></li>
	    <li><a href="{{ route('stMaterias.show', $stMateria->id) }}">{{ $stMateria->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('stMateriasAppTitle') / Editar {{$stMateria->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($stMateria, array('route' => array('stMaterias.update', $stMateria->id),'method' => 'post')) !!}

@include('stMaterias._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('stMaterias.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection