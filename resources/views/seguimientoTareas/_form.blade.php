                <div class="form-group col-md-4 @if($errors->has('asignacion_tarea_id')) has-error @endif">
                       <label for="asignacion_tarea_id-field">Asignacion_tarea_id</label>
                       {!! Form::text("asignacion_tarea_id", null, array("class" => "form-control", "id" => "asignacion_tarea_id-field")) !!}
                       @if($errors->has("asignacion_tarea_id"))
                        <span class="help-block">{{ $errors->first("asignacion_tarea_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('estatus_id')) has-error @endif">
                       <label for="estatus_id-field">Estatus_id</label>
                       {!! Form::text("estatus_id", null, array("class" => "form-control", "id" => "estatus_id-field")) !!}
                       @if($errors->has("estatus_id"))
                        <span class="help-block">{{ $errors->first("estatus_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('detalle')) has-error @endif">
                       <label for="detalle-field">Detalle</label>
                       {!! Form::text("detalle", null, array("class" => "form-control", "id" => "detalle-field")) !!}
                       @if($errors->has("detalle"))
                        <span class="help-block">{{ $errors->first("detalle") }}</span>
                       @endif
                    </div>
                    