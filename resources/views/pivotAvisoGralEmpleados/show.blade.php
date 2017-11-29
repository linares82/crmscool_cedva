@extends('plantillas.admin_template')

@include('pivotAvisoGralEmpleados._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('pivotAvisoGralEmpleados.index') }}">@yield('pivotAvisoGralEmpleadosAppTitle')</a></li>
    <li class="active">{{ $pivotAvisoGralEmpleado->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('pivotAvisoGralEmpleadosAppTitle') / Mostrar {{$pivotAvisoGralEmpleado->id}}

            {!! Form::model($pivotAvisoGralEmpleado, array('route' => array('pivotAvisoGralEmpleados.destroy', $pivotAvisoGralEmpleado->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('pivotAvisoGralEmpleado.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('pivotAvisoGralEmpleados.edit', $pivotAvisoGralEmpleado->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('pivotAvisoGralEmpleado.destroy')
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
                    <p class="form-control-static">{{$pivotAvisoGralEmpleado->id}}</p>
                </div>
                <div class="form-group">
                     <label for="aviso_gral_id">AVISO_GRAL_ID</label>
                     <p class="form-control-static">{{$pivotAvisoGralEmpleado->aviso_gral_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="empleado_id">EMPLEADO_ID</label>
                     <p class="form-control-static">{{$pivotAvisoGralEmpleado->empleado_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$pivotAvisoGralEmpleado->usu_alta_id}}</p>
                </div>
                    <div class="form-group">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$pivotAvisoGralEmpleado->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('pivotAvisoGralEmpleados.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection