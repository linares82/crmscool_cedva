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
</style>

<table style="width:100%;height:auto;border:1px solid #ccc;font-size: .75em;">
    <tr>
        <td style="width:33%;text-align:left" align="left">
            <img src="" alt="Logo" height=80>
        </td>
        <td style="width:33%;text-align:center" align="center">
            <h3> Reporte de Seguimientos de Cliente </h3>
        </td>
        <td style="width:33%;text-align:right" align="right">
            Fecha de Elaboración: {{$fecha}}
        </td>
    </tr>
</table>

<table id="dg2" style="width:100%;height:auto;border-collapse:collapse;font-size: .75em;">
    <tr>
        <td style="width:33%;text-align:center;border:1px solid #ccc;" align="center" colspan=4>
            Datos del cliente
        </td>
        
    </tr>
    <tr>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5">
            Nombre Completo:
        </td>
        <td style="width:33%;border:1px solid #ccc;">
            {{$seguimiento->cliente->nombre." ".$seguimiento->cliente->nombre2." ".$seguimiento->cliente->ape_paterno." ".$seguimiento->cliente->ape_materno}}
        </td>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5">
            Tel. Fijo:
        </td>
        <td style="width:33%;border:1px solid #ccc;">
            {{$seguimiento->cliente->tel_fijo}}
        </td>
    </tr>
    <tr>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5">
            Tel. Celular:
        </td>
        <td style="width:33%;border:1px solid #ccc;">
            {{$seguimiento->cliente->tel_cel}}
        </td>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5">
            E-mail:
        </td>
        <td style="width:33%;border:1px solid #ccc;">
            {{$seguimiento->cliente->mail}}
        </td>
    </tr>
    <tr>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5">
            Dirección:
        </td>
        <td style="width:33%;border:1px solid #ccc;">
            {{$seguimiento->cliente->calle." ".$seguimiento->cliente->no_ext." ".$seguimiento->cliente->colonia." ".$seguimiento->cliente->municipio->name}}        
        </td>
        <td style="width:33%;border:1px solid #ccc;" bgcolor="#c1b7b5" >
            Empleado:
        </td>
        <td style="width:33%;border:1px solid #ccc;" >
            {{$seguimiento->cliente->empleado->nombre." ".$seguimiento->cliente->empleado->ape_paterno." ".$seguimiento->cliente->empleado->ape_materno}}         
        </td>
    </tr>
</table>

<table style="width:100%;height:auto;border:1px solid #ccc;font-size: .75em;">
    <tr>
        <td style="width:33%;text-align:left" align="left">
            
        </td>
        <td style="width:33%;text-align:center" align="center">
            <h4> TAREAS </h4>
        </td>
        <td style="width:33%;text-align:right" align="right">
            
        </td>
    </tr>
</table>

<table id="dg" style="width:100%;height:auto;border-collapse:collapse;font-size: .75em;">
    <thead>
        <tr>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Tarea</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Asunto</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Detalle</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Estatus</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($asignacionTareas as $at)
        <tr>
            <td style="border:1px solid #ccc;">{{$at->tarea->name}}</td>
            <td style="border:1px solid #ccc;">{{$at->asunto->name}}</td>
            <td style="border:1px solid #ccc;">{{$at->detalle}}</td>
            <td style="border:1px solid #ccc;">{{$at->stTarea->name}}</td>
            <td style="border:1px solid #ccc;">{{ date_format($at->created_at, 'd-m-Y')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table style="width:100%;height:auto;border:1px solid #ccc;font-size: .75em;">
    <tr>
        <td style="width:33%;text-align:left" align="left">
            
        </td>
        <td style="width:33%;text-align:center" align="center">
            <h4> AVISOS </h4>
        </td>
        <td style="width:33%;text-align:right" align="right">
            
        </td>
    </tr>
</table>

<table id="dg1" style="width:100%;height:auto;border-collapse: collapse;font-size: .75em;">
    <thead>
        <tr>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Fecha</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Asunto</th>
            <th style="border:1px solid #ccc;" bgcolor="#c1b7b5">Detalle</th>
        </tr>
    </thead>
    <tbody>
        @foreach($avisos as $a)
        <tr>
            <td style="border:1px solid #ccc;">
                {{ Carbon\Carbon::parse($a->fecha)->format('d-m-Y')}}
            </td>
            <td style="border:1px solid #ccc;">{{$a->name}}</td>
            <td style="border:1px solid #ccc;">{{$a->detalle}}</td>
            
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