
@foreach($errors as $e)
{{ $e }}</p>
@endforeach

<div class="box box-default">
                      <div class="box-body"> 
                      <div class="form-group col-md-4 @if($errors->has('cve_plantel')) has-error @endif">
                         <label for="cve_plantel-field">Clave Plantel</label>
                         {!! Form::text("cve_plantel", null, array("class" => "form-control", "id" => "cve_plantel-field")) !!}
                         @if($errors->has("cve_plantel"))
                          <span class="help-block">{{ $errors->first("cve_plantel") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('tpo_plantel_id')) has-error @endif">
                         <label for="tpo_plantel_id-field">Tipo Plantel</label>
                         {!! Form::select("tpo_plantel_id", $list["TpoPlantel"], null, array("class" => "form-control select_seguridad", "id" => "tpo_plantel_id-field")) !!}
                         @if($errors->has("tpo_plantel_id"))
                          <span class="help-block">{{ $errors->first("tpo_plantel_id") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('razon')) has-error @endif">
                         <label for="razon-field">Razón Social</label>
                         {!! Form::text("razon", null, array("class" => "form-control", "id" => "razon-field")) !!}
                         @if($errors->has("razon"))
                          <span class="help-block">{{ $errors->first("razon") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('rfc')) has-error @endif">
                         <label for="rfc-field">RFC</label>
                         {!! Form::text("rfc", null, array("class" => "form-control", "id" => "rfc-field")) !!}
                         @if($errors->has("rfc"))
                          <span class="help-block">{{ $errors->first("rfc") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cve_incorporacion')) has-error @endif">
                         <label for="cve_incorporacion-field">Clave Incorporacion</label>
                         {!! Form::text("cve_incorporacion", null, array("class" => "form-control", "id" => "cve_incorporacion-field")) !!}
                         @if($errors->has("cve_incorporacion"))
                          <span class="help-block">{{ $errors->first("cve_incorporacion") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('rvoe')) has-error @endif">
                         <label for="rvoe-field">RVOE</label>
                         {!! Form::text("rvoe", null, array("class" => "form-control", "id" => "cve_incorporacion-field")) !!}
                         @if($errors->has("rvoe"))
                          <span class="help-block">{{ $errors->first("rvoe") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cct')) has-error @endif">
                         <label for="cct-field">CCT</label>
                         {!! Form::text("cct", null, array("class" => "form-control", "id" => "cct-field")) !!}
                         @if($errors->has("cct"))
                          <span class="help-block">{{ $errors->first("cct") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cns_empleado')) has-error @endif">
                         <label for="cns_empleado-field">Consecutivo Empleado</label>
                         {!! Form::text("cns_empleado", null, array("class" => "form-control", "id" => "cns_empleado-field", 'readonly'=>'readonly')) !!}
                         @if($errors->has("cns_empleado"))
                          <span class="help-block">{{ $errors->first("cns_empleado") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cns_alumno')) has-error @endif">
                         <label for="cns_alumno-field">Consecutivo Alumno</label>
                         {!! Form::text("cns_alumno", null, array("class" => "form-control", "id" => "cns_alumno-field", 'readonly'=>'readonly')) !!}
                         @if($errors->has("cns_alumno"))
                          <span class="help-block">{{ $errors->first("cns_alumno") }}</span>
                         @endif
                      </div>
                    </div>
                  </div>
                  <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-4 @if($errors->has('calle')) has-error @endif">
                         <label for="calle-field">Calle</label>
                         {!! Form::text("calle", null, array("class" => "form-control", "id" => "calle-field")) !!}
                         @if($errors->has("calle"))
                          <span class="help-block">{{ $errors->first("calle") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('no_int')) has-error @endif">
                         <label for="no_int-field">No. int.</label>
                         {!! Form::text("no_int", null, array("class" => "form-control", "id" => "no_int-field")) !!}
                         @if($errors->has("no_int"))
                          <span class="help-block">{{ $errors->first("no_int") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('no_ext')) has-error @endif">
                         <label for="no_ext-field">No. ext.</label>
                         {!! Form::text("no_ext", null, array("class" => "form-control", "id" => "no_ext-field")) !!}
                         @if($errors->has("no_ext"))
                          <span class="help-block">{{ $errors->first("no_ext") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('colonia')) has-error @endif">
                         <label for="colonia-field">Colonia</label>
                         {!! Form::text("colonia", null, array("class" => "form-control", "id" => "colonia-field")) !!}
                         @if($errors->has("colonia"))
                          <span class="help-block">{{ $errors->first("colonia") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('cp')) has-error @endif">
                         <label for="cp-field">C.P.</label>
                         {!! Form::text("cp", null, array("class" => "form-control", "id" => "cp-field")) !!}
                         @if($errors->has("cp"))
                          <span class="help-block">{{ $errors->first("cp") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('municipio')) has-error @endif">
                         <label for="municipio-field">Municipio</label>
                         {!! Form::text("municipio", null, array("class" => "form-control", "id" => "municipio-field")) !!}
                         @if($errors->has("municipio"))
                          <span class="help-block">{{ $errors->first("municipo") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('estado')) has-error @endif">
                         <label for="estado-field">Estado</label>
                         {!! Form::text("estado", null, array("class" => "form-control", "id" => "estado-field")) !!}
                         @if($errors->has("estado"))
                          <span class="help-block">{{ $errors->first("estado") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('tel')) has-error @endif">
                         <label for="tel-field">Teléfono</label>
                         {!! Form::text("tel", null, array("class" => "form-control", "id" => "tel-field")) !!}
                         @if($errors->has("tel"))
                          <span class="help-block">{{ $errors->first("tel") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('mail')) has-error @endif">
                         <label for="mail-field">Correo Electrónico</label>
                         {!! Form::text("mail", null, array("class" => "form-control", "id" => "mail-field")) !!}
                         @if($errors->has("mail"))
                          <span class="help-block">{{ $errors->first("mail") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('pag_web')) has-error @endif">
                         <label for="pag_web-field">Página Web</label>
                         {!! Form::text("pag_web", null, array("class" => "form-control", "id" => "pag_web-field")) !!}
                         @if($errors->has("pag_web"))
                          <span class="help-block">{{ $errors->first("pag_web") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('lectivo_id')) has-error @endif">
                         <label for="lectivo_id-field">Periodo Lectivo</label>
                         {!! Form::select("lectivo_id", $list["Lectivo"], null, array("class" => "form-control select_seguridad", "id" => "lectivo_id-field")) !!}
                         @if($errors->has("lectivo_id"))
                          <span class="help-block">{{ $errors->first("lectivo_id") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('meta_venta')) has-error @endif">
                         <label for="meta_venta-field">Meta Total Empleado</label>
                         {!! Form::text("meta_venta", null, array("class" => "form-control", "id" => "meta_venta-field")) !!}
                         @if($errors->has("meta_venta"))
                          <span class="help-block">{{ $errors->first("meta_venta") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('meta_total')) has-error @endif">
                         <label for="meta_total-field">Meta Total</label>
                         {!! Form::text("meta_total", null, array("class" => "form-control", "id" => "meta_total-field")) !!}
                         @if($errors->has("meta_total"))
                          <span class="help-block">{{ $errors->first("meta_total") }}</span>
                         @endif
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('st_plantel_id')) has-error @endif">
                         <label for="st_plantel_id-field">Estatus</label>
                         {!! Form::select("st_plantel_id", $list["StPlantel"], null, array("class" => "form-control select_seguridad", "id" => "st_plantel_id-field")) !!}
                         @if($errors->has("st_plantel_id"))
                          <span class="help-block">{{ $errors->first("st_plantel_id") }}</span>
                         @endif
                      </div>
                    </div>
                  </div>
                    <div class="box box-default" style>
                      <div class="box-body">
                      <div class="form-group col-md-4 @if($errors->has('director')) has-error @endif">
                         <label for="director-field">Director</label>
                         
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('director_tel')) has-error @endif">
                         <label for="director_tel-field">Director Teléfono</label>
                         
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('director_mail')) has-error @endif">
                         <label for="director_mail-field">Director Correo Electrónico</label>
                         
                      </div>
                    </div>
                    </div>
                    <div class="box box-default">
                      <div class="box-body">
                      <div class="form-group col-md-4 @if($errors->has('rep_legal')) has-error @endif">
                         <label for="rep_legal-field">Representante Legal</label>
                         
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('rep_legal_tel')) has-error @endif">
                         <label for="rep_legal_tel-field">Representante Legal Teléfono</label>
                         
                      </div>
                      <div class="form-group col-md-4 @if($errors->has('rep_legal_mail')) has-error @endif">
                         <label for="rep_legal_mail-field">Representante Legal Correo Eletrónico</label>
                         
                      </div>
                      </div>
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('logo')) has-error @endif">
                       <label for="logo-field">Logo</label>
                       {!! Form::text("logo", null, array("class" => "form-control", "id" => "logo-field", 'readonly'=>'readonly')) !!}
                       {!! Form::file('logo_file') !!}
                       @if (isset($plantel))
                       <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->logo) !!}" alt="Logo" height="100"> </img>
                       @endif
                       @if($errors->has("logo"))
                        <span class="help-block">{{ $errors->first("logo") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('slogan')) has-error @endif">
                       <label for="slogan-field">Slogan</label>
                       {!! Form::text("slogan", null, array("class" => "form-control", "id" => "slogan-field", 'readonly'=>'readonly')) !!}
                       {!! Form::file('slogan_file') !!}
                       @if (isset($plantel))
                       <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->slogan) !!}" alt="Logo" height="100"> </img>
                       @endif
                       @if($errors->has("slogan"))
                        <span class="help-block">{{ $errors->first("slogan") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('membrete')) has-error @endif">
                       <label for="membrete-field">Membrete</label>
                       {!! Form::text("membrete", null, array("class" => "form-control", "id" => "membrete-field", 'readonly'=>'readonly')) !!}
                       {!! Form::file('membrete_file') !!}
                       @if (isset($plantel))
                       <img src="{!! asset('imagenes/planteles/'.$plantel->id.'/'.$plantel->membrete) !!}" alt="Logo" height="100"> </img>
                       @endif
                       @if($errors->has("membrete"))
                        <span class="help-block">{{ $errors->first("membrete") }}</span>
                       @endif
                    </div>