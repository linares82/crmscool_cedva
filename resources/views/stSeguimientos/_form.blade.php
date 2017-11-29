<link href="{{ asset('/bower_components/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.css')}}" rel="stylesheet" type="text/css" />
                    <div class="form-group col-md-4 @if($errors->has('name')) has-error @endif">
                       <label for="name-field">Estatus</label>
                       {!! Form::text("name", null, array("class" => "form-control", "id" => "name-field")) !!}
                       @if($errors->has("name"))
                        <span class="help-block">{{ $errors->first("name") }}</span>
                       @endif
                    </div>
                    <div class="form-group col-md-4 @if($errors->has('color')) has-error @endif">
                       <label for="color-field">Color</label>
                       {!! Form::text("color", null, array("class" => "form-control", "id" => "color-field")) !!}
                       @if($errors->has("color"))
                        <span class="help-block">{{ $errors->first("color") }}</span>
                       @endif
                    </div>
                  
@push('scripts')
<script src="{{ asset ('/bower_components/AdminLTE/plugins/colorpicker/bootstrap-colorpicker.js') }}"></script>
<script>
    $(function () {
        $("#color-field").colorpicker();
    });
</script>
@endpush