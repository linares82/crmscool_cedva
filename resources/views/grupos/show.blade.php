@extends('plantillas.admin_template')

@include('grupos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('grupos.index') }}">@yield('gruposAppTitle')</a></li>
    <li class="active">{{ $grupo->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('gruposAppTitle') / Mostrar {{$grupo->id}}

            {!! Form::model($grupo, array('route' => array('grupos.destroy', $grupo->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('grupo.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('grupos.edit', $grupo->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('grupo.destroy')
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
                <div class="form-group col-sm-4 col-sm-4">
                    <label for="nome">ID</label>
                    <p class="form-control-static">{{$grupo->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="name">GRUPO</label>
                     <p class="form-control-static">{{$grupo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="desc_corta">DESCRIPCION CORTA</label>
                     <p class="form-control-static">{{$grupo->desc_corta}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="limite_alumnos">LIMITE ALUMNOS</label>
                     <p class="form-control-static">{{$grupo->limite_alumnos}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="jornada_name">JORNADA</label>
                     <p class="form-control-static">{{$grupo->jornada->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="salon_name">SALON</label>
                     <p class="form-control-static">{{$grupo->salon->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="periodo_id">PERIODO</label>
                     <p class="form-control-static">{{$grupo->periodoEstudio->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="periodo_id">PLANTEL</label>
                     <p class="form-control-static">{{$grupo->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$grupo->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$grupo->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('grupos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection