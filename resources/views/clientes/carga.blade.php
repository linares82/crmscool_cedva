
@extends('plantillas.admin_template')

@include('clientes._common')

@section('header')

	<ol class="breadcrumb">
		<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('clientes.index') }}">@yield('clientesAppTitle')</a></li>
	    <li class="active">Crear</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> @yield('clientesAppTitle') / Crear </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::open(array('route' => 'clientes.carga', 'files'=>true)) !!}

                <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                 <label for="plantel_id-field">Plantel</label>
                 {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                 @if($errors->has("plantel_id"))
                  <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                 @endif
                </div>
                <div class="form-group col-md-4 @if($errors->has('archivo')) has-error @endif">
                   <label for="membrete-field">Archivo</label>
                   {!! Form::file('archivo') !!}
                   @if($errors->has("archivo"))
                    <span class="help-block">{{ $errors->first("archivo") }}</span>
                   @endif
                </div>
                <div class="form-group col-md-4 @if($errors->has('no_registros')) has-error @endif">
                   <label for="no_registros-field">No. Registros(Sin contar encabezados)</label>
                   {!! Form::text("no_registros", null, array("class" => "form-control", "id" => "no_registros-field")) !!}
                   @if($errors->has("no_registros"))
                    <span class="help-block">{{ $errors->first("no_registros") }}</span>
                   @endif
                </div>
                 
                <div class="form-group col-md-12">
                   <label for="no_registros-field">No. Registros Cargados</label>
                   @if(isset($procesados))
                      <span class="help-block">Se cargaron {!! $procesados !!} registros.</span>
                  @endif
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Procesar</button>
                    <a class="btn btn-link pull-right" href="{{ route('clientes.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                </div>

                

                 {!! Form::close() !!}
            <div class="box box-default">
              <div class="box-body">
                <div class="form-group col-md-12">
                   
                   <div class="info-box">
                      <a href="{!! asset('files/carga/plantilla.csv') !!}">
                        <span class="info-box-icon bg-green">
                        <i class="glyphicon glyphicon glyphicon-download-alt"></i>
                        </span>
                      </a>
                      <div class="info-box-content">
                        
                        <span class="progress-description">
                          <span class="info-box-text"><p>El archivo tiene la extensión csv y puede abrirse con excel, <br/> contiene una linea de encabezados indicando el dato que va en cada columna
                         quedando de la siguiente forma:</p></span>
                          <ol>
                            <li>Consecutivo (Obligatorio): Corresponde a un numero consecutivo por linea 1,2,3, ...</li>
                            <li>Nombre (Obligatorio): Nombre completo del cliente</li>
                            <li>Correo (Opcional): Correo Electrónico del cliente</li>
                            <li>Teléfono (Opcional): Teléfono del cliente</li>
                            <li>Celular (Opcional): Teléfono celular del cliente</li>
                          </ol>
                        </span>
                      </div>
                      
                   </div>
                </div>
              </div>
            </div> 
        </div>
    </div>
@endsection

@push('scripts')

@endpush