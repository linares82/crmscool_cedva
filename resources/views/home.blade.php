@extends('plantillas.admin_template')

@section('header')
@endsection

@section('content')

    <link rel="stylesheet" src="{{ asset ('/bower_components/AdminLTE/plugins/morris/morris.css') }}" />
    
    <style type="text/css">
        #target {
			width: 600px;
			height: 400px;
		}
    </style>
    
    <div class="row">
        
    </div>
    <div class="row">
        @permission('Wanalitica')
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Analitica de Vendedores <a href="{{route('seguimientos.analitica_actividadesf')}}" target="_blank">Ver</a>
                    </h3>
                </div>
                <div class="box-body">
                    <div id="dinamica_actividades"></div>
                </div>
            </div>
        </div>
        @endpermission
        <div class="form-group col-md-6 col-sm-6 col-xs-12" style='display: none'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Grafica de Estatus del Mes
                    </h3>
                </div>
                <div class="box-body">
                    
                        <div id="myfirstchart"></div>
                    
                </div>
            </div>
        </div>
        
        <div class="form-group col-md-5 col-sm-5 col-xs-12" style='display: none'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        Avances del mes:
                    </h4>
                </div>
                <div class="box-body">
                    <div id="barras_chart" style="height: 240px;">
                    </div>     
                </div>
            </div>
        </div>
        <div class="form-group col-md-5 col-sm-5 col-xs-12" style='display: none'>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        Avances del mes:
                    </h4>
                </div>
                <div class="box-body">
                    <div id="barras_chart2" style="height: 240px;">
                    </div>     
                </div>
            </div>
        </div>
    </row>    
    <div class="row">
        <div class="form-group col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Avisos del dia
                    </h3>
                </div>
                <div class="box-body">
                    <div class="table">
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Asunto</th>
                                    <th>Detalle</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($avisos as $a)
                                <tr>
                                    <td>
                                    @if($a->dias_restantes<=0)
                                        <small class="label label-danger">
                                    @elseif($a->dias_restantes==1)
                                        <small class="label label-warning"> 
                                    @elseif($a->dias_restantes>=2)
                                        <small class="label label-success"> 
                                    @endif
                                        {{$a->fecha}}
                                    </small>
                                    </td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->detalle}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{ route('seguimientos.show', $a->cliente_id) }}"><i class="glyphicon glyphicon-edit"></i> Ver Seguimiento</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Avisos Generales
                    </h3>
                    <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body" >
                    <div class="table">
                        <table class="table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>De</th>
                                    <th>Asunto</th>
                                    <th><a href="{{route('avisoGrals.index')}}" class="btn btn-xs btn-info">Ver todos</a></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($avisos_generales as $ag)
                                <tr>
                                    <td>
                                        {{ $ag->usu_alta->name }}
                                    </td>
                                    <td>
                                        {{$ag->avisoGral->desc_corta}}
                                    </td>
                                    <td>
                                    <input type="button" class="btn btn-xs btn-success" value="Ver" onclick="DetalleAviso('{{ $ag->aviso_gral_id }}')" />
                                    <a href="{{route('pivotAvisoGralEmpleados.leido', $ag->id)}}" class="btn btn-xs btn-warning">leido</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @permission('WgaugesXplantel')
        @foreach($a_2 as $grf)
        <div class="form-group col-lg-2 col-md-3 col-sm-4 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h4 class="box-title">
                        {{$grf['razon']}}: 
                    </h4>
                </div>
                <div class="box-body">
                        <div id="velocimetro_{{$grf['id']}}" style="height: 180px;"></div>
                        Meta del plantel: {{$grf['meta_total']}}
                        <br/>
                        Inscritos: {{$grf['avance']}}
                </div>
            </div>
        </div>
        @endforeach
        @endpermission
    </div>

@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset ('/bower_components/AdminLTE/plugins/morris/morris.js') }}"></script>
    <script type="text/javascript" src="{{ asset ('/bower_components/AdminLTE/plugins/morris/raphael-min.js') }}"></script>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">    
        google.charts.load('current', {'packages':['gauge','corechart', 'bar']});
        @foreach($a_2 as $grf)
            google.charts.setOnLoadCallback(drawChart_velocimetro{{$grf['id']}});
        @endforeach
        
        google.charts.setOnLoadCallback(drawVisualization);
        google.charts.setOnLoadCallback(drawVisualization2);

        var datos=<?php echo $datos; ?>; 
        console.log(datos);

        var datos2=<?php echo $datos2; ?>; 

        function drawVisualization() {
                // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(datos);
            
            var options = {
            title : 'Comparativo Concretados - Meta',
            vAxis: {title: 'Cantidad'},
            hAxis: {title: 'Estatus'},
            seriesType: 'bars',
            //series: {0: {type: 'line'}}

            //colors: ['#5a81f1', '#2dca1d']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barras_chart'));
            //var chart = new google.charts.Bar(document.getElementById('barras_chart'));

            chart.draw(data, options);
        }

        function drawVisualization2() {
                // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable(datos2);
            
            var options = {
            title : 'Estatus de seguimientos en el mes',
            vAxis: {title: 'Cantidad'},
            hAxis: {title: 'Estatus'},
            seriesType: 'bars',
            //series: {0: {type: 'line'}}

            colors: ['#FF8000']
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barras_chart2'));
            //var chart = new google.charts.Bar(document.getElementById('barras_chart'));

            chart.draw(data, options);
        }
        

        //Gaugace Chart
        @foreach($a_2 as $grf)
        function drawChart_velocimetro{{$grf['id']}}() {
            var data = google.visualization.arrayToDataTable([
            ['Label', 'Value'],
            ['Concretados', {{ $grf['p_avance'] }}],
            ]);

            var options = {
            //width: 400, height: 250,
            greenFrom:90, greenTo: 100,
            yellowFrom:75, yellowTo: 90,
            redFrom: 0, redTo: 75,
            minorTicks: 5
            };

            var chart = new google.visualization.Gauge(document.getElementById('velocimetro_{{$grf["id"]}}'));

            chart.draw(data, options);

        }//End Guagace Chart
        @endforeach
        /*
        $(function() {
         var chart = new Morris.Bar({
                // ID of the element in which to draw the chart.
                element: 'myfirstchart',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: [0, 0],
                // The name of the data record attribute that contains x-values.
                xkey: 'Estatus',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['Valor'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Valor']
                });
        // Fire off an AJAX request to load the data
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "{{route('grfEstatusXEmpleado')}}", // This is the URL to the API
            //data: { days: 7 } // Passing a parameter to the API to specify number of days
            })
            .done(function( data ) {
            // When the response to the AJAX request comes back render the chart with new data
                //alert(data);
                chart.setData(data);
            })
            .fail(function() {
            // If there is no communication between the server, show an error
                alert( "error occured" );
            });
        });
        */
        var popup;
        function DetalleAviso(id) {
            popup = window.open("{{url('avisoGrals/showModal')}}"+"?id="+id, "Popup", "width=800,height=350");
            popup.focus();
            return false
        }
    </script>
@endpush
