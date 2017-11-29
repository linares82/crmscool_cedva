                <div class="form-group col-md-4 @if($errors->has('diplomado_id')) has-error @endif">
                       <label for="diplomado_id-field">Diplomado</label>
                       {!! Form::select("diplomado_id", $list["Diplomado"], null, array("class" => "form-control select_seguridad", "id" => "subdiplomado_id-field")) !!}
                       @if($errors->has("diplomado_id"))
                        <span class="help-block">{{ $errors->first("diplomado_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Subdiplomado</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                          <label for="plantel_id-field">Plantel</label>
                          {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                          @if($errors->has("plantel_id"))
                            <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                          @endif
                    </div>