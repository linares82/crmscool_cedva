<html>
<head>
</head>
<body>
    @if(isset($p))
        {!! $p->plantilla !!}
        @if(!is_null($p->img1))
        <img src="{{ $message->embed($storage_path('app') . "/plantillas_correos/" . $p->img1) }}">
        @endif
    @else
        <p id="yui_3_16_0_ym19_1_1502805517621_40278"><strong id="yui_3_16_0_ym19_1_1502805517621_40277">Grupo Educativo JESADI te da la bienvenida y te felicita por dar el primer paso hacia tu futuro.</strong></p>
        <p id="yui_3_16_0_ym19_1_1502805517621_40296">Confirma tu correo: <a title="Confirmacion de Correo" href="{{ route('clientes.confirmaCorreo', ['id' => $id]) }}" target="_blank" rel="noopener noreferrer">Dale click</a></p>
        <p>Y conoce grandes beneficios.</p>
        <p>&nbsp;</p>
        {!! $plantilla !!}
        @if(!is_null($img1))
        
        <img src="{{ $message->embed($storage_path('app') . "/plantillas_correos/" . $img1) }}">
        @endif
    @endif
    
</body>
</html>