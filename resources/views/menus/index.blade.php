@extends('plantillas.admin_template')

@include('menus._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('menus.index') }}">@yield('menusAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('menusAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('menusAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('menusAppTitle')
            <a class="btn btn-success pull-right" href="{{ route('menus.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
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
                    <form class="Menu_search" id="search" action="{{ route('menus.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_item_gt">ITEM</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['item_gt']) ?: '' }}" name="q[item_gt]" id="q_item_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['item_lt']) ?: '' }}" name="q[item_lt]" id="q_item_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_item_cont">ITEM</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['item_cont']) ?: '' }}" name="q[item_cont]" id="q_item_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_imagen_gt">IMAGEN</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['imagen_gt']) ?: '' }}" name="q[imagen_gt]" id="q_imagen_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['imagen_lt']) ?: '' }}" name="q[imagen_lt]" id="q_imagen_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_imagen_cont">IMAGEN</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['imagen_cont']) ?: '' }}" name="q[imagen_cont]" id="q_imagen_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_prioridad_gt">PRIORIDAD</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['prioridad_gt']) ?: '' }}" name="q[prioridad_gt]" id="q_prioridad_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['prioridad_lt']) ?: '' }}" name="q[prioridad_lt]" id="q_prioridad_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_prioridad_cont">PRIORIDAD</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['prioridad_cont']) ?: '' }}" name="q[prioridad_cont]" id="q_prioridad_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_activo_gt">ACTIVO</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['activo_gt']) ?: '' }}" name="q[activo_gt]" id="q_activo_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['activo_lt']) ?: '' }}" name="q[activo_lt]" id="q_activo_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_activo_cont">ACTIVO</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['activo_cont']) ?: '' }}" name="q[activo_cont]" id="q_activo_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_link_gt">LINK</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['link_gt']) ?: '' }}" name="q[link_gt]" id="q_link_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['link_lt']) ?: '' }}" name="q[link_lt]" id="q_link_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_link_cont">LINK</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['link_cont']) ?: '' }}" name="q[link_cont]" id="q_link_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_parametros_gt">PARAMETROS</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['parametros_gt']) ?: '' }}" name="q[parametros_gt]" id="q_parametros_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['parametros_lt']) ?: '' }}" name="q[parametros_lt]" id="q_parametros_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_parametros_cont">PARAMETROS</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['parametros_cont']) ?: '' }}" name="q[parametros_cont]" id="q_parametros_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_permiso_gt">PERMISO</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['permiso_gt']) ?: '' }}" name="q[permiso_gt]" id="q_permiso_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['permiso_lt']) ?: '' }}" name="q[permiso_lt]" id="q_permiso_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_permiso_cont">PERMISO</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['permiso_cont']) ?: '' }}" name="q[permiso_cont]" id="q_permiso_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_padre_gt">PADRE</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['padre_gt']) ?: '' }}" name="q[padre_gt]" id="q_padre_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['padre_lt']) ?: '' }}" name="q[padre_lt]" id="q_padre_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q_padre_cont">PADRE</label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['padre_cont']) ?: '' }}" name="q[padre_cont]" id="q_padre_cont" />
                                </div>
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q__gt"></label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['_gt']) ?: '' }}" name="q[_gt]" id="q__gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['_lt']) ?: '' }}" name="q[_lt]" id="q__lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label class="col-sm-12 control-label" for="q__cont"></label>
                                <div class="col-sm-12">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['_cont']) ?: '' }}" name="q[_cont]" id="q__cont" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" name="commit" value="Search" class="btn btn-default btn-xs" />
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
            @if($menus->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'item', 'title' => 'ITEM'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'imagen', 'title' => 'IMAGEN'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'prioridad', 'title' => 'PRIORIDAD'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'activo', 'title' => 'ACTIVO'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'link', 'title' => 'LINK'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'parametros', 'title' => 'PARAMETROS'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'permiso', 'title' => 'PERMISO'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => 'padre', 'title' => 'PADRE'])</th>
                        <th>@include('CrudDscaffold::getOrderlink', ['column' => '', 'title' => ''])</th>
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td><a href="{{ route('menus.show', $menu->id) }}">{{$menu->id}}</a></td>
                                <td>{{$menu->item}}</td>
                                <td>{{$menu->imagen}}</td>
                                <td>{{$menu->prioridad}}</td>
                                <td>{{$menu->activo}}</td>
                                <td>{{$menu->link}}</td>
                                <td>{{$menu->parametros}}</td>
                                <td>{{$menu->permiso}}</td>
                                <td>{{$menu->padre}}</td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-warning" href="{{ route('menus.edit', $menu->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    {!! Form::model($menu, array('route' => array('menus.destroy', $menu->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $menus->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection