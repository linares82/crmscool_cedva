
<!DOCTYPE html>
<html>
<head>
    <title>Aviso del sistema SIAM</title>
</head>
<body>
    <h3>Fin de contratos</h3>
    <p>Buen dia, Los siguientes registros indican las fechas de vencimiento de contrato de los empleados:</p>
    
   	<div class="datagrid">
    <table  border="0" cellspacing=1 cellpadding=2 bordercolor="#013ADF">
    	<thead>
    		<tr bgcolor="#013ADF">
    			<th> <font color="white">Empleado </font></th>
    			<th> <font color="white">Fin Contrato </font></th>
    		</tr>
    	</thead>
    	<tbody>
            
    		@foreach($ps as $p)       
    		    <tr bgcolor="#A9BCF5"> 
                    <td> {{{ $p->nombre }}} </td>
                    <td> {{{ $p->fin_contrato }}} </td>
    			</tr>
    		@endforeach
    	</tbody>
    </table>
    </div>
</body>
</html>