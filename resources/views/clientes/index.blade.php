@extends('plantillas.admin_template')

@include('clientes._common')

@section('header')

    <ol class="breadcrumb">
    	<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
        <!--
        @if ( $query_params = Request::input('q') )

            <li class="active"><a href="{{ route('clientes.index') }}">@yield('clientesAppTitle')</a></li>
            <li class="active">condition(  

            @foreach( $query_params as $key => $value )
                @if (!$loop->first) / @endif {{ $key }} : {{ $value }}
            @endforeach
            )</li>
        @else
            <li class="active">@yield('clientesAppTitle')</li>
        @endif
        -->
        <li class="active">@yield('clientesAppTitle')</li>
    </ol>

    <div class="">
        <h3>
            <i class="glyphicon glyphicon-align-justify"></i> @yield('clientesAppTitle')
            @permission('clientes.create')
            <a class="btn btn-success pull-right" href="{{ route('clientes.create') }}"><i class="glyphicon glyphicon-plus"></i> Crear</a>
            @endpermission
            @permission('clientes.carga')
            <a class="btn btn-warning pull-right" href="{{ route('clientes.carga') }}"><i class="glyphicon glyphicon-plus"></i> Carga Archivo</a>
            <a class="btn btn-primary pull-right" href="{{ route('clientes.descargaClientes') }}"><i class="fa fa-long-arrow-down"></i> Descarga</a>
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
                    <form class="Cliente_search" id="search" action="{{ route('clientes.index') }}" accept-charset="UTF-8" method="get">
                        <input type="hidden" name="q[s]" value="{{ @(Request::input('q')['s']) ?: '' }}" />
                        <div class="row">
                            <div class="col-md-12">

                            <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_cve_cliente_gt">CVE_CLIENTE</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cve_cliente_gt']) ?: '' }}" name="q[cve_cliente_gt]" id="q_cve_cliente_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['cve_cliente_lt']) ?: '' }}" name="q[cve_cliente_lt]" id="q_cve_cliente_lt" />
                                </div>
                            </div>
                            -->
                            
                    

                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_nombre_gt">NOMBRE</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['nombre_gt']) ?: '' }}" name="q[nombre_gt]" id="q_nombre_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['nombre_lt']) ?: '' }}" name="q[nombre_lt]" id="q_nombre_lt" />
                                </div>
                            </div>
                            -->
                            <div class="form-group col-md-4">
                                <label for="q_clientes.id_cont">ID</label>
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.id_lt']) ?: '' }}" name="q[clientes.id_lt]" id="q_clientes.id_lt" />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="q_clientes.nombre_cont">PRIMER NOMBRE</label>
                                
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.nombre_cont']) ?: '' }}" name="q[clientes.nombre_cont]" id="q_clientes.nombre_cont" />
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="q_clientes.nombre2_cont">SEGUNDO NOMBRE</label>
                                
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.nombre2_cont']) ?: '' }}" name="q[clientes.nombre2_cont]" id="q_clientes.nombre2_cont" />
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="q_clientes.ape_paterno_cont">APELLIDO PATERNO</label>
                                
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.ape_paterno_cont']) ?: '' }}" name="q[clientes.ape_paterno_cont]" id="q_clientes.ape_paterno_cont" />
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="q_clientes.ape_materno_cont">APELLIDO MATERNO</label>
                                
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.ape_materno_cont']) ?: '' }}" name="q[clientes.ape_materno_cont]" id="q_clientes.ape_materno_cont" />
                                
                            </div>
                            <div class="form-group col-md-4">
                                <label for="q_clientes.matricula_cont">MATRICULA</label>
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['clientes.matricula_cont']) ?: '' }}" name="q[clientes.matricula_cont]" id="q_clientes.matricula_cont" />
                            </div>
                                                    <!--
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="q_fec_registro_gt">FEC_REGISTRO</label>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['fec_registro_gt']) ?: '' }}" name="q[fec_registro_gt]" id="q_fec_registro_gt" />
                                </div>
                                <div class=" col-sm-1 text-center"> - </div>
                                <div class=" col-sm-4">
                                    <input class="form-control input-sm" type="search" value="{{ @(Request::input('q')['fec_registro_lt']) ?: '' }}" name="q[fec_registro_lt]" id="q_fec_registro_lt" />
                                </div>
                            </div>
                            -->
                            
                            <div class="form-group col-md-4">
                                <label for="q_clientes.medio_id_lt">MEDIO</label>
                                    {!! Form::select("medio_id", $list1["Medio"], "{{ @(Request::input('q')['clientes.medio_id_lt']) ?: '' }}", array("class" => "form-control select_seguridad", "name"=>"q[clientes.medio_id_lt]", "id"=>"q_clientes.medio_id_lt", "style"=>"width:100%;" )) !!}
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="q_clientes.st_cliente_id_lt">ESTATUS</label>
                                    {!! Form::select("st_cliente_id", $list1["StCliente"], "{{ @(Request::input('q')['clientes.st_cliente_id_lt']) ?: '' }}", array("class" => "form-control select_seguridad", "name"=>"q[clientes.st_cliente_id_lt]", "id"=>"q_clientes.st_cliente_id_lt", "style"=>"width:100%;" )) !!}
                            </div>
                        
                            <div class="form-group col-md-4">
                                <label for="q_st_seguimiento_id_lt">ESTATUS SEGUIMIENTO</label>
                                    {!! Form::select("st_seguimiento_id", $list["StSeguimiento"], "{{ @(Request::input('q')['st_seguimiento_id_lt']) ?: '' }}", array("class" => "form-control select_seguridad", "name"=>"q[st_seguimiento_id_lt]", "id"=>"q_st_seguimiento_id_lt", "style"=>"width:100%;" )) !!}
                            </div>

                            
                            <div class="form-group col-md-4" >
                                <label for="q_clientes.plantel_id_lt">PLANTEL</label>
                                
                                    {!! Form::select("clientes.plantel_id", $list1["Plantel"], "{{ @(Request::input('q')['clientes.plantel_id_lt']) ?: '' }}", array("class" => "form-control select_seguridad", "name"=>"q[clientes.plantel_id_lt]", "id"=>"q_clientes.plantel_id_lt", "style"=>"width:100%;")) !!}
                                
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label for="q_clientes.empleado_id_lt">EMPLEADO</label>
                                    {!! Form::select("clientes.empleado_id", $list1["Empleado"], "{{ @(Request::input('q')['clientes.empleado_id_lt']) ?: '' }}", array("class" => "form-control select_seguridad", "name"=>"q[clientes.empleado_id_lt]", "id"=>"q_clientes.empleado_id_lt", "style"=>"width:100%;" )) !!}
                            </div>
                            

                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="submit" name="commit" value="Buscar" class="btn btn-default btn-xs" />
                                </div>
                            </div>
                        </div></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>
        @if(session('message'))
            <div class="alert alert-danger">
                {!! session('message') !!}
            </div>
        @endif
        
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($clientes->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>@include('plantillas.getOrderLink', ['column' => 'cliente_id', 'title' => 'ID'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.nombre', 'title' => 'PRIMER NOMBRE'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.nombre2', 'title' => 'SEGUNDO NOMBRE'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.ape_paterno', 'title' => 'APELLIDO PATERNO'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.ape_materno', 'title' => 'APELLIDO MATERNO'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'st_seguimiento_id', 'title' => 'ESTATUS SEGUIMIENTO'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.st_cliente_id', 'title' => 'ESTATUS CLIENTE'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.plantel_id', 'title' => 'PLANTEL'])</th>
                            <th>@include('CrudDscaffold::getOrderlink', ['column' => 'clientes.empleado_id', 'title' => 'EMPLEADO'])</th>
                            
                            <th class="text-right">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td><a href="{{ route('clientes.edit', $cliente->cliente_id) }}">{{$cliente->cliente_id}}</a></td>
                                <td>{{$cliente->cliente->nombre}}</td>
                                <td>{{$cliente->cliente->nombre2}}</td>
                                <td>{{$cliente->cliente->ape_paterno}}</td>
                                <td>{{$cliente->cliente->ape_materno}}</td>
                                <td>
                                
                                <span class="label" style="background:{{$cliente->stSeguimiento->color}};">
                                    {{$cliente->stSeguimiento->name}}
                                </span>
                                </td>
                                <td>{{$cliente->cliente->stCliente->name}}</td>
                                <td>
                                @if(isset($cliente->cliente->plantel))
                                {{$cliente->cliente->plantel->razon}}
                                @endif
                                </td>
                                <td>{{$cliente->cliente->empleado->nombre." ".$cliente->cliente->empleado->ape_paterno." ".$cliente->cliente->empleado->ape_materno}}</td>
                                <td class="text-right">
                                    @permission('correos.redactar')
                                    @if(isset($cliente->cliente->mail))
                                    <a class="btn btn-xs btn-success" href="{{ url('correos/redactar').'/'.$cliente->cliente->mail.'/'.$cliente->cliente->nombre.'/0' }}"><i class="glyphicon glyphicon-envelope"></i> Correo </a>
                                    @endif
                                    @endpermission
                                    @permission('seguimientos.show')
                                    <a class="btn btn-xs btn-default" href="{{ route('seguimientos.show', $cliente->cliente->id) }}"><i class="glyphicon glyphicon-edit"></i> Seguimiento</a>
                                    @endpermission
                                    @permission('clientes.edit')
                                    <a class="btn btn-xs btn-primary" href="{{ route('clientes.duplicate', $cliente->cliente->id) }}"><i class="glyphicon glyphicon-duplicate"></i> Duplicar</a>
                                    @endpermission
                                    @permission('clientes.edit')
                                    <a class="btn btn-xs btn-warning" href="{{ route('clientes.edit', $cliente->cliente->id) }}"><i class="glyphicon glyphicon-edit"></i> Editar</a>
                                    @endpermission
                                    @permission('clientes.destroy')
                                    {!! Form::model($cliente, array('route' => array('clientes.destroy', $cliente->cliente->id),'method' => 'delete', 'style' => 'display: inline;', 'onsubmit'=> "if(confirm('¿Borrar? ¿Esta seguro?')) { return true } else {return false };")) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Borrar</button>
                                    {!! Form::close() !!}
                                    @endpermission
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $clientes->appends(Request::except('page'))->render() !!}
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
          $('#q_fec_registro_cont').Zebra_DatePicker({
            days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
            months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            readonly_element: false,
            lang_clear_date: 'Limpiar',
            show_select_today: 'Hoy',
          });  
       
        });


  </script>
@endpush