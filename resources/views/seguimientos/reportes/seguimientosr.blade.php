<html>
<head>
</head>
<body>
<link rel="stylesheet" type="text/css" href="{{asset('bower_components/AdminLTE/plugins/jquery-pivot-master/jquery.pivot-1.0.1.css')}}"/>
<link rel="stylesheet" type="text/css" href="{{asset('bower_components/AdminLTE/plugins/jquery-pivot-master/themes/smoothness/jquery-ui-1.10.4.custom.min.css')}}"/>
<style>
    { 
    height:100%; 
    overflow:'scroll';
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
    <div id="pivot"></div>
</div>


    <script type="text/javascript" src="{{asset('bower_components/AdminLTE/plugins/jquery-pivot-master/jquery-1.11.0.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components/AdminLTE/plugins/jquery-pivot-master/jquery-ui-1.10.4.custom.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('bower_components/AdminLTE/plugins/jquery-pivot-master/jquery.pivot-1.0.1.js')}}"></script>
    <script type="text/javascript">    
        
        var jsonData = <?php echo $datos; ?>;
	
	
        $( document ).ready( function () {
            $( "#pivot" ).pivot({
                labels: {
                    agg: "AGG",
                    inactive: "DIMENSIONES INACTIVAS",
                    total: "TOTAL GENERAL",
                    total_of: "TOTAL DE",
                    options: "OPCIONES",
                    order: "ORDEN",
                    ascending: "ASCENDENTE",
                    descending: "DESCENDENTE",
                    no: "NO",
                    ok:	"OK",
                    sort_btd: "ORDENAR POR ESTA DIMENSION",
                    metric: "METRICA"
                },
                data: jsonData,
                agg: [{
                    index: "st_contar",
                    func: "count",
                    format: {
                        prefix: "",
                        decimalPlaces: 0
                    }
                }],
                totals: true,
                subtotals: false,
                inactive: [ 'Mes' ],
                cols: [ "Especialidad",'Meta','Nivel','Grado','Estatus' ],
                rows: [ "Plantel","Empleado" ]
            });
        });
        
    </script>




</body>
</html>