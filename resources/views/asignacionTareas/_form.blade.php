<link href="{{ asset ('/bower_components/AdminLTE/plugins/Multi-column-Dropdown/src/jquery.inputpicker.css') }}" rel="stylesheet">
                    <div class="form-group col-md-4 @if($errors->has('cliente_id')) has-error @endif">
                       <label for="cliente_id-field" style="clear:both;">Cliente</label>
                       {!! Form::select("cliente_id", $list["Cliente"], null, array("class" => "form-control select_seguridad", "id" => "cliente_id-field", 'style'=>'width:90%')) !!}
                       <input type="button" class="btn btn-primary" value="..." onclick="SeleccionarCliente()" />
                       @if($errors->has("cliente_id"))
                        <span class="help-block">{{ $errors->first("cliente_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('empleado_id')) has-error @endif">
                       <label for="empleado_id-field">Empleado</label>
                       {!! Form::select("empleado_id", $list["Empleado"], null, array("class" => "form-control select_seguridad", "id" => "empleado_id-field")) !!}
                       @if($errors->has("empleado_id"))
                        <span class="help-block">{{ $errors->first("empleado_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('tarea_id')) has-error @endif">
                       <label for="tarea_id-field">Tarea</label>
                       {!! Form::select("tarea_id", $list["Tarea"], null, array("class" => "form-control select_seguridad", "id" => "tarea_id-field")) !!}
                       @if($errors->has("tarea_id"))
                        <span class="help-block">{{ $errors->first("tarea_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('asunto_id')) has-error @endif" style="clear:left;">
                       <label for="asunto_id-field">Asunto</label>
                       {!! Form::select("asunto_id", $list["Asunto"], null, array("class" => "form-control select_seguridad", "id" => "asunto_id-field")) !!}
                       @if($errors->has("asunto_id"))
                        <span class="help-block">{{ $errors->first("asunto_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('detalle')) has-error @endif">
                       <label for="detalle-field">Detalle</label>
                       {!! Form::text("detalle", null, array("class" => "form-control", "id" => "detalle-field")) !!}
                       @if($errors->has("detalle"))
                        <span class="help-block">{{ $errors->first("detalle") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('st_tarea_id')) has-error @endif">
                       <label for="st_tarea_id-field">Estatus</label>
                       {!! Form::select("st_tarea_id", $list["StTarea"], null, array("class" => "form-control select_seguridad", "id" => "st_tarea_id-field")) !!}
                       @if($errors->has("st_tarea_id"))
                        <span class="help-block">{{ $errors->first("st_tarea_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-12 @if($errors->has('observaciones')) has-error @endif">
                       <label for="observaciones-field">Observaciones</label>
                       {!! Form::text("observaciones", null, array("class" => "form-control", "id" => "observaciones-field")) !!}
                       
                       @if($errors->has("observaciones"))
                        <span class="help-block">{{ $errors->first("observaciones") }}</span>
                       @endif
                    </div>
@push('scripts')
<script>
  var popup;
  function SeleccionarCliente() {
      popup = window.open("{{route('clientes.indexList')}}", "Popup", "width=800,height=350");
      popup.focus();
      return false
  }
  
</script>
@endpush