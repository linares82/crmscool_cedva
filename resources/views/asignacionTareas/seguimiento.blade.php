@extends('plantillas.admin_template')

@include('asignacionTareas._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('asignacionTareas.index') }}">@yield('asignacionTareasAppTitle')</a></li>
    <li class="active">{{ $asignacionTarea->name }}</li>
</ol>

<div class="page-header">
        <h1>@yield('asignacionTareasAppTitle') / Mostrar {{$asignacionTarea->id}}

            {!! Form::model($asignacionTarea, array('route' => array('asignacionTareas.destroy', $asignacionTarea->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('asignacionTarea.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('asignacionTareas.edit', $asignacionTarea->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('asignacionTarea.destroy')
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
                <div class="form-group col-sm-4 ">
                     <label for="cliente_id">CLIENTE</label>
                     <p class="form-control-static">{{$asignacionTarea->cliente->nombre}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="empleado_id">EMPLEADO</label>
                     <p class="form-control-static">{{$asignacionTarea->empleado->nombre}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="tarea_name">TAREA</label>
                     <p class="form-control-static">{{$asignacionTarea->tarea->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="asunto">ASUNTO</label>
                     <p class="form-control-static">{{$asignacionTarea->asunto->name}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="detalle">DETALLE</label>
                     <p class="form-control-static">{{$asignacionTarea->detalle}}</p>
                </div>
                    <div class="form-group col-sm-4 ">
                     <label for="estatus_id">ESTATUS</label>
                     <p class="form-control-static">{{$asignacionTarea->stTarea->name}}</p>
                </div>
            </form>

            <div class="row ">
                <button 
                   type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#favoritesModal">
                    Agregar Seguimiento
                </button>
            </div>

            <div class="row col-sm-1">
            </div>
            <div class="row col-sm-10">
                <table class="table table-bordered table-striped dataTable">
                    <thead>
                        <th>Estatus</th><th>Detalle</th><th>Alta</th><th>F. Alta</th><th></th>
                    </thead>
                    <tbody>
                        @foreach($asignacionTarea->seguimientos as $s)
                        <tr>
                            <td>{{$s->estatus->name}}</td>
                            <td>{{$s->detalle}}</td>
                            <td>{{$s->usu_alta->name}}</td>
                            <td>{{$s->created_at}}</td>
                            <td>  
                                
                            </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row col-sm-1">
            </div>

            <div class="modal fade" id="favoritesModal" 
                 tabindex="-1" role="dialog" 
                 aria-labelledby="favoritesModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" 
                      data-dismiss="modal" 
                      aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" 
                    id="favoritesModalLabel">Agregar seguimiento</h4>
                  </div>
                  <div class="modal-body">
                    {!! Form::open(array('route' => 'seguimientoTareas.store')) !!}
                    <div class="form-group @if($errors->has('asignacion_tarea_id')) has-error @endif">
                       {!! Form::hidden("asignacion_tarea_id", $asignacionTarea->id, array("class" => "form-control", "id" => "asignacion_tarea_id-field")) !!}
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('estatus_id')) has-error @endif">
                       <label for="estatus_id-field">Estatus</label>
                       {!! Form::select("estatus_id", $list["StTarea"], null, array("class" => "form-control select_seguridad", "id" => "estatus_id-field")) !!}
                       @if($errors->has("estatus_id"))
                        <span class="help-block">{{ $errors->first("estatus_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('detalle')) has-error @endif">
                       <label for="detalle-field">Detalle</label>
                       {!! Form::textArea("detalle", null, array("class" => "form-control", "id" => "detalle-field", 'rows'=>'3')) !!}
                       @if($errors->has("detalle"))
                        <span class="help-block">{{ $errors->first("detalle") }}</span>
                       @endif
                    </div>
                    <div class="row">
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Crear</button>
                    </div>
                    {!! Form::close() !!}
                  </div>
                  <div class="modal-footer">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
                <div>
                    <a class="btn btn-link" href="{{ route('asignacionTareas.index') }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>
                </div>
            </div>
@endsection