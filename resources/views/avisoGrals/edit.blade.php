@extends('plantillas.admin_template')

@include('avisoGrals._common')

@section('header')

	<ol class="breadcrumb">
	    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('avisoGrals.index') }}">@yield('avisoGralsAppTitle')</a></li>
	    <li><a href="{{ route('avisoGrals.show', $avisoGral->id) }}">{{ $avisoGral->id }}</a></li>
	    <li class="active">Editar</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-edit"></i> @yield('avisoGralsAppTitle') / Editar {{$avisoGral->id}}</h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::model($avisoGral, array('route' => array('avisoGrals.update', $avisoGral->id),'method' => 'post', 'id'=>'frm_avisos')) !!}

@include('avisoGrals._form')

                <div class="row">
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a class="btn btn-link pull-right" href="{{ route('avisoGrals.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection