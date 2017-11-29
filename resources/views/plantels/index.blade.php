@extends('plantillas.admin_template')

@include('plantels._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('plantels.index') }}">@yield('plantelsAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('plantelsAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('plantelsAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('plantelsAppTitle')
            @permission('lectivos.create')
            <a class="btn btn-success pull-right" href="{{ route('plantels.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
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
                    <form class="Plantel_search" id="search" action="{{ route('plantels.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_razon_gt">RAZON</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['razon_gt']) ?: '' }}" name="q[razon_gt]" id="q_razon_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['razon_lt']) ?: '' }}" name="q[razon_lt]" id="q_razon_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_razon_cont">RAZON</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['razon_cont']) ?: '' }}" name="q[razon_cont]" id="q_razon_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_rfc_gt">RFC</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['rfc_gt']) ?: '' }}" name="q[rfc_gt]" id="q_rfc_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['rfc_lt']) ?: '' }}" name="q[rfc_lt]" id="q_rfc_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_rfc_cont">RFC</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['rfc_cont']) ?: '' }}" name="q[rfc_cont]" id="q_rfc_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_cve_incorporacion_gt">CVE_INCORPORACION</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cve_incorporacion_gt']) ?: '' }}" name="q[cve_incorporacion_gt]" id="q_cve_incorporacion_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cve_incorporacion_lt']) ?: '' }}" name="q[cve_incorporacion_lt]" id="q_cve_incorporacion_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_cve_incorporacion_cont">CLAVE INCORPORACION</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cve_incorporacion_cont']) ?: '' }}" name="q[cve_incorporacion_cont]" id="q_cve_incorporacion_cont" />
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
            @if($plantels->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'razon', 'title' => 'RAZON SOCIAL'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'rfc', 'title' => 'RFC'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'cve_incorporacion', 'title' => 'CLAVE INCORPORACION'])</th>
                        
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($plantels as $plantel)
                            <tr>
                                <td><a href="{{ route('plantels.show', $plantel->id) }}">{{$plantel->id}}</a></td>
                                <td>{{$plantel->razon}}</td>
                                <td>{{$plantel->rfc}}</td>
                                <td>{{$plantel->cve_incorporacion}}</td>
                                <td class="text-right">
                                    @permission('lectivos.duplicate')
                                    <a class="btn btn-xs btn-primary" href="{{ route('plantels.duplicate', $plantel->id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('lectivos.edit')
                                        <a class="btn btn-xs btn-warning" href="{{ route('plantels.edit', $plantel->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('lectivos.destroy')
                                        {!! Form::model($plantel, array('route' => array('plantels.destroy', $plantel->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                        {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $plantels->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection