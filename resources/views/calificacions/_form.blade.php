                <div class="form-group @if($errors->has('hacademica_id')) has-error @endif">
                       <label for="hacademica_id-field">Hacademica_id</label>
                       {!! Form::text("hacademica_id", null, array("class" => "form-control", "id" => "hacademica_id-field")) !!}
                       @if($errors->has("hacademica_id"))
                        <span class="help-block">{{ $errors->first("hacademica_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('examen_id')) has-error @endif">
                       <label for="examen_id-field">Examen_id</label>
                       {!! Form::text("examen_id", null, array("class" => "form-control", "id" => "examen_id-field")) !!}
                       @if($errors->has("examen_id"))
                        <span class="help-block">{{ $errors->first("examen_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('calificacion')) has-error @endif">
                       <label for="calificacion-field">Calificacion</label>
                       {!! Form::text("calificacion", null, array("class" => "form-control", "id" => "calificacion-field")) !!}
                       @if($errors->has("calificacion"))
                        <span class="help-block">{{ $errors->first("calificacion") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('fecha')) has-error @endif">
                       <label for="fecha-field">Fecha</label>
                       {!! Form::text("fecha", null, array("class" => "form-control", "id" => "fecha-field")) !!}
                       @if($errors->has("fecha"))
                        <span class="help-block">{{ $errors->first("fecha") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('reporte_bnd')) has-error @endif">
                       <label for="reporte_bnd-field">Reporte_bnd</label>
                       {!! Form::text("reporte_bnd", null, array("class" => "form-control", "id" => "reporte_bnd-field")) !!}
                       @if($errors->has("reporte_bnd"))
                        <span class="help-block">{{ $errors->first("reporte_bnd") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('usu_alta_id')) has-error @endif">
                       <label for="usu_alta_id-field">Usu_alta_id</label>
                       {!! Form::text("usu_alta_id", null, array("class" => "form-control", "id" => "usu_alta_id-field")) !!}
                       @if($errors->has("usu_alta_id"))
                        <span class="help-block">{{ $errors->first("usu_alta_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('usu_mod_id')) has-error @endif">
                       <label for="usu_mod_id-field">Usu_mod_id</label>
                       {!! Form::text("usu_mod_id", null, array("class" => "form-control", "id" => "usu_mod_id-field")) !!}
                       @if($errors->has("usu_mod_id"))
                        <span class="help-block">{{ $errors->first("usu_mod_id") }}</span>
                       @endif
                    </div>