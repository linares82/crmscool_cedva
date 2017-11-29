                <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                      <label for="plantel_id-field">Plantel</label>
                      {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                      @if($errors->has("plantel_id"))
                        <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                      @endif
                    </div>
                <div class="form-group col-md-4 @if($errors->has('especialidad_id')) has-error @endif">
                      <label for="especialidad_id-field">Especialidad</label>
                      {!! Form::select("especialidad_id", $list["Especialidad"], null, array("class" => "form-control select_seguridad", "id" => "especialidad_id-field")) !!}
                      <div id='loading2' style='display: none'><img src="{{ asset('images/ajax-loader.gif') }}" title="Enviando" /></div> 
                      @if($errors->has("especialidad_id"))
                        <span class="help-block">{{ $errors->first("especialidad_id") }}</span>
                      @endif
                    </div>
                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>

@push('scripts')                    
<script>
  $(document).ready(function() {
    getCmbEspecialidad();
    $('#plantel_id-field').change(function(){
        getCmbEspecialidad();
    });
    function getCmbEspecialidad(){
        var $example = $("#especialidad_id-field").select2();
        var a= $('#frm_nivels').serialize();
            $.ajax({
                url: '{{ route("especialidads.getCmbEspecialidad") }}',
                type: 'GET',
                data: a,
                dataType: 'json',
                beforeSend : function(){$("#loading2").show();},
                complete : function(){$("#loading2").hide();},
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

  });
</script>
@endpush