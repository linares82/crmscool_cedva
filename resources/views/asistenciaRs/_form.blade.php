                    <div class="form-group col-md-4 @if($errors->has('asignacion_academica_id')) has-error @endif">
                       <label for="asignacion_academica_id-field">Asignacion Academica</label>
                       {!! Form::text("asignacion_academica_id", null, array("class" => "form-control", "id" => "asignacion_academica_id-field")) !!}
                       @if($errors->has("asignacion_academica_id"))
                        <span class="help-block">{{ $errors->first("asignacion_academica_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('fecha')) has-error @endif">
                       <label for="fecha-field">Fecha</label>
                       {!! Form::text("fecha", null, array("class" => "form-control", "id" => "fecha-field")) !!}
                       @if($errors->has("fecha"))
                        <span class="help-block">{{ $errors->first("fecha") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('cliente_id')) has-error @endif">
                       <label for="cliente_id-field">Cliente_id</label>
                       {!! Form::text("cliente_id", null, array("class" => "form-control", "id" => "cliente_id-field")) !!}
                       @if($errors->has("cliente_id"))
                        <span class="help-block">{{ $errors->first("cliente_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('est_asistencia_id')) has-error @endif">
                       <label for="est_asistencia_id-field">Est_asistencia_id</label>
                       {!! Form::text("est_asistencia_id", null, array("class" => "form-control", "id" => "est_asistencia_id-field")) !!}
                       @if($errors->has("est_asistencia_id"))
                        <span class="help-block">{{ $errors->first("est_asistencia_id") }}</span>
                       @endif
                    </div>
                    