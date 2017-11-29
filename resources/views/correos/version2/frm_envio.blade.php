@extends('plantillas.admin_template')

@include('correos._common')

@section('header')

<ol class="breadcrumb">
    <li><a href="{{ route('home') }}"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
    <li><a href="{{ route('correos.index') }}">@yield('correosAppTitle')</a></li>
    <li class="active">Crear</li>
</ol>

<div class="page-header">
    <h3><i class="glyphicon glyphicon-plus"></i> @yield('correosAppTitle') / Crear </h3>
</div>
@endsection

@section('content')
@include('error')

<div class="row" id="contenido_principal">

    <div class="col-md-12">
        <form  id="f_enviar_correo" name="f_enviar_correo"  action="enviar_correo"  class="formarchivo" enctype="multipart/form-data" method="post" >

            <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>"> 

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear Nuevo Correo</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <input class="form-control" placeholder="Para:" id="destinatario" name="destinatario" value="{!! $mail !!}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Nombre:" id="nombre" name="nombre" value="{!! $nombre !!}">
                    </div>
                    <div class="form-group">
                        <input class="form-control" placeholder="Asunto:" id="asunto" name="asunto">
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('empresa_bnd')) has-error @endif">
                        <label for="activo-field">Empresa</label>
                        {!! Form::checkbox("empresa_bnd", 1, $empresa, [ "id" => "empresa_bnd-field"]) !!}
                        @if($errors->has("embresa_bnd"))
                        <span class="help-block">{{ $errors->first("empresa_bnd") }}</span>
                        @endif
                    </div>
                    <div class="form-group col-md-6 @if($errors->has('cliente_bnd')) has-error @endif">
                        <label for="activo-field">Cliente</label>
                        {!! Form::checkbox("cliente_bnd", 1, null, [ "id" => "cliente_bnd-field"]) !!}
                        @if($errors->has("cliente_bnd"))
                        <span class="help-block">{{ $errors->first("cliente_bnd") }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <textarea id="contenido_mail" name="contenido_mail" class="form-control" style="height: 200px" placeholder="escriba aquí...">
                         
                        </textarea>
                    </div>
                    <div class="form-group">
                        <div class="btn btn-default btn-file">
                            <i class="fa fa-paperclip"></i> Adjuntar Archivo
                            <input type="file"  id="file" name="file" class="email_archivo" >
                        </div>
                        <p class="help-block"  >Max. 20MB</p>
                        <div id="texto_notificacion">

                        </div>
                    </div>



                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="pull-right">

                        <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> ENVIAR</button>
                    </div>
                    <br/>
                </div><!-- /.box-footer -->
            </div><!-- /. box -->

        </form>
    </div><!-- /.col -->
</div><!-- /.row -->
<!-- cargador empresa -->
<div style="display: none;" id="cargador_empresa" align="center">
    <br>
    <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

    <img src="{{asset('images/ajax-loader.gif')}}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Realizando envio de correo ...</label>

    <br>
    <hr style="color:#003" width="50%">
    <br>
</div>
@endsection
@push('scripts')


<script>

    function activareditor() {
        $("#contenido_mail").wysihtml5();
    }
    ;
    activareditor();

    function irarriba() {
        $('html, body').animate({scrollTop: 0}, 300);
    }

    $(document).on("submit", ".formarchivo", function (e) {
        e.preventDefault();
        var formu = $(this);
        var nombreform = $(this).attr("id");
        var rs = false; //leccion 10
        var seccion_sel = $("#seccion_seleccionada").val();
        if (nombreform == "f_enviar_correo") {
            var miurl = "/correos/enviarCorreo";
            var divresul = "contenido_principal";
        }

        //información del formulario
        var formData = new FormData($("#" + nombreform + "")[0]);

        //hacemos la petición ajax   
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#cargador_empresa").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                $("#" + divresul + "").html(data);
                $("#fotografia_usuario").attr('src', $("#fotografia_usuario").attr('src') + '?' + Math.random());

                if (rs) {
                    $('#' + nombreform + '').trigger("reset");
                    mostrarseccion(seccion_sel);
                }
            },
            //si ha ocurrido un error
            error: function (data) {
                alert("ha ocurrido un error");

            }
        });

        irarriba();

    })

    $(document).on("change", ".email_archivo", function (e) {

        var miurl = "/correos/carga_archivo_correo";
        // var fileup=$("#file").val();
        var divresul = "texto_notificacion";

        var data = new FormData();
        data.append('file', $('#file')[0].files[0]);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#_token').val()
            }
        });
        $.ajax({
            url: miurl,
            type: 'POST',

            // Form data
            //datos del formulario
            data: data,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                $("#" + divresul + "").html($("#cargador_empresa").html());
            },
            //una vez finalizado correctamente
            success: function (data) {
                var codigo = '<div class="mailbox-attachment-info"><a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>' + data + '</a><span class="mailbox-attachment-size"> </span></div>';
                $("#" + divresul + "").html(codigo);

            },
            //si ha ocurrido un error
            error: function (data) {
                $("#" + divresul + "").html(data);

            }
        });

    })

    $(document).ready(function () {
        /*$('#empresa_bnd-field').click(function () {
            if ($(this).is(":checked")) {
                $.ajax({
                    url: '{{ route("empresas.getEmpleadosXmail") }}',
                    type: 'GET',
                    data: "correo=" + $('#destinatario').val() + "&nombre=" + $('#nombre').val(),
                    //dataType: 'json',
                    beforeSend: function () {
                        $("#loading10").show();
                    },
                    complete: function () {
                        $("#loading10").hide();
                    },
                    success: function (data) {
                        //alert(data);
                        $('#destinatario').val('');
                        $('#destinatario').val(data[0]);
                        $('#nombre').val('');
                        $('#nombre').val(data[1]);
                    },
                });
            }
        });
        */
    });

</script>
@endpush