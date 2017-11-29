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


    <div id="barras_chart" style="height: 330px;">
    </div>

    <div id="pivot"></div>
</div>

<script type="text/php">
    if (isset($pdf)){
        $font = $fontMetrics->getFont("Arial", "bold");
        $pdf->page_text(700, 590, "Página {PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0, 0, 0));
    }
</script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
    <script type="text/javascript">    
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawVisualization);

        var datos=<?php echo $datos; ?>; 

        function drawVisualization() {
                // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(datos);
            
            var options = {
            title : 'Estatus de seguimientos en el mes',
            vAxis: {title: 'Cantidad'},
            hAxis: {title: 'Concretados Por Empleado'},
            seriesType: 'bars',
            //series: {0: {type: 'line'}},
            chartArea:{left:50,top:50,bottom:50,width:'70%',height:'100%'}
            //colors: ['#5a81f1', '#2dca1d']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barras_chart'));
            //var chart = new google.charts.Bar(document.getElementById('barras_chart'));

            chart.draw(data, options);
        }

        

    </script>




</body>
</html>