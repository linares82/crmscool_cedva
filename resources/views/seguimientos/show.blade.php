@extends('plantillas.admin_template')

@include('seguimientos._common')

@section('header')

<ol class="breadcrumb">
	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('seguimientos.index') }}">@yield('seguimientosAppTitle')</a></li>
    <li class="active">{{ $seguimiento->id }}</li>
</ol>

<div class="page-header">
        <h1>@yield('seguimientosAppTitle') / 
            @if($seguimiento->st_seguimiento_id==1)
                <small class="label label-info"> 
            @elseif($seguimiento->st_seguimiento_id==2)
                <small class="label label-success"> 
            @elseif($seguimiento->st_seguimiento_id==3)
                <small class="label label-danger">
            @elseif($seguimiento->st_seguimiento_id==4)
                 <small class="label label-warning"> 
            @endif    
                Estatus: {{$seguimiento->stSeguimiento->name}}
            </small>
            /<a href="{{ route('seguimientos.showPrint', $seguimiento->cliente_id) }}"> Imprimir</a>

            {!! Form::model($seguimiento, array('route' => array('seguimientos.destroy', $seguimiento->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? Estas seguro?')) { return true } else {return false };")) !!}
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @permission('seguimiento.edit')
                    <a class="btn btn-warning btn-group" role="group" href="{{ route('seguimientos.edit', $seguimiento->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                    @endpermission
                    @permission('seguimiento.destroy')
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
            <div class="form-group col-md-2 ">
                <div class="box box-default">
                    <div class="box-body">
                        {!!Form::model($seguimiento, array('route' => array('seguimientos.update', $seguimiento->id),'method' => 'post')) !!}
                            <label for="cliente_id">CLIENTE</label>
                            <a class="btn btn-xs btn-warning" href="{{ route('clientes.edit', $seguimiento->cliente_id) }}"><i class="glyphicon glyphicon-edit"></i>Editar Cliente</a>
                            @if($seguimiento->st_seguimiento_id==2)
                            <a class="btn btn-xs btn-success" href="{{ route('alumnos.inscribir', array('c'=>$seguimiento->cliente_id)) }}"><i class="glyphicon glyphicon-edit"></i>Inscribir Cliente</a>
                            @endif
                            <p class="form-control-static"><label for="cliente_id">Nombre Completo:</label> {{$seguimiento->cliente->nombre." ".$seguimiento->cliente->nombre2." ".$seguimiento->cliente->ape_paterno." ".$seguimiento->cliente->ape_materno}}</p>
                            <p class="form-control-static"><label for="cliente_id">Tel. Fijo:</label> {{$seguimiento->cliente->tel_fijo}}</p>
                            <p class="form-control-static"><label for="cliente_id">Tel. Celular:</label> {{$seguimiento->cliente->tel_cel}}</p>
                            <p class="form-control-static"><label for="cliente_id">E-mail:</label> {{$seguimiento->cliente->mail}}</p>
                            <p class="form-control-static"><label for="cliente_id">Dirección:</label> {{
                                $seguimiento->cliente->calle." ".$seguimiento->cliente->no_ext." ".$seguimiento->cliente->colonia." ".$seguimiento->cliente->municipio->name}}
                            </p>
                            <div class="form-group col-md-12 @if($errors->has('st_seguimiento_id')) has-error @endif">
                            <label for="st_seguimiento_id-field">Estatus del seguimiento</label>
                            {!! Form::select("st_seguimiento_id", $sts,null, array("class" => "form-control select_seguridad", "id" => "st_seguimiento_id-field")) !!}
                            @if($errors->has("st_seguimiento_id"))
                                <span class="help-block">{{ $errors->first("st_seguimiento_id") }}</span>
                            @endif
                            </div>
                            <div class="row">
                            </div>

                            <div class="well well-sm">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="box box-success">
                    <div class="box-body">
                        <div class="table-responsive">
                            <button 
                            type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#favoritesModal">
                                Agregar Tarea
                            </button>
                        
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Tarea</th>
                                        <th>Asunto</th>
                                        <th>Detalle</th>
                                        <th>Estatus</th>
                                        <th>Fecha</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($asignacionTareas as $at)
                                    <tr>
                                        <td>{{$at->tarea->name}}</td>
                                        <td>{{$at->asunto->name}}</td>
                                        <td>{{$at->detalle}}</td>
                                        <td>{{$at->stTarea->name}}</td>
                                        <td>{{$at->created_at}}</td>
                                        <td>
                                        @permission('asignacionTareas.destroy')   
                                        {!! Form::model($at, array('route' => array('asignacionTareas.destroyModal', $at->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                        {!! Form::close() !!}
                                        @endpermission
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="box box-warning">
                    <div class="box-body">
                        <div class="table-responsive">
                            <button 
                            type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#favoritesModal1">
                                Agregar Aviso
                            </button>
                        
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Asunto</th>
                                        <th>Detalle</th>
                                        <th>Cerrar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($avisos as $a)
                                    <tr>
                                        <td>
                                        @if($a->dias_restantes<=0)
                                            <small class="label label-danger">
                                        @elseif($a->dias_restantes==1)
                                            <small class="label label-warning"> 
                                        @elseif($a->dias_restantes>=2)
                                            <small class="label label-success"> 
                                        @endif
                                            {{$a->fecha}}
                                        </small>
                                        </td>
                                        <td>{{$a->name}}</td>
                                        <td>{{$a->detalle}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" href="{{ route('avisos.inactivo', array('id'=>$a->id, 'cliente'=>$seguimiento->cliente_id)) }}"><i class="glyphicon glyphicon-trash"></i> Cerrar</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                   </div>
                </div>
            </div>
        </div>
<!--        Inicia timeline-->
        @if(isset($actividades))
        <div class="row">
            <div class="col-md-12">
                <ul class="timeline">
                    @foreach($actividades as $a)
                        <li class="time-label">
                            <span class="bg-red">
                              {{$a->fecha }}
                            </span>
                        </li>
                        <li>
                            @if($a->tarea=='Seguimiento')
                                <i class="fa  fa-check-square-o bg-blue"></i>
                            @elseif($a->tarea=='Aviso')
                                <i class="fa fa-envelope bg-green"></i>
                            @else
                                <i class="fa fa-tasks bg-orange"></i>
                            @endif


                            <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> {{$a->hora }}</span>
                              <h3 class="timeline-header"><strong>Actividad:</strong> {{$a->tarea }}</h3>
                              <div class="timeline-body">
                                <b>{{$a->asunto}}</b> : {{$a->detalle }}
                              </div>
                            </div>
                        </li>
                    @endforeach

                    <!-- END timeline item -->
                    <li>
                      <i class="fa fa-clock-o bg-gray"></i>
                    </li>
                  </ul>    
    <!--        Termina time line-->
            </div>
        </div>
        
        @endif
        <div class="row">
        </div>
        <a class="btn btn-link" href="{{ route('clientes.index', $seguimiento->cliente_id) }}"><i class="glyphicon glyphicon-backward"></i>  Regresar</a>

        </div>
    </div>
    <!-- Ventana para crear Tarea -->
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
                    id="favoritesModalLabel">Agregar Tarea</h4>
                  </div>
                  <div class="modal-body">
                    {!! Form::open(array('route' => 'asignacionTareas.storeModal')) !!}
                    <div class="form-group col-md-6 @if($errors->has('tarea_id')) has-error @endif">
                       <label for="tarea_id-field">Tarea</label>
                       {!! Form::select("tarea_id", $list["Tarea"], null, array("class" => "form-control select_seguridad", "id" => "tarea_id-field", 'style'=>'width:100%')) !!}
                       {!! Form::hidden("cliente_id", $seguimiento->cliente_id, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                       {!! Form::hidden("empleado_id", $seguimiento->cliente->empleado_id, array("class" => "form-control", "id" => "empleado_id-field")) !!}
                       @if($errors->has("tarea_id"))
                        <span class="help-block">{{ $errors->first("tarea_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('asunto_id')) has-error @endif">
                       <label for="asunto_id-field">Asunto</label>
                       {!! Form::select("asunto_id", $list["Asunto"], null, array("class" => "form-control select_seguridad", "id" => "asunto_id-field", 'style'=>'width:100%')) !!}
                       @if($errors->has("asunto_id"))
                        <span class="help-block">{{ $errors->first("asunto_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('st_tarea_id')) has-error @endif">
                       <label for="st_tarea_id-field">Estatus</label>
                       {!! Form::select("st_tarea_id", $list["StTarea"], null, array("class" => "form-control select_seguridad", "id" => "st_tarea_id-field", 'style'=>'width:100%')) !!}
                       @if($errors->has("st_tarea_id"))
                        <span class="help-block">{{ $errors->first("st_tarea_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-12 @if($errors->has('detalle')) has-error @endif">
                       <label for="detalle-field">Detalle</label>
                       {!! Form::textArea("detalle", null, array("class" => "form-control", "id" => "detalle-field", 'rows'=>'3')) !!}
                       {!! Form::hidden("observaciones", null, array("class" => "form-control", "id" => "observaciones-field", 'value'=>"default")) !!}
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
            
            
<!-- Ventana para crear Aviso -->
            <div class="modal fade" id="favoritesModal1" 
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
                    id="favoritesModalLabel">Agregar Aviso</h4>
                  </div>
                  <div class="modal-body">
                    {!! Form::open(array('route' => 'avisos.store')) !!}
                        <div class="form-group col-md-6 @if($errors->has('asunto_id')) has-error @endif">
                            {!! Form::hidden("seguimiento_id", $seguimiento->id, array("class" => "form-control", "id" => "seguimiento_id-field")) !!}
                            {!! Form::hidden("cliente_id", $seguimiento->cliente_id, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                            <label for="asunto_id-field">Asunto</label>
                            {!! Form::select("asunto_id", $list["Asunto"], null, array("class" => "form-control select_seguridad", "id" => "asunto_id-field", 'style'=>'width:100%')) !!}
                            @if($errors->has("asunto_id"))
                                <span class="help-block">{{ $errors->first("asunto_id") }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('fecha')) has-error @endif">
                            <label for="fecha-field">Fecha</label>
                            {!! Form::text("fecha", null, array("class" => "form-control", "id" => "fecha-field")) !!}
                            @if($errors->has("fecha"))
                                <span class="help-block">{{ $errors->first("fecha") }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 @if($errors->has('detalle')) has-error @endif">
                            <label for="detalle-field">Detalle</label>
                            {!! Form::textArea("detalle", null, array("class" => "form-control", "id" => "detalle-field", 'rows'=>3)) !!}
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
                    <div class="modal-footer">
                    
                    </div>
                  
                  </div>
                </div>
              </div>
            </div>
            
        
@endsection
@push('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
    $('#fecha-field').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        readonly_element: false,
        lang_clear_date: 'Limpiar',
        show_select_today: 'Hoy',
      });
    });
    </script>
@endpush