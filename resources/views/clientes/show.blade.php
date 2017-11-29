@extends('plantillas.admin_template')

@include('clientes._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('clientes.index') }}">@yield('clientesAppTitle')</a></li>
    <li class="active">{{ $cliente->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('clientesAppTitle') / Mostrar {{$cliente->id}}

            {!! Form::model($cliente, array('route' => array('clientes.destroy', $cliente->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('cliente.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('clientes.edit', $cliente->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('cliente.destroy')
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
                        <p class="form-control-static">{{$cliente->id}}</p>
                    </div>
                    <div class="form-group col-sm-4 ">
                         <label for="cve_cliente">CLAVE CLIENTE</label>
                         <p class="form-control-static">{{$cliente->cve_cliente}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="nombre">NOMBRE COMPLETO</label>
                         <p class="form-control-static">{{$cliente->nombre}}</p>
                    </div>
                  </div>
                </div>
                <div class="box box-default">
                  <div class="box-body">
                        <div class="form-group col-sm-4 ">
                         <label for="fec_registro">FECHA REGISTRO</label>
                         <p class="form-control-static">{{$cliente->fec_registro}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="tel_fijo">TELEFONO FIJO</label>
                         <p class="form-control-static">{{$cliente->tel_fijo}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="tel_cel">TELEFONO CELULAR</label>
                         <p class="form-control-static">{{$cliente->tel_cel}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="mail">CORREO ELECTRONICO</label>
                         <p class="form-control-static">{{$cliente->mail}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="calle">CALLE</label>
                         <p class="form-control-static">{{$cliente->calle}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="no_exterior">NO. EXTERIOR</label>
                         <p class="form-control-static">{{$cliente->no_exterior}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="no_interior">NO. INTERIOR</label>
                         <p class="form-control-static">{{$cliente->no_interior}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="colonia">COLONIA</label>
                         <p class="form-control-static">{{$cliente->colonia}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="cp">C.P.</label>
                         <p class="form-control-static">{{$cliente->cp}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="municipio_">MUNICIPIO</label>
                         <p class="form-control-static">{{$cliente->municipio->name}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="estado_name">ESTADO</label>
                         <p class="form-control-static">{{$cliente->estado->name}}</p>
                    </div>
                  </div>
                </div>
                <div class="box box-default">
                  <div class="box-body">
                        <div class="form-group col-sm-4 ">
                         <label for="st_cliente_name">ESTATUS</label>
                         <p class="form-control-static">{{$cliente->stCliente->name}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="oferta_id">OFERTA</label>
                         <p class="form-control-static">{{$cliente->oferta->name}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="medio_name">MEDIO</label>
                         <p class="form-control-static">{{$cliente->medio->name}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="expo">EXPO</label>
                         <p class="form-control-static">{{$cliente->expo}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="otro_medio">OTRO MEDIO</label>
                         <p class="form-control-static">{{$cliente->otro_medio}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="empleado_id">EMPLEADO </label>
                         <p class="form-control-static">{{$cliente->empleado->nombre}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="promociones">PROMOCIONES</label>
                         <p class="form-control-static">{{$cliente->promociones}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="promo_cel">PROMO CEL</label>
                         <p class="form-control-static">{{$cliente->promo_cel}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="promo_correo">PROMO CORREO</label>
                         <p class="form-control-static">{{$cliente->promo_correo}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="usu_alta_id">ALTA</label>
                         <p class="form-control-static">{{$cliente->usu_alta->name}}</p>
                    </div>
                        <div class="form-group col-sm-4 ">
                         <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                         <p class="form-control-static">{{$cliente->usu_mod->name}}</p>
                    </div>
                  </div>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('clientes.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection