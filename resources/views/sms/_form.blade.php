                <div class="form-group col-md-4 @if($errors->has('usu_envio_id')) has-error @endif">
                       <label for="usu_envio_id-field">Usu_envio_id</label>
                       {!! Form::text("usu_envio_id", null, array("class" => "form-control", "id" => "usu_envio_id-field")) !!}
                       @if($errors->has("usu_envio_id"))
                        <span class="help-block">{{ $errors->first("usu_envio_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('cliente_id')) has-error @endif">
                       <label for="cliente_id-field">Cliente_id</label>
                       {!! Form::text("cliente_id", null, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                       @if($errors->has("cliente_id"))
                        <span class="help-block">{{ $errors->first("cliente_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('fecha_envio')) has-error @endif">
                       <label for="fecha_envio-field">Fecha_envio</label>
                       {!! Form::text("fecha_envio", null, array("class" => "form-control", "id" => "fecha_envio-field")) !!}
                       @if($errors->has("fecha_envio"))
                        <span class="help-block">{{ $errors->first("fecha_envio") }}</span>
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