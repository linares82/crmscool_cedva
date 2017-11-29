@extends('plantillas.admin_template')

@include('avisos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('avisos.index') }}">@yield('avisosAppTitle')</a></li>
    <li class="active">{{ $aviso->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('avisosAppTitle') / Mostrar {{$aviso->id}}

            {!! Form::model($aviso, array('route' => array('avisos.destroy', $aviso->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('aviso.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('avisos.edit', $aviso->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('aviso.destroy')
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
                    <p class="form-control-static">{{$aviso->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="seguimiento_id">SEGUIMIENTO_ID</label>
                     <p class="form-control-static">{{$aviso->seguimiento_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="asunto_id">ASUNTO_ID</label>
                     <p class="form-control-static">{{$aviso->asunto_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="detalle">DETALLE</label>
                     <p class="form-control-static">{{$aviso->detalle}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="fecha">FECHA</label>
                     <p class="form-control-static">{{$aviso->fecha}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="activo">ACTIVO</label>
                     <p class="form-control-static">{{$aviso->activo}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$aviso->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$aviso->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('avisos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection