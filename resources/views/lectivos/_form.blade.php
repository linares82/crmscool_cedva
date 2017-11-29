                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('activo')) has-error @endif">
                       <label for="activo-field">Activo</label>
                       {!! Form::checkbox("activo", 1, null, [ "id" => "activo-field"]) !!}
                       @if($errors->has("activo"))
                        <span class="help-block">{{ $errors->first("activo") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('bachillerato_bnd')) has-error @endif">
                       <label for="bachillerato_bnd-field">bachillerato</label>
                       {!! Form::checkbox("bachillerato_bnd", 1, null, [ "id" => "bachillerato_bnd-field"]) !!}
                       @if($errors->has("bachillerato_bnd"))
                        <span class="help-block">{{ $errors->first("bachillerato_bnd") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('carrera_bnd')) has-error @endif">
                       <label for="activo-field">Carrera</label>
                       {!! Form::checkbox("carrera_bnd", 1, null, [ "id" => "activo-field"]) !!}
                       @if($errors->has("carrera_bnd"))
                        <span class="help-block">{{ $errors->first("carrera_bnd") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('inicio')) has-error @endif">
                       <label for="inicio-field">Inicio</label>
                       {!! Form::text("inicio", null, array("class" => "form-control", "id" => "inicio-field")) !!}
                       @if($errors->has("inicio"))
                        <span class="help-block">{{ $errors->first("inicio") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('fin')) has-error @endif">
                       <label for="fin-field">Fin</label>
                       {!! Form::text("fin", null, array("class" => "form-control", "id" => "fin-field")) !!}
                       @if($errors->has("fin"))
                        <span class="help-block">{{ $errors->first("fin") }}</span>
                       @endif
                    </div>

@push('scripts')
<script>
  //  $(document).ready(function() {
      
      // assuming the controls you want to attach the plugin to
      // have the "datepicker" class set
      //Campo de fecha
      $('#inicio-field').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        readonly_element: false,
        lang_clear_date: 'Limpiar',
        show_select_today: 'Hoy',
      });

      $('#fin-field').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        readonly_element: false,
        lang_clear_date: 'Limpiar',
        show_select_today: 'Hoy',
      });
//    )};
</script>

@endpush