                <div class="form-group col-md-4 @if($errors->has('item')) has-error @endif">
                       <label for="item-field">Item</label>
                       {!! Form::text("item", null, array("class" => "form-control", "id" => "item-field")) !!}
                       @if($errors->has("item"))
                        <span class="help-block">{{ $errors->first("item") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('imagen')) has-error @endif">
                       <label for="imagen-field">Imagen</label>
                       {!! Form::text("imagen", null, array("class" => "form-control", "id" => "imagen-field")) !!}
                       @if($errors->has("imagen"))
                        <span class="help-block">{{ $errors->first("imagen") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('prioridad')) has-error @endif">
                       <label for="prioridad-field">Prioridad</label>
                       {!! Form::text("prioridad", null, array("class" => "form-control", "id" => "prioridad-field")) !!}
                       @if($errors->has("prioridad"))
                        <span class="help-block">{{ $errors->first("prioridad") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('activo')) has-error @endif">
                       <label for="activo-field">Activo</label>
                       {!! Form::text("activo", null, array("class" => "form-control", "id" => "activo-field")) !!}
                       @if($errors->has("activo"))
                        <span class="help-block">{{ $errors->first("activo") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('link')) has-error @endif">
                       <label for="link-field">Link</label>
                       {!! Form::text("link", null, array("class" => "form-control", "id" => "link-field")) !!}
                       @if($errors->has("link"))
                        <span class="help-block">{{ $errors->first("link") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('parametros')) has-error @endif">
                       <label for="parametros-field">Parametros</label>
                       {!! Form::text("parametros", null, array("class" => "form-control", "id" => "parametros-field")) !!}
                       @if($errors->has("parametros"))
                        <span class="help-block">{{ $errors->first("parametros") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('permiso')) has-error @endif">
                       <label for="permiso-field">Permiso</label>
                       {!! Form::text("permiso", null, array("class" => "form-control", "id" => "permiso-field")) !!}
                       @if($errors->has("permiso"))
                        <span class="help-block">{{ $errors->first("permiso") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('padre')) has-error @endif">
                       <label for="padre-field">Padre</label>
                       {!! Form::text("padre", null, array("class" => "form-control", "id" => "padre-field")) !!}
                       @if($errors->has("padre"))
                        <span class="help-block">{{ $errors->first("padre") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('')) has-error @endif">
                       <label for="-field"></label>
                       {!! Form::text("", null, array("class" => "form-control", "id" => "-field")) !!}
                       @if($errors->has(""))
                        <span class="help-block">{{ $errors->first("") }}</span>
                       @endif
                    </div>