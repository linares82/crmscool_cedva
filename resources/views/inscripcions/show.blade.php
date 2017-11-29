@extends('plantillas.admin_template')

@include('inscripcions._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('inscripcions.index') }}">@yield('inscripcionsAppTitle')</a></li>
    <li class="active">{{ $inscripcion->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('inscripcionsAppTitle') / Mostrar {{$inscripcion->id}}

            {!! Form::model($inscripcion, array('route' => array('inscripcions.destroy', $inscripcion->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('inscripcion.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('inscripcions.edit', $inscripcion->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('inscripcion.destroy')
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
                    <p class="form-control-static">{{$inscripcion->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="plantel_id">PLANTEL</label>
                     <p class="form-control-static">{{$inscripcion->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="especialidad_id">ESPECIALIDAD</label>
                     <p class="form-control-static">{{$inscripcion->especialidad->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nivel_id">NIVEL</label>
                     <p class="form-control-static">{{$inscripcion->nivel->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="grado_id">GRADO</label>
                     <p class="form-control-static">{{$inscripcion->grado->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="grupo_id">GRUPO</label>
                     <p class="form-control-static">{{$inscripcion->grupo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="alumno_id">ALUMNO</label>
                     <p class="form-control-static">{{$inscripcion->cliente->nombre." ".$inscripcion->cliente->nombre2." ".$inscripcion->cliente->ape_paterno." ".$inscripcion->cliente->ape_materno}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="fec_inscripcion">F. INSCRIPCION</label>
                     <p class="form-control-static">{{$inscripcion->fec_inscripcion}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="periodo_lectivo_id">PERIODO LECTIVO</label>
                     <p class="form-control-static">{{$inscripcion->lectivo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$inscripcion->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$inscripcion->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('inscripcions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection