@extends('welcome')
{{-- @section('graficas')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        // var options = {'title':'How Much Pizza I Ate Last Night',
        //                'width':400,
        //                'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data);
      }
      
    </script>
@stop --}}
@section('encabezado')
<h1><i class="fas fa-file-invoice-dollar"></i> Detalle Cuenta {{ $nombreCuenta[0]->nombre }}</h1>
@stop
@section('contenido')
<div class="row mx-md-n5">
	<div class="col px-md-5">
		<div class="p-2 border bg-light">
			<h3>Ingresos</h3>
			<div>
				<table id="tableSaldosIngresos" class="table table-sm table-hover" style="width:100%">
					<thead class="thead-dark">
						<tr>
							<th>Descrición</th>
							<th>Monto</th>
							<th>Fecha Creacion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($movimientosIngreso AS $movimientoIngreso)
						<tr>
							<td>{{ $movimientoIngreso->descripcion }}</td>
							<td>{{ $movimientoIngreso->monto }}</td>
							<td>{{ $movimientoIngreso->fecha_creacion_mov }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col px-md-5">
		<div class="p-2 border bg-light">
			<h3>Gastos</h3>
			<div>
				<table id="tableSaldosEgresos" class="table table-sm table-hover" style="width:100%">
					<thead class="thead-dark">
						<tr>
							<th>Descrición</th>
							<th>Monto</th>
							<th>Fecha Creacion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($movimientosEgreso AS $movimientoEgreso)
						<tr>
							<td>{{ $movimientoEgreso->descripcion }}</td>
							<td>{{ $movimientoEgreso->monto }}</td>
							<td>{{ $movimientoEgreso->fecha_creacion_mov }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div>
		<h5 class="p-1 text-center" >(+) Total Ingresos: ${{ $movimientosIngresoTotal }}</h5>
		<h5 class="p-1 text-center" >(-) Total Gastos: ${{ $movimientosEgresoTotal }}</h5>
		<h5 class="p-1 text-center" >(+) Monto Incial: ${{ $nombreCuenta[0]->monto_inicial }}</h5>			
		<h5 class="p-1 text-center" >(=) Saldo Cuenta: ${{ $nombreCuenta[0]->saldo }}</h5>
	</div>
</div>
@stop