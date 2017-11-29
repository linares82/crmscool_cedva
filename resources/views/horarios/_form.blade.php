                <div class="form-group @if($errors->has('asignacion_academica_id')) has-error @endif">
                       <label for="asignacion_academica_id-field">Asignacion_academica_id</label>
                       {!! Form::text("asignacion_academica_id", null, array("class" => "form-control", "id" => "asignacion_academica_id-field")) !!}
                       @if($errors->has("asignacion_academica_id"))
                        <span class="help-block">{{ $errors->first("asignacion_academica_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('dia_id')) has-error @endif">
                       <label for="dia_id-field">Dia_id</label>
                       {!! Form::text("dia_id", null, array("class" => "form-control", "id" => "dia_id-field")) !!}
                       @if($errors->has("dia_id"))
                        <span class="help-block">{{ $errors->first("dia_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('hora')) has-error @endif">
                       <label for="hora-field">Hora</label>
                       {!! Form::text("hora", null, array("class" => "form-control", "id" => "hora-field")) !!}
                       @if($errors->has("hora"))
                        <span class="help-block">{{ $errors->first("hora") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('duracion_clase')) has-error @endif">
                       <label for="duracion_clase-field">Duracion_clase</label>
                       {!! Form::text("duracion_clase", null, array("class" => "form-control", "id" => "duracion_clase-field")) !!}
                       @if($errors->has("duracion_clase"))
                        <span class="help-block">{{ $errors->first("duracion_clase") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('lectivo_id')) has-error @endif">
                       <label for="lectivo_id-field">Lectivo_name</label>
                       {!! Form::select("lectivo_id", $list["Lectivo"], null, array("class" => "form-control", "id" => "lectivo_id-field")) !!}
                       @if($errors->has("lectivo_id"))
                        <span class="help-block">{{ $errors->first("lectivo_id") }}</span>
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