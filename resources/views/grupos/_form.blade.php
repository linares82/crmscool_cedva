                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Grupo</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('desc_corta')) has-error @endif">
                       <label for="desc_corta-field">Descripción Corta</label>
                       {!! Form::text("desc_corta", null, array("class" => "form-control", "id" => "desc_corta-field")) !!}
                       @if($errors->has("desc_corta"))
                        <span class="help-block">{{ $errors->first("desc_corta") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('limite_alumnos')) has-error @endif">
                       <label for="limite_alumnos-field">Limite Alumnos</label>
                       {!! Form::text("limite_alumnos", null, array("class" => "form-control", "id" => "limite_alumnos-field")) !!}
                       @if($errors->has("limite_alumnos"))
                        <span class="help-block">{{ $errors->first("limite_alumnos") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('minimo_alumnos')) has-error @endif">
                       <label for="minimo_alumnos-field">Mínimo Alumnos</label>
                       {!! Form::text("minimo_alumnos", null, array("class" => "form-control", "id" => "minimo_alumnos-field")) !!}
                       @if($errors->has("minimo_alumnos"))
                        <span class="help-block">{{ $errors->first("minimo_alumnos") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                       <label for="plantel_id-field">Plantel</label>
                       {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                       @if($errors->has("plantel_id"))
                        <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('jornada_id')) has-error @endif">
                       <label for="jornada_id-field">Jornada</label>
                       {!! Form::select("jornada_id", $list["Jornada"], null, array("class" => "form-control select_seguridad", "id" => "jornada_id-field")) !!}
                       @if($errors->has("jornada_id"))
                        <span class="help-block">{{ $errors->first("jornada_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('salon_id')) has-error @endif">
                       <label for="salon_id-field">Salon</label>
                       {!! Form::select("salon_id", $list["Salon"], null, array("class" => "form-control select_seguridad", "id" => "salon_id-field")) !!}
                       <div id='loading3' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                       @if($errors->has("salon_id"))
                        <span class="help-block">{{ $errors->first("salon_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('periodo_estudio_id')) has-error @endif">
                       <label for="periodo_estudio_id-field">Periodo</label>
                       {!! Form::select("periodo_estudio_id", $list["PeriodoEstudio"], null, array("class" => "form-control select_seguridad", "id" => "periodo_estudio_id-field")) !!}
                       <div id='loading10' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                       @if($errors->has("periodo_estudio_id"))
                        <span class="help-block">{{ $errors->first("periodo_estudio_id") }}</span>
                       @endif
                    </div>
                    
@push('scripts')
  
  <script type="text/javascript">
    
    $(document).ready(function() {
      getCmbSalon();
      getCmbPeriodo();
      
      $('#plantel_id-field').change(function(){
          getCmbSalon();
          getCmbPeriodo();
      });
      function getCmbSalon(){
          var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_grupos').serialize();
              $.ajax({
                  url: '{{ route("salons.getCmbSalon") }}',
                  type: 'GET',
                  data: a,
                  dataType: 'json',
                  beforeSend : function(){$("#loading3").show();},
                  complete : function(){$("#loading3").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#salon_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#salon_id-field').append($('<option></option>').text('Seleccionar Opción').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#salon_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
      function getCmbPeriodo(){
          //var $example = $("#especialidad_id-field").select2();
          var a= $('#frm_grupos').serialize();
              $.ajax({
                  url: '{{ route("periodoEstudios.getCmbPeriodo") }}',
                  type: 'GET',
                  data: a,
                  dataType: 'json',
                  beforeSend : function(){$("#loading10").show();},
                  complete : function(){$("#loading10").hide();},
                  success: function(data){
                      //$example.select2("destroy");
                      $('#periodo_estudio_id-field').html('');
                      
                      //$('#especialidad_id-field').empty();
                      $('#periodo_estudio_id-field').append($('<option></option>').text('Seleccionar').val('0'));
                      
                      $.each(data, function(i) {
                          //alert(data[i].name);
                          $('#periodo_estudio_id-field').append("<option "+data[i].selectec+" value=\""+data[i].id+"\">"+data[i].name+"<\/option>");
                          
                      });
                      //$example.select2();
                  }
              });       
      }
      

    });
    
</script>
@endpush