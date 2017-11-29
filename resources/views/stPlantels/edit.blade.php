@extends('plantillas.admin_template')

@include('stPlantels._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('stPlantels.index') }}">@yield('stPlantelsAppTitle')</a></li>
	    <li><a href="{{ route('stPlantels.show', $stPlantel->id) }}">{{ $stPlantel->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('stPlantelsAppTitle') / Editar {{$stPlantel->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($stPlantel, array('route' => array('stPlantels.update', $stPlantel->id),'method' => 'post')) !!}

@include('stPlantels._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('stPlantels.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection