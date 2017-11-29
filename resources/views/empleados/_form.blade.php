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
                      <div class="form-group col-md-4 @if($errors->has('rfc')) has-error @endif">
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
                        <div class="form-group col-md-4 @if($errors->has('puesto_id')) has-error @endif">
                          <label for="puesto_id-field">Puesto</label>
                          {!! Form::select("puesto_id", $list["Puesto"], null, array("class" => "form-control select_seguridad", "id" => "puesto_id-field")) !!}
                          @if($errors->has("puesto_id"))
                            <span class="help-block">{{ $errors->first("puesto_id") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('area_id')) has-error @endif">
                          <label for="area_id-field">Area</label>
                          {!! Form::select("area_id", $list["Area"], null, array("class" => "form-control select_seguridad", "id" => "area_id-field")) !!}
                          @if($errors->has("area_id"))
                            <span class="help-block">{{ $errors->first("area_id") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-1 @if($errors->has('jefe_bnd')) has-error @endif">
                          <label for="jefe_bnd-field">Tiene subordinados?</label>
                          {!! Form::checkbox("jefe_bnd", 1, null, [ "id" => "jefe_bnd-field"]) !!}
                          @if($errors->has("jefe_bnd"))
                            <span class="help-block">{{ $errors->first("jefe_bnd") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('jefe_id')) has-error @endif">
                          <label for="jefe_id-field">Jefe</label>
                          {!! Form::select("jefe_id", $jefes, null, array("class" => "form-control select_seguridad", "id" => "jefe_id-field")) !!}
                          @if($errors->has("jefe_id"))
                            <span class="help-block">{{ $errors->first("resp_alerta_id") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                          <label for="plantel_id-field">Plantel</label>
                          {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
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
                            {!! Form::select("user_id", $list["User"], null, array("class" => "form-control select_seguridad", "id" => "user_id-field")) !!}
                            @if($errors->has("user_id"))
                              <span class="help-block">{{ $errors->first("user_id") }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-2 @if($errors->has('genero')) has-error @endif">
                          <label for="Genero-field">Género</label><br/>
                          <div class="form-group col-md-6 @if($errors->has('genero')) has-error @endif">
                            {!! Form::radio("genero", 1, null, [ "id" => "genero-field"]) !!}
                            <label for="Genero-field">Masculino</label>
                          </div>
                          <div class="form-group col-md-6 @if($errors->has('genero')) has-error @endif">
                            {!! Form::radio("genero", 2, null, [ "id" => "genero-field"]) !!}
                            <label for="Genero-field">Femenino</label>
                          </div>
                          
                          @if($errors->has("genero_bnd"))
                            <span class="help-block">{{ $errors->first("genero") }}</span>
                          @endif
                        </div>  
                        <div class="form-group col-md-2 @if($errors->has('extranjero_bnd')) has-error @endif">
                          <label for="extranjero_bnd-field">Extranjero</label>
                          {!! Form::checkbox("extranjero_bnd", 1, null, [ "id" => "extranjero_bnd-field"]) !!}
                          @if($errors->has("extranjero_bnd"))
                            <span class="help-block">{{ $errors->first("extranjero_bnd") }}</span>
                          @endif
                        </div>  
                        <div class="form-group col-md-3 @if($errors->has('alimenticia_bnd')) has-error @endif">
                          <label for="alimenticia_bnd-field">Proporciona pensión alimenticia</label>
                          {!! Form::checkbox("alimenticia_bnd", 1, null, [ "id" => "alimenticia_bnd-field"]) !!}
                          @if($errors->has("alimenticia_bnd"))
                            <span class="help-block">{{ $errors->first("alimenticia_bnd") }}</span>
                          @endif
                        </div>  
                      </div>
                    </div>
                    
                    
                    <div class="box box-default">
                      <div class="box-body">
                        <div class="form-group col-md-1 @if($errors->has('alerta_bnd')) has-error @endif">
                          <label for="alerta_bnd-field">Alerta</label>
                          {!! Form::checkbox("alerta_bnd", 1, null, [ "id" => "alerta_bnd-field"]) !!}
                          @if($errors->has("alerta_bnd"))
                            <span class="help-block">{{ $errors->first("alerta_bnd") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-3 @if($errors->has('fin_contrato')) has-error @endif">
                          <label for="fin_contrato-field">Fin Contrato</label>
                          {!! Form::text("fin_contrato", null, array("class" => "form-control", "id" => "fin_contrato-field")) !!}
                          @if($errors->has("fin_contrato"))
                            <span class="help-block">{{ $errors->first("fin_contrato") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('resp_alerta_id')) has-error @endif">
                          <label for="resp_alerta_id-field">Reponsable</label>
                          {!! Form::select("resp_alerta_id", $responsables, null, array("class" => "form-control select_seguridad", "id" => "resp_alerta_id-field")) !!}
                          @if($errors->has("resp_alerta_id"))
                            <span class="help-block">{{ $errors->first("resp_alerta_id") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-4 @if($errors->has('dias_alerta')) has-error @endif">
                          <label for="dias_alerta-field">Dias Alerta</label>
                          {!! Form::text("dias_alerta", null, array("class" => "form-control", "id" => "dias_alerta-field")) !!}
                          @if($errors->has("dias_alerta"))
                            <span class="help-block">{{ $errors->first("dias_alerta") }}</span>
                          @endif
                        </div>

                      
                      </div>
                    </div>
                    @if(isset($empleado))
                    <div class="box box-default">
                      <div class="box-body">
                        <div class="form-group col-md-6 @if($errors->has('doc_empleado_id')) has-error @endif">
                          <label for="doc_empleado_id-field">Documento</label>
                          {!! Form::select("doc_empleado_id", $list1["DocEmpleado"], null, array("class" => "form-control select_seguridad", "id" => "doc_empleado_id-field")) !!}
                          @if($errors->has("doc_empleado_id"))
                            <span class="help-block">{{ $errors->first("doc_empleado_id") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-6 @if($errors->has('archivo')) has-error @endif">
                          <button type="button" onclick="BrowseServer('archivo-field');">Elegir Archivo</button>
                          {!! Form::text("archivo", null, array("class" => "form-control", "id" => "archivo-field")) !!}
                          @if($errors->has("archivo"))
                            <span class="help-block">{{ $errors->first("archivo") }}</span>
                          @endif
                        </div>
                        <div class="form-group col-md-6">
                          <table class="table table-condensed table-striped">
                            <thead>
                              <tr>
                                <th>Documento Agregados</th><th>Link</th><th></th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($empleado->pivotDocEmpleado as $doc)
                              <tr>
                                <td>
                                  {{$doc->docEmpleado->name}}
                                </td>
                                <td>
                                  <a href="{{$doc->archivo}}" target="_blank">Ver</a>
                                </td>
                                <td>
                                  <a class="btn btn-xs btn-danger" href="{{route('pivotDocEmpleados.destroy', $doc->id)}}">Eliminar</a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div class="form-group col-md-6">
                          <table class="table table-condensed table-striped">
                            <thead>
                              <tr>
                                <th>Documentos Faltantes</th><th>Obligatorio</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($documentos_faltantes as $df)
                              <tr>
                                <td>
                                  {{ $df->name }}
                                </td>
                                <td>
                                  @if($df->doc_obligatorio == 1)
                                    <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                                  @else
                                    @if($empleado->extranjero_bnd==1 and $df->id==18)
                                      <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                                    @elseif($empleado->alimenticia_bnd==1 and $df->id==17)
                                      <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                                    @elseif($empleado->genero==1 and $df->id==14)
                                      <button class="btn btn-success btn-xs"><span class="glyphicon glyphicon-ok"></span></button>
                                    @else
                                      <button class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button>
                                    @endif
                                    
                                  @endif
                                </td>
                                
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    @endif
                    
@push('scripts')
<script src="{{ asset ('/bower_components/AdminLTE/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset ('/bower_components/AdminLTE/plugins/tinymce/js/tinymce/tinymce_editor.js') }}"></script>
<script type="text/javascript">
  $('#fin_contrato-field').Zebra_DatePicker({
        days:['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
        months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        readonly_element: false,
        lang_clear_date: 'Limpiar',
        show_select_today: 'Hoy',
      });
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

    //codigo de trabajo del cargador de imagenes
    // File Picker modification for FCK Editor v2.0 - www.fckeditor.net
     // by: Pete Forde <pete@unspace.ca> @ Unspace Interactive
     var urlobj;

     function BrowseServer(obj)
     {
          urlobj = obj;
          OpenServerBrowser(
          "{{ url('filemanager/show') }}",
          screen.width * 0.7,
          screen.height * 0.7 ) ;
     }

     function OpenServerBrowser( url, width, height )
     {
          var iLeft = (screen.width - width) / 2 ;
          var iTop = (screen.height - height) / 2 ;
          var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
          sOptions += ",width=" + width ;
          sOptions += ",height=" + height ;
          sOptions += ",left=" + iLeft ;
          sOptions += ",top=" + iTop ;
          var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
     }

     function SetUrl( url, width, height, alt )
     {
          document.getElementById(urlobj).value = url ;
          oWindow = null;
     }

</script>

@endpush