<html>
<head>
</head>
<body>
<style>
@media print {
   table, th, td
    {
        border-collapse:collapse;
        border: 1px solid black;
        width:100%;
        text-align:right;
    }
}
body{
    font-family:"sans-serif";
}
.page-break {
    page-break-after: always;
}
</style>

<table style="width:100%;height:auto;border:1px solid #ccc;font-size: .75em;">
    <tr>
        <td style="width:33%;text-align:left" align="left">
            <img src="" alt="Logo" height=80>
        </td>
        <td style="width:33%;text-align:center" align="center">
            <h3> Historia Academica </h3>
        </td>
        <td style="width:33%;text-align:right" align="right">
            Fecha de Elaboración: {{$fecha}}
        </td>
    </tr>
</table>

<table id="dg" style="width:100%;height:auto;border-collapse:collapse;font-size: .75em;">
    <thead>
    </thead>
    <tbody>
        <?php 
            $nombre="";
            $primer_salto=0;
        ?>
        @foreach($hacademicas as $h)
            @if($nombre<>$h->nombre)
                @if($primer_salto<>0)
                    <div class="page-break"></div>
                @endif
                
            <tr>
            <td colspan="6" style="border:1px solid #ccc;">
            <table>
                <tr >
                    <td>Plantel:</td><td>{{$h->plantel}}</td>
                </tr>
                <tr>
                    <td>Especialidad:</td><td>{{$h->especialidad}}</td>
                </tr>
                <tr>
                    <td>Nivel:</td><td>{{$h->nivel}}</td>
                </tr>
                <tr>
                    <td>Grado:</td><td>{{$h->grado}}</td>
                </tr>
                <tr>
                    <td>Nombre:</td><td>{{$h->nombre}}</td>
                </tr>
            </table>
            </td>
            </tr>
            <tr style="border:1px solid #ccc;">
                <th>Materia</th>
                <th>Lectivo</th>
                <th>Estatus</th>
                <th>Examen</th>
                <th>Calificacion</th>
                <th>Fecha</th>
            </tr>
            <?php
            $nombre=$h->nombre;
            ?>
            @endif
        <tr>
            <td style="border:1px solid #ccc;">{{$h->materia}}</td>
            <td style="border:1px solid #ccc;">{{$h->lectivo}}</td>
            <td style="border:1px solid #ccc;">{{$h->estatus}}</td>
            <td style="border:1px solid #ccc;">{{$h->tipo_examen}}</td>
            <td style="border:1px solid #ccc;">{{$h->calificacion}}</td>
            <td style="border:1px solid #ccc;">{{$h->fecha}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<script type="text/php">
    if (isset($pdf)){
        $font = $fontMetrics->getFont("Arial", "bold");
        $pdf->page_text(700, 590, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0, 0, 0));
    }
</script>
</body>
</html>