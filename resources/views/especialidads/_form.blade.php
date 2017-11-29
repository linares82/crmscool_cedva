                <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                          <label for="plantel_id-field">Plantel</label>
                          {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                          @if($errors->has("plantel_id"))
                            <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                          @endif
                        </div>
                    <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Especialidad</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('rvoe')) has-error @endif">
                       <label for="rvoe-field">RVOE</label>
                       {!! Form::text("rvoe", null, array("class" => "form-control", "id" => "rvoe-field")) !!}
                       @if($errors->has("rvoe"))
                        <span class="help-block">{{ $errors->first("rvoe") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('ccte')) has-error @endif">
                       <label for="ccte-field">CCTE</label>
                       {!! Form::text("ccte", null, array("class" => "form-control", "id" => "ccte-field")) !!}
                       @if($errors->has("ccte"))
                        <span class="help-block">{{ $errors->first("ccte") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('meta')) has-error @endif">
                       <label for="meta-field">Meta Empleado</label>
                       {!! Form::text("meta", null, array("class" => "form-control", "id" => "meta-field")) !!}
                       @if($errors->has("meta"))
                        <span class="help-block">{{ $errors->first("meta") }}</span>
                       @endif
                    </div>
                