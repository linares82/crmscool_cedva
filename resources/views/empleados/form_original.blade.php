                    <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-4 @if($errors->has('cve_empleado')) has-error @endif">
                         <label for="cve_empleado-field">Clave Empleado</label>
                         {!! Form::text("cve_empleado", null, array("class" => "form-control", "id" => "cve_empleado-field")) !!}
                         @if($errors->has("cve_empleado"))
                          <span class="help-block">{{ $errors->first("cve_empleado") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('nombre')) has-error @endif">
                         <label for="nombre-field">Nombre</label>
                         {!! Form::text("nombre", null, array("class" => "form-control", "id" => "nombre-field")) !!}
                         @if($errors->has("nombre"))
                          <span class="help-block">{{ $errors->first("nombre") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('ape_paterno')) has-error @endif">
                         <label for="ape_paterno-field">A. Paterno</label>
                         {!! Form::text("ape_paterno", null, array("class" => "form-control", "id" => "ape_paterno-field")) !!}
                         @if($errors->has("ape_paterno"))
                          <span class="help-block">{{ $errors->first("ape_paterno") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('ape_materno')) has-error @endif">
                         <label for="ape_materno-field">A. Materno</label>
                         {!! Form::text("ape_materno", null, array("class" => "form-control", "id" => "ape_materno-field")) !!}
                         @if($errors->has("ape_materno"))
                          <span class="help-block">{{ $errors->first("ape_materno") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('puesto_id')) has-error @endif">
                         <label for="puesto_id-field">Puesto</label>
                         {!! Form::select("puesto_id", $list["Puesto"], null, array("class" => "form-control", "id" => "puesto_id-field")) !!}
                         @if($errors->has("puesto_id"))
                          <span class="help-block">{{ $errors->first("puesto_id") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('area_id')) has-error @endif">
                         <label for="area_id-field">Area</label>
                         {!! Form::select("area_id", $list["Area"], null, array("class" => "form-control", "id" => "area_id-field")) !!}
                         @if($errors->has("area_id"))
                          <span class="help-block">{{ $errors->first("area_id") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('rfc')) has-error @endif" style="clear:left;">
                         <label for="rfc-field">RFC</label>
                         {!! Form::text("rfc", null, array("class" => "form-control", "id" => "rfc-field")) !!}
                         @if($errors->has("rfc"))
                          <span class="help-block">{{ $errors->first("rfc") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('curp')) has-error @endif">
                         <label for="curp-field">CURP</label>
                         {!! Form::text("curp", null, array("class" => "form-control", "id" => "curp-field")) !!}
                         @if($errors->has("curp"))
                          <span class="help-block">{{ $errors->first("curp") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('direccion')) has-error @endif">
                         <label for="direccion-field">Dirección</label>
                         {!! Form::text("direccion", null, array("class" => "form-control", "id" => "direccion-field")) !!}
                         @if($errors->has("direccion"))
                          <span class="help-block">{{ $errors->first("direccion") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('tel_fijo')) has-error @endif">
                         <label for="tel_fijo-field">Teléfono</label>
                         {!! Form::text("tel_fijo", null, array("class" => "form-control", "id" => "tel_fijo-field")) !!}
                         @if($errors->has("tel_fijo"))
                          <span class="help-block">{{ $errors->first("tel_fijo") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('tel_cel')) has-error @endif">
                         <label for="tel_cel-field">Celular</label>
                         {!! Form::text("tel_cel", null, array("class" => "form-control", "id" => "tel_cel-field")) !!}
                         @if($errors->has("tel_cel"))
                          <span class="help-block">{{ $errors->first("tel_cel") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cel_empresa')) has-error @endif">
                         <label for="cel_empresa-field">Celular Empresa</label>
                         {!! Form::text("cel_empresa", null, array("class" => "form-control", "id" => "cel_empresa-field")) !!}
                         @if($errors->has("cel_empresa"))
                          <span class="help-block">{{ $errors->first("cel_empresa") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('mail')) has-error @endif">
                         <label for="mail-field">Correo Electrónico</label>
                         {!! Form::text("mail", null, array("class" => "form-control", "id" => "mail-field")) !!}
                         @if($errors->has("mail"))
                          <span class="help-block">{{ $errors->first("mail") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('mail_empresa')) has-error @endif">
                         <label for="mail_empresa-field">Correo Electrónico Empresa</label>
                         {!! Form::text("mail_empresa", null, array("class" => "form-control", "id" => "mail_empresa-field")) !!}
                         @if($errors->has("mail_empresa"))
                          <span class="help-block">{{ $errors->first("mail_empresa") }}</span>
                         @endif
                      </div>
                      </div>
                    </div>
                    <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                         <label for="plantel_id-field">Plantel</label>
                         {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control", "id" => "plantel_id-field")) !!}
                         @if($errors->has("plantel_id"))
                          <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                         @endif
                      </div>
                    
                      <div class="form-group col-md-4 @if($errors->has('stpuesto_id')) has-error @endif">
                        <label for="stpuesto_id-field">Estatus</label>
                        {!! Form::select("st_empleado_id", $list["StEmpleado"], null, array("class" => "form-control", "id" => "st_empleado_id-field")) !!}
                        @if($errors->has("st_empleado_id"))
                          <span class="help-block">{{ $errors->first("stpuesto_id") }}</span>
                        @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('user_id')) has-error @endif">
                          <label for="plantel_id-field">Usuario 
                              @permission('entrust')
                              <a href="{!! route('entrust-gui::users.create') !!}" target="_blank">Crear usuario</a>
                              @endpermission
                            </label>
                          {!! Form::select("user_id", $list["User"], null, array("class" => "form-control", "id" => "user_id-field")) !!}
                          @if($errors->has("user_id"))
                            <span class="help-block">{{ $errors->first("user_id") }}</span>
                          @endif
                        </div>
                      </div>
                      </div>
                    <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-6 @if($errors->has('foto')) has-error @endif">
                         <label for="foto-field">Foto</label>
                         {!! Form::text("foto", null, array("class" => "form-control", "id" => "foto-field", 'readonly'=>'readonly')) !!}
                         {!! Form::file('foto_file') !!}
                         @if (isset($empleado))
                          <img src="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->foto) !!}" alt="Foto" height="100"> </img>
                         @endif
                         @if($errors->has("foto"))
                          <span class="help-block">{{ $errors->first("foto") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-6 @if($errors->has('identificacion')) has-error @endif">
                         <label for="identificacion-field">Identificación</label>
                         {!! Form::text("identificacion", null, array("class" => "form-control", "id" => "identificacion-field", 'readonly'=>'readonly')) !!}
                         {!! Form::file('identificacion_file') !!}
                         @if (isset($empleado))
                          <img src="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->identificacion) !!}" alt="Identificacion" height="100"> </img>
                         @endif
                         @if($errors->has("identificacion"))
                          <span class="help-block">{{ $errors->first("identificacion") }}</span>
                         @endif
                      </div>
                      </div>
                    </div>
                    <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-6 @if($errors->has('contrato')) has-error @endif">
                         <label for="contrato-field">Contrato</label>
                         {!! Form::text("contrato", null, array("class" => "form-control", "id" => "contrato-field", 'readonly'=>'readonly')) !!}
                         {!! Form::file('contrato_file') !!}
                         @if (isset($empleado))
                          <a href="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->contrato) !!}" target="_blank"> {!! $empleado->contrato !!} </a>
                         @endif
                         @if($errors->has("contrato"))
                          <span class="help-block">{{ $errors->first("contrato") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-6 @if($errors->has('evaluacion_psico')) has-error @endif">
                         <label for="evaluacion_psico-field">Evaluación Psicométrica</label>
                         {!! Form::text("evaluacion_psico", null, array("class" => "form-control", "id" => "evaluacion_psico-field", 'readonly'=>'readonly')) !!}
                         {!! Form::file('evaluacion_psico_file') !!}
                         @if (isset($empleado))
                          <a href="{!! asset('imagenes/empleados/'.$empleado->id.'/'.$empleado->evaluacion_psico) !!}" target="_blank"> {!! $empleado->evaluacion_psico !!} </a>
                         @endif
                         @if($errors->has("evaluacion_psico"))
                          <span class="help-block">{{ $errors->first("evaluacion_psico") }}</span>
                         @endif
                      </div>
                      </div>
                    </div>
                    
@push('scripts')
<script type="text/javascript">
$('#user_id-field').select2({
            placeholder: 'Enter a tag',
            ajax: {
                dataType: 'json',
                url: '{{ route("empleados.usuarios") }}',
                delay: 400,
                data: function(params) {
                    return {
                        term: params.term
                    }
                },
                processResults: function (data, page) {
                  return {
                    results: data
                  };
                },
            }
});
</script>
@endpush