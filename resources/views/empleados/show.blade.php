@extends('plantillas.admin_template')

@include('empleados._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('empleados.index') }}">@yield('empleadosAppTitle')</a></li>
    <li class="active">{{ $empleado->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('empleadosAppTitle') / Mostrar {{$empleado->id}}

            {!! Form::model($empleado, array('route' => array('empleados.destroy', $empleado->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('empleado.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('empleados.edit', $empleado->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('empleado.destroy')
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
                <div class="box box-default">
                    <div class="box-body">
                        <div class="form-group col-sm-4">
                            <label for="nome">ID</label>
                            <p class="form-control-static">{{$empleado->id}}</p>
                        </div>
                        <div class="form-group col-sm-4 ">
                             <label for="cve_empleado">CLAVE EMPLEADO</label>
                             <p class="form-control-static">{{$empleado->cve_empleado}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="nombre">NOMBRE</label>
                             <p class="form-control-static">{{$empleado->nombre}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="ape_paterno">A. PATERNO</label>
                             <p class="form-control-static">{{$empleado->ape_paterno}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="ape_materno">A. MATERNO</label>
                             <p class="form-control-static">{{$empleado->ape_materno}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="puesto_name">PUESTO</label>
                             <p class="form-control-static">{{$empleado->puesto->name}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="area_name">AREA</label>
                             <p class="form-control-static">{{$empleado->area->name}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="rfc">RFC</label>
                             <p class="form-control-static">{{$empleado->rfc}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="curp">CURP</label>
                             <p class="form-control-static">{{$empleado->curp}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="direccion">DIRECCIÓN</label>
                             <p class="form-control-static">{{$empleado->direccion}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="tel_fijo">TELEFONO</label>
                             <p class="form-control-static">{{$empleado->tel_fijo}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="tel_cel">CELULAR</label>
                             <p class="form-control-static">{{$empleado->tel_cel}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="tel_cel">CELULAR EMPRESA</label>
                             <p class="form-control-static">{{$empleado->cel_empresa}}</p>
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="mail">CORREO ELECTRONICO</label>
                             <p class="form-control-static">{{$empleado->mail}}</p>
                        </div>
                        <div class="form-group col-sm-4 ">
                             <label for="mail">CORREO ELECTRONICO EMPRESA</label>
                             <p class="form-control-static">{{$empleado->mail_empresa}}</p>
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-body">
                        <div class="form-group col-sm-4 ">
                             <label for="foto">FOTO</label>
                             @if (isset($empleado))
                                  <img src="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->foto) !!}" alt="Foto" height="100"> </img>
                                 @endif
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="identificacion">IDENTIFICACION</label>
                             @if (isset($empleado))
                                  <img src="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->identificacion) !!}" alt="Identificacion" height="100"> </img>
                                 @endif
                        </div>
                    </div>
                </div>
                <div class="box box-default">
                    <div class="box-body">
                        <div class="form-group col-sm-4 ">
                             <label for="contrato">CONTRATO</label>
                             @if (isset($empleado))
                                  <a href="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->contrato) !!}" target="_blank"> {!! $empleado->contrato !!} </a>
                                 @endif
                        </div>
                            <div class="form-group col-sm-4 ">
                             <label for="evaluacion_psico">EVALUACION PSICOMETRICA</label>
                             @if (isset($empleado))
                                  <a href="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->evaluacion_psico) !!}" target="_blank"> {!! $empleado->evaluacion_psico !!} </a>
                                 @endif
                        </div>
                    </div>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="plantel_id">PLANTEL</label>
                     <p class="form-control-static">{{$empleado->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="stpuesto_id">ESTATUS</label>
                     <p class="form-control-static">{{$empleado->st_empleado->name}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$empleado->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{$empleado->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('empleados.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection