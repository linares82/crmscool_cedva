@extends('plantillas.admin_template')

@include('empresas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('empresas.index') }}">@yield('empresasAppTitle')</a></li>
    <li class="active">{{ $empresa->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('empresasAppTitle') / Mostrar {{$empresa->id}}

            {!! Form::model($empresa, array('route' => array('empresas.destroy', $empresa->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('empresa.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('empresas.edit', $empresa->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('empresa.destroy')
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
                    <p class="form-control-static">{{$empresa->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="razon_social">RAZON SOCIAL</label>
                     <p class="form-control-static">{{$empresa->razon_social}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre_contacto">CONTACTO</label>
                     <p class="form-control-static">{{$empresa->nombre_contacto}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_fijo">TEL. FIJO</label>
                     <p class="form-control-static">{{$empresa->tel_fijo}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_cel">TEL. CEL.</label>
                     <p class="form-control-static">{{$empresa->tel_cel}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="correo1">CORREO 1</label>
                     <p class="form-control-static">{{$empresa->correo1}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="correo2">CORREO 2</label>
                     <p class="form-control-static">{{$empresa->correo2}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="calle">CALLE</label>
                     <p class="form-control-static">{{$empresa->calle}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="no_ex">NO. INT.</label>
                     <p class="form-control-static">{{$empresa->no_int}}</p>
                </div>    
                <div class="form-group col-sm-4">
                     <label for="no_ex">NO. EXT.</label>
                     <p class="form-control-static">{{$empresa->no_ex}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="colonia">COLONIA</label>
                     <p class="form-control-static">{{$empresa->colonia}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="municipio_name">MUNICIPIO</label>
                     <p class="form-control-static">{{$empresa->municipio->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="estado_name">ESTADO</label>
                     <p class="form-control-static">{{$empresa->estado->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cp">C.P.</label>
                     <p class="form-control-static">{{$empresa->cp}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="giro_name">GIRO</label>
                     <p class="form-control-static">{{$empresa->giro->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="plantel_">PLANTEL</label>
                     <p class="form-control-static">{{$empresa->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="especialidad_name">ESPECIALIDAD</label>
                     <p class="form-control-static">{{$empresa->especialidad->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$empresa->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$empresa->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('empresas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection