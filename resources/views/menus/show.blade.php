@extends('plantillas.admin_template')

@include('menus._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('menus.index') }}">@yield('menusAppTitle')</a></li>
    <li class="active">{{ $menu->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('menusAppTitle') / Mostrar {{$menu->id}}

            {!! Form::model($menu, array('route' => array('menus.destroy', $menu->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('menus.edit', $menu->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
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
                    <p class="form-control-static">{{$menu->id}}</p>
                </div>
                <div class="form-group col-sm-4 ">
                     <label for="item">ITEM</label>
                     <p class="form-control-static">{{$menu->item}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="imagen">IMAGEN</label>
                     <p class="form-control-static">{{$menu->imagen}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="prioridad">PRIORIDAD</label>
                     <p class="form-control-static">{{$menu->prioridad}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="activo">ACTIVO</label>
                     <p class="form-control-static">{{$menu->activo}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="link">LINK</label>
                     <p class="form-control-static">{{$menu->link}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="parametros">PARAMETROS</label>
                     <p class="form-control-static">{{$menu->parametros}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="permiso">PERMISO</label>
                     <p class="form-control-static">{{$menu->permiso}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="padre">PADRE</label>
                     <p class="form-control-static">{{$menu->padre}}</p>
                </div>
                    
            </form>

            <div class="row">
                </div>

            <a class="btn btn-link" href="{{ route('menus.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>

@endsection