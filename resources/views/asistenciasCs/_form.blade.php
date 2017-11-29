                    
                    <div class="form-group col-md-4 @if($errors->has('empleado_id')) has-error @endif">
                       <label for="empleado_id-field">Empleado</label>
                       {!! Form::hidden("plantel_id", $e->plantel_id, array("class" => "form-control", "id" => "plantel-field")) !!}
                       {!! Form::select("empleado_id", $list["Empleado"], $e->id, array("class" => "form-control select_seguridad", "id" => "empleado_id-field")) !!}
                       @if($errors->has("empleado_id"))
                        <span class="help-block">{{ $errors->first("empleado_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('materium_id')) has-error @endif">
                       <label for="materium_id-field">Materia</label>
                        {!! Form::select("materium_id", $list["Materium"], null, array("class" => "form-control select_seguridad", "id" => "materium_id-field")) !!}
                       @if($errors->has("materium_id"))
                        <span class="help-block">{{ $errors->first("materium_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('grupo_id')) has-error @endif">
                       <label for="grupo_id-field">Grupo</label>
                       {!! Form::select("grupo_id", $list["Grupo"], null, array("class" => "form-control select_seguridad", "id" => "grupo_id-field")) !!}
                       @if($errors->has("grupo_id"))
                        <span class="help-block">{{ $errors->first("grupo_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('lectivo_id')) has-error @endif">
                       <label for="lectivo_id-field">Lectivo</label>
                       {!! Form::select("lectivo_id", $list["Lectivo"], null, array("class" => "form-control select_seguridad", "id" => "lectivo_id-field")) !!}
                       @if($errors->has("lectivo_id"))
                        <span class="help-block">{{ $errors->first("lectivo_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('fecha_aux')) has-error @endif">
                       <label for="fecha_aux-field">Fecha</label>
                       {!! Form::text("fecha_aux", null, array("class" => "form-control", "id" => "fecha_aux-field")) !!}
                       @if($errors->has("fecha_aux"))
                        <span class="help-block">{{ $errors->first("fecha_aux") }}</span>
                       @endif
                    </div>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('#fecha_aux-field').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
                months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                readonly_element: false,
                lang_clear_date: 'Limpiar',
                show_select_today: 'Hoy',
        });
        getCmbEmpleados();
        getCmbMaterias();
        getCmbGrupos();
      function getCmbEmpleados(){
          //$('#empleado_id_field option:selected').val($('#empleado_id_campo option:selected').val()).change();
          var a= $('#frm_asistencias_c').serialize();
              $.ajax({
                  url: '{{ route("empleados.getEmpleadosXplantel") }}',
                  type: 'GET',
                  data: a,
                  dataType: 'json',
                  beforeSend : function(){$("#loading3").show();},
                  complete : function(){$("#loading3").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      //alert($('#plantel_id-field option:selected').val());
                      $('#empleado_id-field').html('');
                      //$('#especialidad_id-field').empty();
                      $('#empleado_id-field').append($('<option></option>').text('Seleccionar Opción').val('0'));
                      //alert($('#plantel_id2-field option:selected').val());
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#empleado_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].nombre+"<\/option>");                          
                      });
                      //$('#empleado_id-field').change();
                      //$example.select2();
                  }
              });       
      }
      function getCmbMaterias(){
          //var $example = $("#especialidad_id-field").select2();
          //$('#materia_id_field option:selected').val($('#materium_id_campo option:selected').val()).change();
          var a= $('#frm_asistencias_c').serialize();
              $.ajax({
                  url: '{{ route("materias.getCmbMateria") }}',
                  type: 'GET',
                  data: a,
                  dataType: 'json',
                  beforeSend : function(){$("#loading10").show();},
                  complete : function(){$("#loading10").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#materium_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#materium_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#materium_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
      function getCmbGrupos(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_asistencias_c').serialize();
              $.ajax({
                  url: '{{ route("grupos.getCmbGrupo") }}',
                  type: 'GET',
                  data: a,
                  dataType: 'json',
                  beforeSend : function(){$("#loading10").show();},
                  complete : function(){$("#loading10").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#grupo_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#grupo_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#grupo_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
    });
   
  </script>
@endpush