@extends('plantillas.admin_template')

@include('plantels._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('plantels.index') }}">@yield('plantelsAppTitle')</a></li>
    <li class="active">{{ $plantel->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('plantelsAppTitle') / Mostrar {{$plantel->id}}

            {!! Form::model($plantel, array('route' => array('plantels.destroy', $plantel->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('plantels.edit', $plantel->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    <button type="submit" class="btn btn-danger">Borrar <i class="glyphicon glyphicon-trash"></i></button>
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
                    <p class="form-control-static">{{$plantel->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="razon">RAZON SOCIAL</label>
                     <p class="form-control-static">{{$plantel->razon}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="rfc">RFC</label>
                     <p class="form-control-static">{{$plantel->rfc}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="cve_incorporacion">CLAVE INCORPORACION</label>
                     <p class="form-control-static">{{$plantel->cve_incorporacion}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="direccion">DIRECCION</label>
                     <p class="form-control-static">{{$plantel->direccion}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="tel">TELÉFONO</label>
                     <p class="form-control-static">{{$plantel->tel}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="mail">CORREO ELECTRÓNICO</label>
                     <p class="form-control-static">{{$plantel->mail}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="pag_web">PÁGINA WEB</label>
                     <p class="form-control-static">{{$plantel->pag_web}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="lectivo_name">AÑO LECTIVO</label>
                     <p class="form-control-static">{{$plantel->lectivo->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="director">DIRECTOR</label>
                     <p class="form-control-static">{{$plantel->director}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="director_tel">DIRECTOR TELÉFONO</label>
                     <p class="form-control-static">{{$plantel->director_tel}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="director_mail">DIRECTOR CORREO ELECTRÓNICO</label>
                     <p class="form-control-static">{{$plantel->director_mail}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="rep_legal">REPRESENTANTE LEGAL</label>
                     <p class="form-control-static">{{$plantel->rep_legal}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="rep_legal_tel">REP_LEGAL_TEL</label>
                     <p class="form-control-static">{{$plantel->rep_legal_tel}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="rep_legal_mail">REPRESENTANTE CORREO ELECTRÓNICO</label>
                     <p class="form-control-static">{{$plantel->rep_legal_mail}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="logo">LOGO</label>
                     <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->logo) !!}" alt="Logo" height="100"> </img>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="slogan">SLOGAN</label>
                     <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->slogan) !!}" alt="Slogan" height="100"> </img>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="membrete">MEMBRETE</label>
                     <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->membrete) !!}" alt="Membrete" height="100"> </img>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$plantel->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="usu_mod_id">ULTIMA MODIFICACIÓN</label>
                     <p class="form-control-static">{{ $plantel->usu_mod->name }}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('plantels.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection