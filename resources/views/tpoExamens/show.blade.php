@extends('plantillas.admin_template')

@include('tpoExamens._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('tpoExamens.index') }}">@yield('tpoExamensAppTitle')</a></li>
    <li class="active">{{ $tpoExamen->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('tpoExamensAppTitle') / Mostrar {{$tpoExamen->id}}

            {!! Form::model($tpoExamen, array('route' => array('tpoExamens.destroy', $tpoExamen->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('tpoExamen.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('tpoExamens.edit', $tpoExamen->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('tpoExamen.destroy')
                    <button type="submit" class="btn btn-danger">Borrar <i class="glyphicon glyphicon-trash"></i><
                    /button>
                    @endpermission
                </div>
            {!! Form::close() !!}

        </h1>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
                <div class="form-group col-sm-4">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$tpoExamen->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="name">Tipo Examen</label>
                     <p class="form-control-static">{{$tpoExamen->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$tpoExamen->usu_alta->name}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$tpoExamen->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('tpoExamens.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection