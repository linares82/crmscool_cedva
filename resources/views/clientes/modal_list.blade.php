<h3 class="page-header">Clientes</h3>
<div class="col-sm-12 form-group">
    <div class="input-group">
        <div class="col-sm-6">
        <input class="form-control" id="search" value="{{ Session::get('cliente_search') }}"
               placeholder="Primer Nombre"
               type="text">
        </div>
        <div class="col-sm-6">
        <input class="form-control" id="search2" value="{{ Session::get('nombre2_search') }}"
               placeholder="Segundo Nombre"
               type="text">
        </div>
        <div class="col-sm-6">
        <input class="form-control" id="search3" value="{{ Session::get('ape_paterno_search') }}"
               placeholder="A. Paterno"
               type="text">
        </div>
        <div class="col-sm-6">
        <input class="form-control" id="search4" value="{{ Session::get('ape_materno_search') }}"
               placeholder="A. Materno"
               type="text">
        </div>
        <div class="input-group-btn">
            <button type="button" class="btn btn-default"
                    onclick="ajaxLoad('{{url('clientes/list')}}?ok=1&search='+$('#search').val()+'&search2='+$('#search2').val()+'&search3='+$('#search3').val()+'&search4='+$('#search4').val())"><i
                        class="glyphicon glyphicon-search"></i>
            </button>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th width="30px" style="text-align: center"></th>
        <th width="50px" style="text-align: center">No</th>
        <th>
            <!--<a href="javascript:ajaxLoad('clientes/list?field=nombre&sort={{Session::get("cliente_sort")=="asc"?"desc":"asc"}}')">-->
                Primer Nombre
            <!--</a>
            <i style="font-size: 12px"
               class="glyphicon  {{ Session::get('cliente_field')=='nombre'?(Session::get('cliente_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
            </i>-->
        </th>
        <th>
            <!--<a href="javascript:ajaxLoad('clientes/list?field=nombre2&sort={{Session::get("cliente_sort")=="asc"?"desc":"asc"}}')">-->
                Segundo Nombre
            <!--</a>
            <i style="font-size: 12px"
               class="glyphicon  {{ Session::get('cliente_field')=='nombre2'?(Session::get('cliente_sort')=='asc'?'glyphicon-sort-by-alphabet':'glyphicon-sort-by-alphabet-alt'):'' }}">
            </i>-->
        </th>   
        <th>
            
                A. Materno
            
        </th>
        <th>
            
                A. Materno
            
        </th>
        <th>
            
                Correo Electronico
            
        </th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
    @foreach($clientes as $key=>$cliente)
        <tr>
            <td align="center"> {{Form::radio('id_cli', $cliente->id, ['id'=>'id_cli'])}} </td>
            <td align="center">{{$cliente->id}}</td>
            <td>{{$cliente->nombre}}</td>
            <td>{{$cliente->nombre2}}</td>
            <td>{{$cliente->ape_paterno}}</td>
            <td>{{$cliente->ape_materno}}</td>
            <td>{{$cliente->mail}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<div class="pull-right">{!! str_replace('/?','?',$clientes->render()) !!}</div>
<div class="row">
    <i class="col-sm-12">
        Total: {{$clientes->total()}} records
    </i>
</div>
<script>
    $('.pagination a').on('click', function (event) {
        event.preventDefault();
        ajaxLoad($(this).attr('href'));
    });
</script>