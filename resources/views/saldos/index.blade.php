@extends('welcome')
@section('encabezado')
<h1><i class="fas fa-balance-scale"></i> Saldos</h1>
@stop
@section('contenido')
<div class="container">
	<div>
		<table id="tableSaldos" class="table table-sm table-hover" style="width:100%">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Cuenta Activa</th>
					<th>Monto Inicial</th>
					<th>Saldo Actual</th>
					<th>Ult.Actualizacion</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				@foreach($saldos AS $saldo)
				<tr>
					<td>{{ $saldo->id }}</td>
					<td>{{ $saldo->nombre }}</td>
					<td>${{ $saldo->monto_inicial }}</td>
					<td>${{ $saldo->saldo }}</td>
					<td>{{ date('d-m-Y', strtotime($saldo->fecha_actualizacion)) }}</td>
					<td><a href="{{ route('saldos.show',$saldo->id) }}" class="btn btn-dark btn-sm">Detalles</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop