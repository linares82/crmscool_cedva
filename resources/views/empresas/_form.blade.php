                <div class="form-group col-md-4 @if($errors->has('razon_social')) has-error @endif">
                       <label for="razon_social-field">Razon Social</label>
                       {!! Form::text("razon_social", null, array("class" => "form-control", "id" => "razon_social-field")) !!}
                       @if($errors->has("razon_social"))
                        <span class="help-block">{{ $errors->first("razon_social") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('nombre_contacto')) has-error @endif">
                       <label for="nombre_contacto-field">Nombre Contacto</label>
                       {!! Form::text("nombre_contacto", null, array("class" => "form-control", "id" => "nombre_contacto-field")) !!}
                       @if($errors->has("nombre_contacto"))
                        <span class="help-block">{{ $errors->first("nombre_contacto") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('tel_fijo')) has-error @endif">
                       <label for="tel_fijo-field">Tel. Fijo</label>
                       {!! Form::text("tel_fijo", null, array("class" => "form-control", "id" => "tel_fijo-field")) !!}
                       @if($errors->has("tel_fijo"))
                        <span class="help-block">{{ $errors->first("tel_fijo") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('tel_cel')) has-error @endif">
                       <label for="tel_cel-field">Tel. Cel</label>
                       {!! Form::text("tel_cel", null, array("class" => "form-control", "id" => "tel_cel-field")) !!}
                       @if($errors->has("tel_cel"))
                        <span class="help-block">{{ $errors->first("tel_cel") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('correo1')) has-error @endif">
                       <label for="correo1-field">Correo 1</label>
                       {!! Form::text("correo1", null, array("class" => "form-control", "id" => "correo1-field")) !!}
                       @if($errors->has("correo1"))
                        <span class="help-block">{{ $errors->first("correo1") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('correo2')) has-error @endif">
                       <label for="correo2-field">Correo 2</label>
                       {!! Form::text("correo2", null, array("class" => "form-control", "id" => "correo2-field")) !!}
                       @if($errors->has("correo2"))
                        <span class="help-block">{{ $errors->first("correo2") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('calle')) has-error @endif">
                       <label for="calle-field">Calle</label>
                       {!! Form::text("calle", null, array("class" => "form-control", "id" => "calle-field")) !!}
                       @if($errors->has("calle"))
                        <span class="help-block">{{ $errors->first("calle") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('no_int')) has-error @endif">
                       <label for="no_int-field">No. Int.</label>
                       {!! Form::text("no_int", null, array("class" => "form-control", "id" => "no_int-field")) !!}
                       @if($errors->has("no_int"))
                        <span class="help-block">{{ $errors->first("no_int") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('no_ex')) has-error @endif">
                       <label for="no_ex-field">No. Ext.</label>
                       {!! Form::text("no_ex", null, array("class" => "form-control", "id" => "no_ex-field")) !!}
                       @if($errors->has("no_ex"))
                        <span class="help-block">{{ $errors->first("no_ex") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('colonia')) has-error @endif">
                       <label for="colonia-field">Colonia</label>
                       {!! Form::text("colonia", null, array("class" => "form-control", "id" => "colonia-field")) !!}
                       @if($errors->has("colonia"))
                        <span class="help-block">{{ $errors->first("colonia") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('estado_id')) has-error @endif">
                       <label for="estado_id-field">Estado</label>
                       {!! Form::select("estado_id", $list["Estado"], null, array("class" => "form-control select_seguridad", "id" => "estado_id-field")) !!}
                       @if($errors->has("estado_id"))
                        <span class="help-block">{{ $errors->first("estado_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('municipio_id')) has-error @endif">
                       <label for="municipio_id-field">Municipio</label>
                       {!! Form::select("municipio_id", $list["Municipio"], null, array("class" => "form-control select_seguridad", "id" => "municipio_id-field")) !!}
                       @if($errors->has("municipio_id"))
                        <span class="help-block">{{ $errors->first("municipio_id") }}</span>
                       @endif
                    </div>
                    
                    <div class="form-group col-md-4 @if($errors->has('cp')) has-error @endif" style="clear:left;">
                       <label for="cp-field">C.P.</label>
                       {!! Form::text("cp", null, array("class" => "form-control", "id" => "cp-field")) !!}
                       @if($errors->has("cp"))
                        <span class="help-block">{{ $errors->first("cp") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('giro_id')) has-error @endif">
                       <label for="giro_id-field">Giro</label>
                       {!! Form::select("giro_id", $list["Giro"], null, array("class" => "form-control select_seguridad", "id" => "giro_id-field")) !!}
                       @if($errors->has("giro_id"))
                        <span class="help-block">{{ $errors->first("giro_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                       <!--<label for="plantel_id-field">Especialidad</label>-->
                       {!! Form::hidden("plantel_id", $p, array("class" => "form-control", "id" => "plantel_id-field")) !!}
                       @if($errors->has("plantel_id"))
                        <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('especialidad_id')) has-error @endif">
                       <label for="especialidad_id-field">Especialidad</label>
                       {!! Form::select("especialidad_id", $list["Especialidad"], null, array("class" => "form-control select_seguridad", "id" => "especialidad_id-field")) !!}
                       @if($errors->has("especialidad_id"))
                        <span class="help-block">{{ $errors->first("especialidad_id") }}</span>
                       @endif
                    </div>
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    getCmbEspecialidad();
    $('#estado_id-field').change(function(){
        $.get("{{ url('getCmbMunicipios')}}",
          { estado: $(this).val() },
          function(data) {
            $('#municipio_id-field').empty();
            $.each(data, function(key, element) {
              $('#municipio_id-field').append("<option value='" + key + "'>" + element + "</option>");
            });
          });
      });
});
function getCmbEspecialidad(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_cliente').serialize();
              $.ajax({
                  url: '{{ route("especialidads.getCmbEspecialidad") }}',
                  type: 'GET',
                  data: "plantel_id=" + $('#plantel_id-field').val() + "&especialidad_id=" + $('#especialidad_id-field option:selected').val() + "",
                  dataType: 'json',
                  beforeSend : function(){$("#loading10").show();},
                  complete : function(){$("#loading10").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#especialidad_id-field').empty();
                      $('#especialidad_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#especialidad_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                      });
                      //$example.select2();
                  }
              });       
      }
    
</script>

@endpush                    