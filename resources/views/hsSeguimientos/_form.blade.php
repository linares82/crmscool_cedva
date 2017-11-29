                <div class="form-group @if($errors->has('seguimiento_id')) has-error @endif">
                       <label for="seguimiento_id-field">Seguimiento_id</label>
                       {!! Form::text("seguimiento_id", null, array("class" => "form-control", "id" => "seguimiento_id-field")) !!}
                       @if($errors->has("seguimiento_id"))
                        <span class="help-block">{{ $errors->first("seguimiento_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('cliente_id')) has-error @endif">
                       <label for="cliente_id-field">Cliente_id</label>
                       {!! Form::text("cliente_id", null, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                       @if($errors->has("cliente_id"))
                        <span class="help-block">{{ $errors->first("cliente_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('st_seguimiento_id')) has-error @endif">
                       <label for="st_seguimiento_id-field">St_seguimiento_id</label>
                       {!! Form::text("st_seguimiento_id", null, array("class" => "form-control", "id" => "st_seguimiento_id-field")) !!}
                       @if($errors->has("st_seguimiento_id"))
                        <span class="help-block">{{ $errors->first("st_seguimiento_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('mes')) has-error @endif">
                       <label for="mes-field">Mes</label>
                       {!! Form::text("mes", null, array("class" => "form-control", "id" => "mes-field")) !!}
                       @if($errors->has("mes"))
                        <span class="help-block">{{ $errors->first("mes") }}</span>
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