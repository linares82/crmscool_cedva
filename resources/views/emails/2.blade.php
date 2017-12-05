<html>
<head>
</head>
<body>
    {!! $plantilla !!}
    <p id="yui_3_16_0_ym19_1_1502805517621_40296"><strong>Confirma tu correo: <a title="Confirmacion de Correo" href="{{ route('clientes.confirmaCorreo', ['id' =>$id]) }}" target="_blank" rel="noopener noreferrer">Dale click</a></strong></p>
    @if(!is_null($img1))
    <img src="{{ $message->embed($storage_path('app') . "/plantillas_correos/" . $img1) }}">
    @endif
</body>
</html>