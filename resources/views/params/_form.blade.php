                <div class="form-group col-md-4 @if($errors->has('llave')) has-error @endif">
                       <label for="llave-field">Llave</label>
                       {!! Form::text("llave", null, array("class" => "form-control", "id" => "llave-field")) !!}
                       @if($errors->has("llave"))
                        <span class="help-block">{{ $errors->first("llave") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('valor')) has-error @endif">
                       <label for="valor-field">Valor</label>
                       {!! Form::text("valor", null, array("class" => "form-control", "id" => "valor-field")) !!}
                       @if($errors->has("valor"))
                        <span class="help-block">{{ $errors->first("valor") }}</span>
                       @endif
                    </div>