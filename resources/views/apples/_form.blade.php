                <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Name</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('apple_type_id')) has-error @endif">
                       <label for="apple_type_id-field">Apple_type_id</label>
                       {!! Form::text("apple_type_id", null, array("class" => "form-control", "id" => "apple_type_id-field")) !!}
                       @if($errors->has("apple_type_id"))
                        <span class="help-block">{{ $errors->first("apple_type_id") }}</span>
                       @endif
                    </div>