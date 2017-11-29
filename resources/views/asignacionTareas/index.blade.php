@extends('plantillas.admin_template')

@include('asignacionTareas._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('asignacionTareas.index') }}">@yield('asignacionTareasAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('asignacionTareasAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('asignacionTareasAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('asignacionTareasAppTitle')
            @permission('asignacionTareas.create')
            <a class="btn btn-success pull-right" href="{{ route('asignacionTareas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            @endpermission
        </h3>

    </div>

    <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
        <div class="panel panel-default">
            <div id="headingOne" role="tab" class="panel-heading">
                <h4 class="panel-title">
                <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" role="button">
                    <span aria-hidden="true" class="glyphicon glyphicon-search"></span> Buscar
                </a>
                </h4>
            </div>
            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="collapseOne">
                <div class="panel-body">
                    <form class="AsignacionTarea_search" id="search" action="{{ route('asignacionTareas.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_cliente_id_gt">CLIENTE_ID</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cliente_id_gt']) ?: '' }}" name="q[cliente_id_gt]" id="q_cliente_id_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cliente_id_lt']) ?: '' }}" name="q[cliente_id_lt]" id="q_cliente_id_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_cliente_id_cont">CLIENTE</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cliente_id_cont']) ?: '' }}" name="q[cliente_id_cont]" id="q_cliente_id_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_empleado_id_gt">EMPLEADO_ID</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleado_id_gt']) ?: '' }}" name="q[empleado_id_gt]" id="q_empleado_id_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleado_id_lt']) ?: '' }}" name="q[empleado_id_lt]" id="q_empleado_id_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_empleado_id_cont">EMPLEADO</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleado_id_cont']) ?: '' }}" name="q[empleado_id_cont]" id="q_empleado_id_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_tareas.name_gt">TAREA_NAME</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['tareas.name_gt']) ?: '' }}" name="q[tareas.name_gt]" id="q_tareas.name_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['tareas.name_lt']) ?: '' }}" name="q[tareas.name_lt]" id="q_tareas.name_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_tareas.name_cont">TAREA</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['tareas.name_cont']) ?: '' }}" name="q[tareas.name_cont]" id="q_tareas.name_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_asunto_gt">ASUNTO</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['asunto_gt']) ?: '' }}" name="q[asunto_gt]" id="q_asunto_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['asunto_lt']) ?: '' }}" name="q[asunto_lt]" id="q_asunto_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_asunto_id_cont">ASUNTO</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['asunto_id_cont']) ?: '' }}" name="q[asunto_id_cont]" id="q_asunto_id_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_detalle_gt">DETALLE</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['detalle_gt']) ?: '' }}" name="q[detalle_gt]" id="q_detalle_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['detalle_lt']) ?: '' }}" name="q[detalle_lt]" id="q_detalle_lt" />
                                </div>
                            </div>
                            -->
                            
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_st_tarea_id_cont">ESTATUS</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['st_tarea_id_cont']) ?: '' }}" name="q[st_tarea_id_cont]" id="q_st_tarea_id_cont" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" name="commit" value="Buscar" class="btn btn-default btn-xs" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($asignacionTareas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'cliente_id', 'title' => 'CLIENTE'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'empleado_id', 'title' => 'EMPLEADO'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'tareas.name', 'title' => 'TAREA'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'asunto_id', 'title' => 'ASUNTO'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'estatus_id', 'title' => 'ESTATUS'])</th>
                            <th class="text-right">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($asignacionTareas as $asignacionTarea)
                            <tr>
                                <td><a href="{{ route('asignacionTareas.show', $asignacionTarea->id) }}">{{$asignacionTarea->id}}</a></td>
                                <td>{{$asignacionTarea->cliente->nombre}}</td>
                                <td>{{$asignacionTarea->empleado->nombre}}</td>
                                <td>{{$asignacionTarea->tarea->name}}</td>
                                <td>{{$asignacionTarea->asunto->name}}</td>
                                <td>{{$asignacionTarea->stTarea->name}}</td>
                    
                                <td class="text-right">
                                    @permission('asignacionTareas.seguimiento')
                                    <a class="btn btn-xs btn-default" href="{{ route('asignacionTareas.seguimiento', $asignacionTarea->id) }}"><i class="glyphicon glyphicon-list-alt"></i> Seguimiento</a>
                                    @endpermission
                                    @permission('asignacionTareas.edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('asignacionTareas.duplicate', $asignacionTarea->id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('asignacionTareas.edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('asignacionTareas.edit', $asignacionTarea->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('asignacionTareas.destroy')
                                    {!! Form::model($asignacionTarea, array('route' => array('asignacionTareas.destroy', $asignacionTarea->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $asignacionTareas->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection