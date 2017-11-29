@extends('plantillas.admin_template')

@include('preguntaClientes._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('preguntaClientes.index') }}">@yield('preguntaClientesAppTitle')</a></li>
	    <li><a href="{{ route('preguntaClientes.show', $preguntaCliente->id) }}">{{ $preguntaCliente->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('preguntaClientesAppTitle') / Editar {{$preguntaCliente->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($preguntaCliente, array('route' => array('preguntaClientes.update', $preguntaCliente->id),'method' => 'post')) !!}

@include('preguntaClientes._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('preguntaClientes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection