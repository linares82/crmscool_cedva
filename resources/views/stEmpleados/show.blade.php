@extends('plantillas.admin_template')

@include('stEmpleados._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('stEmpleados.index') }}">@yield('stEmpleadosAppTitle')</a></li>
    <li class="active">{{ $stEmpleado->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('stEmpleadosAppTitle') / Mostrar {{$stEmpleado->id}}

            {!! Form::model($stEmpleado, array('route' => array('stEmpleados.destroy', $stEmpleado->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('stEmpleado.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('stEmpleados.edit', $stEmpleado->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('stEmpleado.destroy')
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
                    <p class="form-control-static">{{$stEmpleado->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="name">Estatus Empleado</label>
                     <p class="form-control-static">{{$stEmpleado->name}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$lectivo->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{$lectivo->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('stEmpleados.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection