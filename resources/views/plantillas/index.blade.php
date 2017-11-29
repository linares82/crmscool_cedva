@extends('plantillas.admin_template')

@include('plantillas._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('plantillas.index') }}">@yield('plantillasAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('plantillasAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('plantillasAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('plantillasAppTitle')
            @permission('plantillas.create')
            <a class="btn btn-success pull-right" href="{{ route('plantillas.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            <a class="btn btn-success pull-right" href="{{ url('filemanager/show') }}"><i class="glyphicon glyphicon-plus"></i> Carga Archivos</a>
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
                    <form class="Plantilla_search" id="search" action="{{ route('plantillas.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_plantilla_gt">PLANTILLA</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['plantilla_gt']) ?: '' }}" name="q[plantilla_gt]" id="q_plantilla_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['plantilla_lt']) ?: '' }}" name="q[plantilla_lt]" id="q_plantilla_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_plantilla_cont">NOMBRE</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['nombre_cont']) ?: '' }}" name="q[nombre_cont]" id="q_nombre_cont" />
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
            @if($plantillas->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'plantilla', 'title' => 'NOMBRE'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'sms_bnd', 'title' => 'SMS'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'mail_bnd', 'title' => 'MAIL'])</th>
                            <th class="text-right">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($plantillas as $plantilla)
                            <tr>
                                <td><a href="{{ route('plantillas.show', $plantilla->id) }}">{{$plantilla->id}}</a></td>
                                <td>{{$plantilla->nombre}}</td>
                                <td>{{$plantilla->sms_bnd}}</td>
                                <td>{{$plantilla->mail_bnd}}</td>
                                <td class="text-right">
                                    @permission('plantillas.edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('plantillas.duplicate', $plantilla->id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('plantillas.edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('plantillas.edit', $plantilla->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('plantillas.destroy')
                                    {!! Form::model($plantilla, array('route' => array('plantillas.destroy', $plantilla->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $plantillas->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection

