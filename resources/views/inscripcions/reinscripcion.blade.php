@extends('plantillas.admin_template')

@include('inscripcions._common')

@section('header')

	<ol class="breadcrumb">
		<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('inscripcions.index') }}">@yield('inscripcionsAppTitle')</a></li>
	    <li class="active">Crear</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> @yield('inscripcionsAppTitle') / Crear </h3>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            {!! Form::open(array('route' => 'inscripcions.reinscripcion')) !!}

            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">De</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                        <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                        <label for="plantel_id-field">Plantel</label>
                        {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field", 'readonly'=>'readonly')) !!}
                        @if($errors->has("plantel_id"))
                            <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                        @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('especialidad')) has-error @endif">
                        <label for="especialidad-field">Especialidad</label>
                        {!! Form::select("especialidad_id", $list["Especialidad"], null, array("class" => "form-control select_seguridad", "id" => "especialidad_id-field")) !!}
                        <div id='loading10' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                        @if($errors->has("especialidad"))
                            <span class="help-block">{{ $errors->first("especialidad") }}</span>
                        @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('nivel_id')) has-error @endif">
                        <label for="nivel_id-field">Nivel</label>
                        {!! Form::select("nivel_id", $list["Nivel"], null, array("class" => "form-control select_seguridad", "id" => "nivel_id-field")) !!}
                        <div id='loading11' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                        @if($errors->has("nivel_id"))
                            <span class="help-block">{{ $errors->first("nivel_id") }}</span>
                        @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('grado_id')) has-error @endif">
                        <label for="grado_id-field">Grado</label>
                        {!! Form::select("grado_id", $list["Grado"], null, array("class" => "form-control select_seguridad", "id" => "grado_id-field")) !!}
                        <div id='loading12' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                        @if($errors->has("grado_id"))
                            <span class="help-block">{{ $errors->first("grado_id") }}</span>
                        @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('lectivo_id')) has-error @endif">
                            <label for="lectivo_id-field">Periodo Lectivo</label>
                            {!! Form::select("lectivo_id", $list["Lectivo"], null, array("class" => "form-control select_seguridad", "id" => "lectivo_id-field")) !!}
                            @if($errors->has("lectivo_id"))
                            <span class="help-block">{{ $errors->first("lectivo_id") }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('grupo_id')) has-error @endif">
                            <label for="grupo_id-field" id="lbl_disponibles">De Grupo </label>
                            {!! Form::select("grupo_id", $list["Grupo"], null, array("class" => "form-control select_seguridad", "id" => "grupo_id-field")) !!}
                            @if($errors->has("grupo_id"))
                            <span class="help-block">{{ $errors->first("grupo_id") }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="box box-warning box-solid">
                <div class="box-header">
                    <h3 class="box-title">A</h3>
                    <div class="box-tools">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                        <div class="form-group col-md-4 @if($errors->has('grupo_to')) has-error @endif">
                            <label for="grupo_to-field" id="lbl_disponibles">A Grupo </label>
                            {!! Form::select("grupo_to", $list["Grupo"], null, array("class" => "form-control select_seguridad", "id" => "grupo_to-field")) !!}
                            @if($errors->has("grupo_to"))
                            <span class="help-block">{{ $errors->first("grupo_to") }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('lectivo_to')) has-error @endif">
                            <label for="lectivo_to-field">A Periodo Lectivo</label>
                            {!! Form::select("lectivo_to", $list["Lectivo"], null, array("class" => "form-control select_seguridad", "id" => "lectivo_to-field")) !!}
                            @if($errors->has("lectivo_to"))
                            <span class="help-block">{{ $errors->first("lectivo_to") }}</span>
                            @endif
                        </div>
                        <div class="row">
                        </div>
                        <div class="well well-sm">
                            <button type="submit" class="btn btn-primary">Procesar</button>
                            <a class="btn btn-link pull-right" href="{{ route('inscripcions.index') }}"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
                        </div>
                    </div>
                </div>
                @if(isset($clientes))
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <td><input type="checkbox" id="select-all" /> Todos<br/></td>
                            <td>Cliente</td><td>Aprobadas</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $c)
                        <tr>
                            <td>{{ Form::checkbox("id[]", $c->id) }}</td>
                            <td>{{ $c->nombre }}</td>
                            <td> {{ $c->materias_aprobadas }} </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@push('scripts')
  
  <script type="text/javascript">
    
    $(document).ready(function() {
      getCmbEspecialidad();
      getCmbNivel();
      getCmbGrado();
      getCmbGrupo();


      $('#plantel_id-field').change(function(){
          getCmbGrupo();
      });

      //$("tr td").parent().addClass('has-sub');
      $('.fecha').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        readonly_element: false,
        lang_clear_date: 'Limpiar',
        show_select_today: 'Hoy',
      });
     


      $('#select-all').click(function(event) {   
            if(this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function() {
                    this.checked = true;                        
                });
            }else{
                $(':checkbox').each(function() {
                    this.checked = false;                        
                });
            }
        });

    });
    function getCmbGrupo(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("grupos.getCmbGrupo") }}',
                  type: 'GET',
                  data: "plantel_id=" + $('#plantel_id-field option:selected').val() + "&grupo_id=" + $('#grupo_id-field option:selected').val() + "",
                  dataType: 'json',
                  beforeSend : function(){$("#loading13").show();},
                  complete : function(){$("#loading13").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#grupo_id-field').html('');
                      $('#grupo_to-field').html('');
                      //$('#especialidad_id-field').empty();
                      $('#grupo_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      $('#grupo_to-field').append($('<option></option>').text('Seleccionar').val('0'));
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#grupo_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          $('#grupo_to-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                      });
                      //$example.select2();
                  }
              });       
      }
      $('#plantel_id-field').change(function(){
          getCmbEspecialidad();
      });
      function getCmbEspecialidad(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("especialidads.getCmbEspecialidad") }}',
                  type: 'GET',
                  data: "plantel_id=" + $('#plantel_id-field option:selected').val() + "&especialidad_id=" + $('#especialidad_id-field option:selected').val() + "",
                  dataType: 'json',
                  beforeSend : function(){$("#loading10").show();},
                  complete : function(){$("#loading10").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#especialidad_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#especialidad_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#especialidad_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
      $('#especialidad_id-field').change(function(){
          getCmbNivel();
      });
      function getCmbNivel(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("nivels.getCmbNivels") }}',
                  type: 'GET',
                  data: "plantel_id=" + $('#plantel_id-field option:selected').val() + "&especialidad_id=" + $('#especialidad_id-field option:selected').val() + "&nivel_id=" + $('#nivel_id-field option:selected').val() + "",
                  dataType: 'json',
                  beforeSend : function(){$("#loading11").show();},
                  complete : function(){$("#loading11").hide();},
                  success: function(data){
                      //alert(data);
                      //$example.select2("destroy");
                      $('#nivel_id-field').html('');
                      //$('#especialidad_id-field').empty();
                      $('#nivel_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#nivel_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                      });
                      //$example.select2();
                  }
              });       
      }
      
      $('#nivel_id-field').change(function(){
          getCmbGrado();
      });
      function getCmbGrado(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("grados.getCmbGrados") }}',
                  type: 'GET',
                  data: "plantel_id=" + $('#plantel_id-field option:selected').val() + "&especialidad_id=" + $('#especialidad_id-field option:selected').val() + "&nivel_id=" + $('#nivel_id-field option:selected').val() + "&grado_id=" + $('#grado_id-field option:selected').val() +"",
                  dataType: 'json',
                  beforeSend : function(){$("#loading12").show();},
                  complete : function(){$("#loading12").hide();},
                  success: function(data){
                      //alert(data);
                      //$example.select2("destroy");
                      $('#grado_id-field').html('');
                      //$('#especialidad_id-field').empty();
                      $('#grado_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#grado_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                      });
                      //$example.select2();
                  }
              });       
      }
      
</script>
@endpush