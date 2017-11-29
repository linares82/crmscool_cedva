@extends('plantillas.admin_template')

@include('pivotDocEmpleados._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('pivotDocEmpleados.index') }}">@yield('pivotDocEmpleadosAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('pivotDocEmpleadosAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('pivotDocEmpleadosAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('pivotDocEmpleadosAppTitle')
            @permission('pivotDocEmpleados.create')
            <a class="btn btn-success pull-right" href="{{ route('pivotDocEmpleados.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
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
                    <form class="PivotDocEmpleado_search" id="search" action="{{ route('pivotDocEmpleados.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

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
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_empleado_id_cont">EMPLEADO_ID</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleado_id_cont']) ?: '' }}" name="q[empleado_id_cont]" id="q_empleado_id_cont" />
                                </div>
                            </div>
                                                    <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_doc_empleado_id_gt">DOC_EMPLEADO_ID</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['doc_empleado_id_gt']) ?: '' }}" name="q[doc_empleado_id_gt]" id="q_doc_empleado_id_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['doc_empleado_id_lt']) ?: '' }}" name="q[doc_empleado_id_lt]" id="q_doc_empleado_id_lt" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_doc_empleado_id_cont">DOC_EMPLEADO_ID</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['doc_empleado_id_cont']) ?: '' }}" name="q[doc_empleado_id_cont]" id="q_doc_empleado_id_cont" />
                                </div>
                            </div>
                                                    <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_archivo_gt">ARCHIVO</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['archivo_gt']) ?: '' }}" name="q[archivo_gt]" id="q_archivo_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['archivo_lt']) ?: '' }}" name="q[archivo_lt]" id="q_archivo_lt" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_archivo_cont">ARCHIVO</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['archivo_cont']) ?: '' }}" name="q[archivo_cont]" id="q_archivo_cont" />
                                </div>
                            </div>
                                                    <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_usu_alta_id_gt">USU_ALTA_ID</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_alta_id_gt']) ?: '' }}" name="q[usu_alta_id_gt]" id="q_usu_alta_id_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_alta_id_lt']) ?: '' }}" name="q[usu_alta_id_lt]" id="q_usu_alta_id_lt" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_usu_alta_id_cont">USU_ALTA_ID</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_alta_id_cont']) ?: '' }}" name="q[usu_alta_id_cont]" id="q_usu_alta_id_cont" />
                                </div>
                            </div>
                                                    <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_usu_mod_id_gt">USU_MOD_ID</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_mod_id_gt']) ?: '' }}" name="q[usu_mod_id_gt]" id="q_usu_mod_id_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_mod_id_lt']) ?: '' }}" name="q[usu_mod_id_lt]" id="q_usu_mod_id_lt" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_usu_mod_id_cont">USU_MOD_ID</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['usu_mod_id_cont']) ?: '' }}" name="q[usu_mod_id_cont]" id="q_usu_mod_id_cont" />
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
            @if($pivotDocEmpleados->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'empleado_id', 'title' => 'EMPLEADO_ID'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'doc_empleado_id', 'title' => 'DOC_EMPLEADO_ID'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'archivo', 'title' => 'ARCHIVO'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'usu_alta_id', 'title' => 'USU_ALTA_ID'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'usu_mod_id', 'title' => 'USU_MOD_ID'])</th>
                            <th class="text-right">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($pivotDocEmpleados as $pivotDocEmpleado)
                            <tr>
                                <td><a href="{{ route('pivotDocEmpleados.show', $pivotDocEmpleado->id) }}">{{$pivotDocEmpleado->id}}</a></td>
                                <td>{{$pivotDocEmpleado->empleado_id}}</td>
                    <td>{{$pivotDocEmpleado->doc_empleado_id}}</td>
                    <td>{{$pivotDocEmpleado->archivo}}</td>
                    <td>{{$pivotDocEmpleado->usu_alta_id}}</td>
                    <td>{{$pivotDocEmpleado->usu_mod_id}}</td>
                                <td class="text-right">
                                    @permission('pivotDocEmpleados.edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('pivotDocEmpleados.duplicate', $pivotDocEmpleado->id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('pivotDocEmpleados.edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('pivotDocEmpleados.edit', $pivotDocEmpleado->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('pivotDocEmpleados.destroy')
                                    {!! Form::model($pivotDocEmpleado, array('route' => array('pivotDocEmpleados.destroy', $pivotDocEmpleado->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $pivotDocEmpleados->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection