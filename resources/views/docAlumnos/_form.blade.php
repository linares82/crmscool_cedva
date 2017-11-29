                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Documento</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('doc_ebligatorio')) has-error @endif">
                       <label for="doc_obligatorio-field">Obligatorio</label>
                       {!! Form::checkbox("doc_obligatorio", 1, null, [ "id" => "doc_obligatorio-field"]) !!}
                       @if($errors->has("doc_obligatorio"))
                        <span class="help-block">{{ $errors->first("doc_obligatorio") }}</span>
                       @endif
                    </div>
                    
                    