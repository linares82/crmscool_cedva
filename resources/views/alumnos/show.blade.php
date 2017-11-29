@extends('plantillas.admin_template')

@include('alumnos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('alumnos.index') }}">@yield('alumnosAppTitle')</a></li>
    <li class="active">{{ $alumno->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('alumnosAppTitle') / Mostrar {{$alumno->id}}

            {!! Form::model($alumno, array('route' => array('alumnos.destroy', $alumno->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('alumno.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('alumnos.edit', $alumno->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('alumno.destroy')
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
                    <p class="form-control-static">{{$alumno->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="matricula">MATRICULA</label>
                     <p class="form-control-static">{{$alumno->matricula}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre">NOMBRE</label>
                     <p class="form-control-static">{{$alumno->nombre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre2">NOMBRE2</label>
                     <p class="form-control-static">{{$alumno->nombre2}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="ape_paterno">APE_PATERNO</label>
                     <p class="form-control-static">{{$alumno->ape_paterno}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="ape_materno">APE_MATERNO</label>
                     <p class="form-control-static">{{$alumno->ape_materno}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="genero">GENERO</label>
                     <p class="form-control-static">{{$alumno->genero}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="curp">CURP</label>
                     <p class="form-control-static">{{$alumno->curp}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="fec_nacimiento">FEC_NACIMIENTO</label>
                     <p class="form-control-static">{{$alumno->fec_nacimiento}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="lugar_nacimiento">LUGAR_NACIMIENTO</label>
                     <p class="form-control-static">{{$alumno->lugar_nacimiento}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="extranjero">EXTRANJERO</label>
                     <p class="form-control-static">{{$alumno->extranjero}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="fec_inscripcion">FEC_INSCRIPCION</label>
                     <p class="form-control-static">{{$alumno->fec_inscripcion}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_fijo">TEL_FIJO</label>
                     <p class="form-control-static">{{$alumno->tel_fijo}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_cel">TEL_CEL</label>
                     <p class="form-control-static">{{$alumno->tel_cel}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cel_empresa">CEL_EMPRESA</label>
                     <p class="form-control-static">{{$alumno->cel_empresa}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="mail">MAIL</label>
                     <p class="form-control-static">{{$alumno->mail}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="mail_empresa">MAIL_EMPRESA</label>
                     <p class="form-control-static">{{$alumno->mail_empresa}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="calle">CALLE</label>
                     <p class="form-control-static">{{$alumno->calle}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="no_interior">NO_INTERIOR</label>
                     <p class="form-control-static">{{$alumno->no_interior}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="no_exterior">NO_EXTERIOR</label>
                     <p class="form-control-static">{{$alumno->no_exterior}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="colonia">COLONIA</label>
                     <p class="form-control-static">{{$alumno->colonia}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cp">CP</label>
                     <p class="form-control-static">{{$alumno->cp}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="municipio_name">MUNICIPIO_NAME</label>
                     <p class="form-control-static">{{$alumno->municipio->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="estado_name">ESTADO_NAME</label>
                     <p class="form-control-static">{{$alumno->estado->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="st_cliente_name">ST_CLIENTE_NAME</label>
                     <p class="form-control-static">{{$alumno->stCliente->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="distancia_escuela">DISTANCIA_ESCUELA</label>
                     <p class="form-control-static">{{$alumno->distancia_escuela}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="peso">PESO</label>
                     <p class="form-control-static">{{$alumno->peso}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="estatura">ESTATURA</label>
                     <p class="form-control-static">{{$alumno->estatura}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tipo_sangre">TIPO_SANGRE</label>
                     <p class="form-control-static">{{$alumno->tipo_sangre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="alergias">ALERGIAS</label>
                     <p class="form-control-static">{{$alumno->alergias}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="medicinas_contraindicadas">MEDICINAS_CONTRAINDICADAS</label>
                     <p class="form-control-static">{{$alumno->medicinas_contraindicadas}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="color_piel">COLOR_PIEL</label>
                     <p class="form-control-static">{{$alumno->color_piel}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="color_cabello">COLOR_CABELLO</label>
                     <p class="form-control-static">{{$alumno->color_cabello}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="senas_particulares">SENAS_PARTICULARES</label>
                     <p class="form-control-static">{{$alumno->senas_particulares}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre_padre">NOMBRE_PADRE</label>
                     <p class="form-control-static">{{$alumno->nombre_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="curp_padre">CURP_PADRE</label>
                     <p class="form-control-static">{{$alumno->curp_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="dir_padre">DIR_PADRE</label>
                     <p class="form-control-static">{{$alumno->dir_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_padre">TEL_PADRE</label>
                     <p class="form-control-static">{{$alumno->tel_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cel_padre">CEL_PADRE</label>
                     <p class="form-control-static">{{$alumno->cel_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_ofi_padre">TEL_OFI_PADRE</label>
                     <p class="form-control-static">{{$alumno->tel_ofi_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="mail_padre">MAIL_PADRE</label>
                     <p class="form-control-static">{{$alumno->mail_padre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre_madre">NOMBRE_MADRE</label>
                     <p class="form-control-static">{{$alumno->nombre_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="curp_madre">CURP_MADRE</label>
                     <p class="form-control-static">{{$alumno->curp_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="dir_madre">DIR_MADRE</label>
                     <p class="form-control-static">{{$alumno->dir_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_madre">TEL_MADRE</label>
                     <p class="form-control-static">{{$alumno->tel_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cel_madre">CEL_MADRE</label>
                     <p class="form-control-static">{{$alumno->cel_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_ofi_madre">TEL_OFI_MADRE</label>
                     <p class="form-control-static">{{$alumno->tel_ofi_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="mail_madre">MAIL_MADRE</label>
                     <p class="form-control-static">{{$alumno->mail_madre}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nombre_acudiente">NOMBRE_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->nombre_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="curp_acudiente">CURP_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->curp_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="dir_acudiente">DIR_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->dir_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_acudiente">TEL_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->tel_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cel_acudiente">CEL_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->cel_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="tel_ofi_acudiente">TEL_OFI_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->tel_ofi_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="mail_acudiente">MAIL_ACUDIENTE</label>
                     <p class="form-control-static">{{$alumno->mail_acudiente}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="plantel_razon">PLANTEL_RAZON</label>
                     <p class="form-control-static">{{$alumno->plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="especialidad_name">ESPECIALIDAD_NAME</label>
                     <p class="form-control-static">{{$alumno->especialidad->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="nivel_name">NIVEL_NAME</label>
                     <p class="form-control-static">{{$alumno->nivel->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="grado_name">GRADO_NAME</label>
                     <p class="form-control-static">{{$alumno->grado->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="cve_alumno">CVE_ALUMNO</label>
                     <p class="form-control-static">{{$alumno->cve_alumno}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">USU_ALTA_ID</label>
                     <p class="form-control-static">{{$alumno->usu_alta_id}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">USU_MOD_ID</label>
                     <p class="form-control-static">{{$alumno->usu_mod_id}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('alumnos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection