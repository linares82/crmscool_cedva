@extends('plantillas.admin_template')

@include('clientes._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('clientes.index') }}">@yield('clientesAppTitle')</a></li>
	    <li><a href="{{ route('clientes.show', $cliente->id) }}">{{ $cliente->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('clientesAppTitle') / Editar {{$cliente->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($cliente, array('route' => array('clientes.update', $cliente->id),'method' => 'post', 'id'=>'frm_cliente')) !!}

@include('clientes._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-md btn-warning" href="{{ route('seguimientos.show', $cliente->id) }}"><i class="glyphicon glyphicon-new-window"></i> Seguimiento </a>
                    <a class="btn btn-link pull-right" href="{{ route('clientes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
                
            {!! Form::close() !!}

        </div>
    </div>
@endsection