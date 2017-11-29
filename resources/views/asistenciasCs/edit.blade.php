@extends('plantillas.admin_template')

@include('asistenciasCs._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('asistenciasCs.index') }}">@yield('asistenciasCsAppTitle')</a></li>
	    <li><a href="{{ route('asistenciasCs.show', $asistenciasC->id) }}">{{ $asistenciasC->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('asistenciasCsAppTitle') / Editar {{$asistenciasC->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($asistenciasC, array('route' => array('asistenciasCs.update', $asistenciasC->id),'method' => 'post', 'id'=>'frm_asistencias_c')) !!}

@include('asistenciasCs._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('asistenciasCs.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection