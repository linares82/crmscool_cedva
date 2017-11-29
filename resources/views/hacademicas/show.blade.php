@extends('plantillas.admin_template')

@include('hacademicas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('hacademicas.index') }}">@yield('hacademicasAppTitle')</a></li>
    <li class="active">{{ $hacademica->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('hacademicasAppTitle') / Mostrar {{$hacademica->id}}

            {!! Form::model($hacademica, array('route' => array('hacademicas.destroy', $hacademica->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('hacademica.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('hacademicas.edit', $hacademica->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('hacademica.destroy')
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
                    <p class="form-control-static">{{$hacademica->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="alumno_id">ALUMNO</label>
                     <p class="form-control-static">{{$hacademica->cliente->nombre." ".$hacademica->cliente->ape_paterno." ".$hacademica->cliente->ape_materno}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="plantel_razon">PLANTEL</label>
                     <p class="form-control-static">{{$hacademica->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="especialidad_name">ESPECIALIDAD</label>
                     <p class="form-control-static">{{$hacademica->especialidad->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nivel_name">NIVEL</label>
                     <p class="form-control-static">{{$hacademica->nivel->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="grado_name">GRADO</label>
                     <p class="form-control-static">{{$hacademica->grado->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="materia_id">MATERIA</label>
                     <p class="form-control-static">{{$hacademica->materia->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="st_materia_id">ESTATUS MATERIA</label>
                     <p class="form-control-static">{{$hacademica->stMateria->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="lectivo_name">LECTIVO</label>
                     <p class="form-control-static">{{$hacademica->lectivo->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$hacademica->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$hacademica->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('hacademicas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection