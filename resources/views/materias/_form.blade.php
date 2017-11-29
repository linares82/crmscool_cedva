                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Materia</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('abreviatura')) has-error @endif">
                       <label for="abreviatura-field">Abreviatura</label>
                       {!! Form::text("abreviatura", null, array("class" => "form-control", "id" => "abreviatura-field")) !!}
                       @if($errors->has("abreviatura"))
                        <span class="help-block">{{ $errors->first("abreviatura") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('seriada_bnd')) has-error @endif">
                       <label for="seriada_bnd-field">Seriada</label>
                       {!! Form::checkbox("seriada_bnd", 1, null, [ "id" => "seriada_bnd-field"]) !!}
                       @if($errors->has("seriada_bnd"))
                        <span class="help-block">{{ $errors->first("seriada_bnd") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('serie_anterior')) has-error @endif">
                       <label for="serie_anterior-field">Serie anterior</label>
                       {!! Form::select("serie_anterior", $materiales_ls, null, array("class" => "form-control select_seguridad", "id" => "serie_anterior-field")) !!}
                       @if($errors->has("serie_anterior"))
                        <span class="help-block">{{ $errors->first("serie_anterior") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('plantel_id')) has-error @endif">
                       <label for="plantel_id-field">Plantel</label>
                       {!! Form::select("plantel_id", $list["Plantel"], null, array("class" => "form-control select_seguridad", "id" => "plantel_id-field")) !!}
                       @if($errors->has("plantel_id"))
                        <span class="help-block">{{ $errors->first("plantel_id") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('ponderacion_id')) has-error @endif">
                       <label for="ponderacion_id-field">Ponderacion</label>
                       {!! Form::select("ponderacion_id", $list["Ponderacion"], null, array("class" => "form-control select_seguridad", "id" => "ponderacion_id-field")) !!}
                       @if($errors->has("ponderacion_id"))
                        <span class="help-block">{{ $errors->first("ponderacion_id") }}</span>
                       @endif
                    </div>