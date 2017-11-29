                <div class="form-group @if($errors->has('tarea')) has-error @endif">
                       <label for="tarea-field">Tarea</label>
                       {!! Form::text("tarea", null, array("class" => "form-control", "id" => "tarea-field")) !!}
                       @if($errors->has("tarea"))
                        <span class="help-block">{{ $errors->first("tarea") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('fecha')) has-error @endif">
                       <label for="fecha-field">Fecha</label>
                       {!! Form::text("fecha", null, array("class" => "form-control", "id" => "fecha-field")) !!}
                       @if($errors->has("fecha"))
                        <span class="help-block">{{ $errors->first("fecha") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('hora')) has-error @endif">
                       <label for="hora-field">Hora</label>
                       {!! Form::text("hora", null, array("class" => "form-control", "id" => "hora-field")) !!}
                       @if($errors->has("hora"))
                        <span class="help-block">{{ $errors->first("hora") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('asunto')) has-error @endif">
                       <label for="asunto-field">Asunto</label>
                       {!! Form::text("asunto", null, array("class" => "form-control", "id" => "asunto-field")) !!}
                       @if($errors->has("asunto"))
                        <span class="help-block">{{ $errors->first("asunto") }}</span>
                       @endif
                    </div>
                    <div class="form-group @if($errors->has('detalle')) has-error @endif">
                       <label for="detalle-field">Detalle</label>
                       {!! Form::text("detalle", null, array("class" => "form-control", "id" => "detalle-field")) !!}
                       @if($errors->has("detalle"))
                        <span class="help-block">{{ $errors->first("detalle") }}</span>
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