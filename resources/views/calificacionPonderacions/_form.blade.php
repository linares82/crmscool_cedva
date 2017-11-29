                <div class="form-group @if($errors->has('calificacion_id')) has-error @endif">
                       <label for="calificacion_id-field">Calificacion_id</label>
                       {!! Form::text("calificacion_id", null, array("class" => "form-control", "id" => "calificacion_id-field")) !!}
                       @if($errors->has("calificacion_id"))
                        <span class="help-block">{{ $errors->first("calificacion_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('ponderacion_id')) has-error @endif">
                       <label for="ponderacion_id-field">Ponderacion_id</label>
                       {!! Form::text("ponderacion_id", null, array("class" => "form-control", "id" => "ponderacion_id-field")) !!}
                       @if($errors->has("ponderacion_id"))
                        <span class="help-block">{{ $errors->first("ponderacion_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('calificacion_parcial')) has-error @endif">
                       <label for="calificacion_parcial-field">Calificacion_parcial</label>
                       {!! Form::text("calificacion_parcial", null, array("class" => "form-control", "id" => "calificacion_parcial-field")) !!}
                       @if($errors->has("calificacion_parcial"))
                        <span class="help-block">{{ $errors->first("calificacion_parcial") }}</span>
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