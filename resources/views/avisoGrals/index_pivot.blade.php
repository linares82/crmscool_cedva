@extends('plantillas.admin_template')

@include('avisoGrals._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('avisoGrals.index') }}">@yield('avisoGralsAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('avisoGralsAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('avisoGralsAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('avisoGralsAppTitle')
            @permission('avisoGrals.create')
            <a class="btn btn-success pull-right" href="{{ route('avisoGrals.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
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
                    <form class="AvisoGral_search" id="search" action="{{ route('avisoGrals.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="form-horizontal">

                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_aviso_grals.desc_corta_cont">DESC. CORTA</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['aviso_grals.desc_corta_cont']) ?: '' }}" name="q[aviso_grals.desc_corta_cont]" id="q_aviso_grals.desc_corta_cont" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_empleados.nombre_cont">DESTINATARIO</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleados.nombre_cont']) ?: '' }}" name="q[empleados.nombre_cont]" id="q_empleados.nombre_cont" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_empleados.ape_paterno_cont">APELLIDO PATERNO</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleados.ape_paterno_cont']) ?: '' }}" name="q[empleados.ape_paterno_cont]" id="q_empleados.ape_paterno_cont" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_empleados.ape_materno_cont">APELLIDO MATERNO</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['empleados.ape_materno_cont']) ?: '' }}" name="q[empleados.ape_materno_cont]" id="q_empleados.ape_materno_cont" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_created_at">FECHA</label>
                                <div class=" col-sm-9">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['created_at_cont']) ?: '' }}" name="q[created_at_cont]" id="q_created_at_cont" />
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
            @if($avisoGrals->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'aviso_grals.desc_corta', 'title' => 'Asunto'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'created_at', 'title' => 'fecha'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'empleados.nombre', 'title' => 'destinatario'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'empleados.ape_paterno', 'title' => 'destinatario'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'empleados.ape_materno', 'title' => 'destinatario'])</th>
                            
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'enviado', 'title' => 'Enviado'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'leido', 'title' => 'Leido'])</th>
                            
                            <th class="text-right">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($avisoGrals as $avisoGral)
                            <tr>
                                <td><a href="{{ route('avisoGrals.show', $avisoGral->aviso_gral_id) }}">{{$avisoGral->aviso_gral_id}}</a></td>
                                <td>{{$avisoGral->avisoGral->desc_corta}}</td>
                                <td>{{$avisoGral->created_at}}</td>
                                <td>{{$avisoGral->empleado->nombre}}</td>
                                <td>{{$avisoGral->empleado->ape_paterno}}</td>
                                <td>{{$avisoGral->empleado->ape_materno}}</td>
                                
                                <td>
                                    {!! Form::checkbox("enviado", 
                                                        $avisoGral->enviado, 
                                                        $avisoGral->enviado,
                                                        array('disabled'=>'disabled')) !!}
                                </td>
                                <td>{!! Form::checkbox("enviado", 
                                                        $avisoGral->leido, 
                                                        $avisoGral->leido,
                                                        array('disabled'=>'disabled')) !!}
                                </td>
                                <td class="text-right">
                                    @permission('avisoGrals.edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('avisoGrals.duplicate', $avisoGral->aviso_gral_id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('avisoGrals.edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('avisoGrals.edit', $avisoGral->aviso_gral_id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('avisoGrals.destroy')
                                    {!! Form::model($avisoGral->avisoGral, array('route' => array('avisoGrals.destroy', $avisoGral->aviso_gral_id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $avisoGrals->appends(Request::except('page'))->render() !!}
            @else
                <h3 class="text-center alert alert-info">Vacio!</h3>
            @endif

        </div>
    </div>

@endsection
@push('scripts')
  <script>
  
    $(document).ready(function() {
        // assuming the controls you want to attach the plugin to
          // have the "datepicker" class set
          //Campo de fecha
          $('#q_created_at_cont').Zebra_DatePicker({
            days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            readonly_element: false,
            lang_clear_date: 'Limpiar',
            show_select_today: 'Hoy',
          });  
       
        });


  </script>
@endpush