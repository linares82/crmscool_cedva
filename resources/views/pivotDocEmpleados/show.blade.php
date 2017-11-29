@extends('plantillas.admin_template')

@include('pivotDocEmpleados._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('pivotDocEmpleados.index') }}">@yield('pivotDocEmpleadosAppTitle')</a></li>
    <li class="active">{{ $pivotDocEmpleado->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('pivotDocEmpleadosAppTitle') / Mostrar {{$pivotDocEmpleado->id}}

            {!! Form::model($pivotDocEmpleado, array('route' => array('pivotDocEmpleados.destroy', $pivotDocEmpleado->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('pivotDocEmpleado.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('pivotDocEmpleados.edit', $pivotDocEmpleado->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('pivotDocEmpleado.destroy')
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
                    <p class="form-control-static">{{$pivotDocEmpleado->id}}</p>
                </div>
                <div class="form-group">
                     <label for="empleado_id">EMPLEADO_ID</label>
                     <p class="form-control-static">{{$pivotDocEmpleado->empleado_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="doc_empleado_id">DOC_EMPLEADO_ID</label>
                     <p class="form-control-static">{{$pivotDocEmpleado->doc_empleado_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="archivo">ARCHIVO</label>
                     <p class="form-control-static">{{$pivotDocEmpleado->archivo}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$pivotDocEmpleado->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$pivotDocEmpleado->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('pivotDocEmpleados.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection