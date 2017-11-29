@extends('plantillas.admin_template')

@include('hacademicas._common')

@section('header')

	<ol class="breadcrumb">
		<li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
	    <li><a href="{{ route('hacademicas.index') }}">@yield('hacademicasAppTitle')</a></li>
	    <li class="active">Examenes</li>
	</ol>

    <div class="page-header">
        <h3><i class="glyphicon glyphicon-plus"></i> @yield('hacademicasAppTitle') / Examenes </h3>
    </div>

    <style>
      table tr:hover {
        background-color: #A9D0F5;
        cursor: pointer;
    }
    </style>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">
            
            {!! Form::open(array('route' => 'hacademicas.examenes', "id"=>"frm_academica")) !!}
            
                    <div class="form-group col-md-4 @if($errors->has('cve_alumno')) has-error @endif">
                       <label for="cve_alumno-field">Clave Alumno</label>
                       {!! Form::text("cve_alumno", null, array("class" => "form-control", "id" => "cve_alumno-field")) !!}
                       @if($errors->has("cve_alumno"))
                        <span class="help-block">{{ $errors->first("cve_alumno") }}</span>
                       @endif
                    </div>

                    <div class="form-group col-md-4 @if($errors->has('grado_id')) has-error @endif">
                       <label for="grado_id-field">Grado</label>
                       {!! Form::select("grado_id", $list["Grado"], null, array("class" => "form-control select_seguridad", "id" => "grado_id-field")) !!}
                       @if($errors->has("grado_id"))
                        <span class="help-block">{{ $errors->first("grado_id") }}</span>
                       @endif
                    </div>
                    
                    <div class="form-group col-md-4 @if($errors->has('materium_id')) has-error @endif">
                       <label for="materium_id-field">Materia</label>
                       {!! Form::select("materium_id", $list["Materium"], null, array("class" => "form-control select_seguridad", "id" => "materium_id-field")) !!}
                       @if($errors->has("materium_id"))
                        <span class="help-block">{{ $errors->first("materium_id") }}</span>
                       @endif
                    </div>

                    <div class="form-group col-md-4 @if($errors->has('examen_id')) has-error @endif" style="clear:left;">
                       <label for="examen_id-field">Examen</label>
                       {!! Form::select("examen_id", $examen, null, array("class" => "form-control select_seguridad", "id" => "examen_id-field")) !!}
                       @if($errors->has("examen_id"))
                        <span class="help-block">{{ $errors->first("Examen_id") }}</span>
                       @endif
                    </div>
                   <!--
                    <div class="form-group col-md-4 @if($errors->has('calificacion')) has-error @endif">
                       <label for="calificacion-field">Calificacion</label>
                       {!! Form::text("calificacion", null, array("class" => "form-control", "id" => "calificacion-field")) !!}
                       @if($errors->has("calificacion"))
                        <span class="help-block">{{ $errors->first("calificacion") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('fecha')) has-error @endif">
                       <label for="fecha-field">fecha</label>
                       {!! Form::text("fecha", null, array("class" => "form-control", "id" => "fecha-field")) !!}
                       @if($errors->has("fecha"))
                        <span class="help-block">{{ $errors->first("fecha") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('reporte_bnd')) has-error @endif">
                       <label for="reporte_bnd-field">Reporte</label>
                       {!! Form::checkbox("reporte_bnd", 1, false) !!}
                       @if($errors->has("reporte_bnd"))
                        <span class="help-block">{{ $errors->first("reporte_bnd") }}</span>
                       @endif
                    </div>
                    -->

                <div class="row">
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Procesar</button>
                </div>
                @if(isset($hacademicas))
                    <table class="table table-condensed table-striped">
                        <theader>
                            <tr>
                                <td>
                                    <input type="checkbox" id="select-all" /> Todos<br/>
                                </td>
                                <td>Alumno</td><td>Grado</td><td>Materia</td><td>Examen</td><td>Calificacion</td>
                                <td>Fecha</td><td>Reportar</td>
                            </tr>
                        </theader>
                        <tbody>
                            @foreach($hacademicas as $h)
                                <tr>
                                    <td>
                                        {{ Form::checkbox("id[]", $h->id) }}
                                    </td>
                                    <td>
                                        {{$h->nombre}}
                                    </td>
                                    <td>
                                        {{$h->grado}}
                                    </td>
                                    <td>
                                        {{$h->materia}}
                                    </td>
                                    <td>
                                        {{$h->examen}}
                                    </td>
                                    <td>
                                        
                                        
                                        <input type="text" name="calificacion[]" value={{ $h->calificacion }} class="from-control">
                                    </td>
                                    <td>
                                        <input type="text" name="fecha[]" value={{ $h->fecha }} class="from-control fecha">
                                        
                                    </td>
                                    <td>
                                        {!! Form::checkbox("reporte_bnd[]", $h->id, $h->reporte_bnd) !!}
                                    </td>
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
      CmbGrado();
      CmbMateria();

      $('#cve_alumno-field').focusout(function() {
        CmbGrado();
      });

      $('#grado_id-field').change(function(){
        CmbMateria();
      });

      //$("tr td").parent().addClass('has-sub');
      $('#fecha-field').Zebra_DatePicker({
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

    function CmbGrado(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("grados.getCmbGradosXalumno") }}',
                  type: 'GET',
                  data: "cve_alumno=" + $('#cve_alumno-field').val() + "&grado_id=" + $('#grado_id-field option:selected').val() + "",
                  dataType: 'json',
                  beforeSend : function(){$("#loading13").show();},
                  complete : function(){$("#loading13").hide();},
                  success: function(data){
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

    function CmbMateria(){
          var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_academica').serialize();
              $.ajax({
                  url: '{{ route("materias.getCmbMateriaXalumno") }}',
                  type: 'GET',
                  data: "cve_alumno=" + $('#cve_alumno-field').val()+"&grado_id="+ $('#grado_id-field option:selected').val()+"&materia_id="+ $('#materia_id-field option:selected').val(),
                  dataType: 'json',
                  beforeSend : function(){$("#loading3").show();},
                  complete : function(){$("#loading3").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#materium_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#materium_id-field').append($('<option></option>').text('Seleccionar Opción').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#materium_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
      
</script>
@endpush