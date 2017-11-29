@extends('plantillas.admin_template')

@include('avisoGrals._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('avisoGrals.index') }}">@yield('avisoGralsAppTitle')</a></li>
    <li class="active">{{ $avisoGral->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('avisoGralsAppTitle') / Mostrar {{$avisoGral->id}}

            {!! Form::model($avisoGral, array('route' => array('avisoGrals.destroy', $avisoGral->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('avisoGral.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('avisoGrals.edit', $avisoGral->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('avisoGral.destroy')
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
                    <p class="form-control-static">{{$avisoGral->id}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="aviso">DESC. CORTA</label>
                     <p class="form-control-static">{{$avisoGral->desc_corta}}</p>
                </div>
                <div class="form-group col-sm-4">
                     <label for="aviso">AVISO</label>
                     <p class="form-control-static">{{$avisoGral->aviso}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="inicio">INICIO VIGENCIA</label>
                     <p class="form-control-static">{{$avisoGral->inicio}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="fin">FIN VIGENCIA</label>
                     <p class="form-control-static">{{$avisoGral->fin}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_alta_id">ALTA</label>
                     <p class="form-control-static">{{$avisoGral->usu_alta->name}}</p>
                </div>
                    <div class="form-group col-sm-4">
                     <label for="usu_mod_id">ULTIMA MODIFICACION</label>
                     <p class="form-control-static">{{$avisoGral->usu_mod->name}}</p>
                </div>
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('avisoGrals.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection