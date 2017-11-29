                <div class="form-group @if($errors->has('est_asistencia')) has-error @endif">
                       <label for="est_asistencia-field">Valor Asistencia</label>
                       {!! Form::text("est_asistencia", null, array("class" => "form-control", "id" => "est_asistencia-field")) !!}
                       @if($errors->has("est_asistencia"))
                        <span class="help-block">{{ $errors->first("est_asistencia") }}</span>
                       @endif
                    </div>
                    