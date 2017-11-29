@extends('plantillas.admin_template')

@include('subdiplomados._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('subdiplomados.index') }}">@yield('subdiplomadosAppTitle')</a></li>
	    <li><a href="{{ route('subdiplomados.show', $subdiplomado->id) }}">{{ $subdiplomado->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('subdiplomadosAppTitle') / Editar {{$subdiplomado->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($subdiplomado, array('route' => array('subdiplomados.update', $subdiplomado->id),'method' => 'post')) !!}

@include('subdiplomados._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('subdiplomados.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection