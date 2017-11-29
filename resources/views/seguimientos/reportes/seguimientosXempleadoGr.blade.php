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

<div id="printeArea">
<table style="width:100%;height:auto;border:1px solid #ccc;font-size: 0.75em;">
    <tr>
        <td style="width:33%;text-align:left" align="left">
            <img src="" alt="Logo" height=80>
        </td>
        <td style="width:33%;text-align:center" align="center">
            <h3> Reporte de Seguimientos por Empleado para Planteles </h3>
        </td>
        <td style="width:33%;text-align:rigth" align="rigth">
            Fecha de Elaboración: {{$fecha}}
        </td>
    </tr>
</table>

<table id="dg" style="width:100%;height:auto;border-collapse: collapse;font-size: 0.75em;">
    <thead>
        <tr>
            <th data-options="field:'cia_id'" style="border:1px solid #ccc;">
                No.
            </th>
            <th data-options="field:'cia_id'" style="border:1px solid #ccc;">
                Plantel
            </th>
            <th data-options="field:'residuo'" style="border:1px solid #ccc;">
                Empleado
            </th>
            <th data-options="field:'residuo'" style="border:1px solid #ccc;">
                Estatus
            </th>
            <th data-options="field:'residuo'" style="border:1px solid #ccc;">
                Total
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $i=1; ?>
        <?php $nombre=""; 
        $suma_empleado=0;
        $suma_plantel=0;
        $plantel="";
        ?>
        @foreach($seguimientos as $s)
        
        @if($suma_empleado==0 and $s->nombre!=$nombre and $s->razon!=$plantel)
            <tr>
                <td style="border:1px solid #ccc;">
                    {{ $i }}
                    <?php $i++; ?>
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->razon}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->nombre}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->name }}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->total }}
                </td>
            </tr>
            <?php 
            $nombre=$s->nombre; 
            $suma_empleado=$suma_empleado+$s->total;
            $suma_plantel=$suma_plantel+$s->total;
            $plantel=$s->razon;
            ?>
        @elseif($suma_empleado!=0 and $s->nombre==$nombre and $s->razon==$plantel)
            <tr>
                <td style="border:1px solid #ccc;">
                    {{ $i }}
                    <?php $i++; ?>
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->razon}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->nombre}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->name }}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->total }}
                </td>
            </tr>
            <?php 
            $suma_empleado=$suma_empleado+$s->total;
            $suma_plantel=$suma_plantel+$s->total;
            ?>
        @elseif($suma_empleado!=0)
            @if($s->razon==$plantel and $s->nombre!=$nombre)
                <tr>
                    <td style="border:1px solid #ccc;" colspan=3>
                    </td>
                    <td style="border:1px solid #ccc;">
                        <strong>Suma total por empleado</strong>
                    </td>
                    <td style="border:1px solid #ccc;">
                        {{ $suma_empleado }}
                    </td>
                </tr>
                <?php $suma_empleado=$s->total; ?>
            @endif
            @if($s->razon!=$plantel and ($s->nombre!=$nombre or $s->nombre==$nombre))
                <tr>
                    <td style="border:1px solid #ccc;" colspan=3>
                    </td>
                    <td style="border:1px solid #ccc;">
                        <strong>Suma total por empleado</strong>
                    </td>
                    <td style="border:1px solid #ccc;">
                        {{ $suma_empleado }}
                    </td>
                </tr>
                <tr>
                    <td style="border:1px solid #ccc;" colspan=3>
                        
                    </td>
                    <td style="border:1px solid #ccc;">
                        <strong>Suma total por plantel</strong>
                    </td>
                    <td style="border:1px solid #ccc;">
                        {{ $suma_plantel }}
                    </td>
                </tr>
                <?php $suma_plantel=$s->total; ?>
                <?php $suma_empleado=$s->total; ?>
            @endif
            <tr>
                <td style="border:1px solid #ccc;">
                    {{ $i }}
                    <?php $i++; ?>
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->razon}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{$s->nombre}}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->name }}
                </td>
                <td style="border:1px solid #ccc;">
                    {{ $s->total }}
                </td>
            </tr>
            <?php 
            $nombre=$s->nombre; 
            $plantel=$s->razon;
            ?>
        @endif
        @endforeach
        
        <tr>
            <td style="border:1px solid #ccc;" colspan=3>   
            </td>
            <td style="border:1px solid #ccc;">
                <strong>Suma total por empleado</strong>
            </td>
            <td style="border:1px solid #ccc;">
                {{ $suma_empleado }}
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #ccc;" colspan=3>
            </td>
            <td style="border:1px solid #ccc;">
                <strong>Suma total por plantel</strong>
            </td>
            <td style="border:1px solid #ccc;">
                {{ $suma_plantel }}
            </td>
        </tr>
    </tbody>
</table>
</div>

<script type="text/php">
    if (isset($pdf)){
        $font = $fontMetrics->getFont("Arial", "bold");
        $pdf->page_text(700, 590, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0, 0, 0));
    }
</script>
</body>
</html>