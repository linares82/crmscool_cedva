                <div class="form-group col-md-4 @if($errors->has('pregunta_id')) has-error @endif">
                       <label for="pregunta_id-field">Pregunta_id</label>
                       {!! Form::text("pregunta_id", null, array("class" => "form-control", "id" => "pregunta_id-field")) !!}
                       @if($errors->has("pregunta_id"))
                        <span class="help-block">{{ $errors->first("pregunta_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('cliente_id')) has-error @endif">
                       <label for="cliente_id-field">Cliente_id</label>
                       {!! Form::text("cliente_id", null, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                       @if($errors->has("cliente_id"))
                        <span class="help-block">{{ $errors->first("cliente_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('respuesta')) has-error @endif">
                       <label for="respuesta-field">Respuesta</label>
                       {!! Form::text("respuesta", null, array("class" => "form-control", "id" => "respuesta-field")) !!}
                       @if($errors->has("respuesta"))
                        <span class="help-block">{{ $errors->first("respuesta") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('usu_alta_id')) has-error @endif">
                       <label for="usu_alta_id-field">Usu_alta_id</label>
                       {!! Form::text("usu_alta_id", null, array("class" => "form-control", "id" => "usu_alta_id-field")) !!}
                       @if($errors->has("usu_alta_id"))
                        <span class="help-block">{{ $errors->first("usu_alta_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('usu_mod_id')) has-error @endif">
                       <label for="usu_mod_id-field">Usu_mod_id</label>
                       {!! Form::text("usu_mod_id", null, array("class" => "form-control", "id" => "usu_mod_id-field")) !!}
                       @if($errors->has("usu_mod_id"))
                        <span class="help-block">{{ $errors->first("usu_mod_id") }}</span>
                       @endif
                    </div>