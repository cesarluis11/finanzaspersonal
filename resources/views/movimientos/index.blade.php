@extends('welcome')
@section('encabezado')
<h1><i class="fas fa-retweet"></i> Movimientos</h1>
<div class="container">
	@if (session('registroCorrecto'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
	  <strong>{{ session('registroCorrecto') }}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	@endif
	@if (session('registroFallido'))
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  <strong>{{ session('registroFallido') }}</strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
</div>
@endif
@stop
@section('contenido')
<div class="container">
	<div class="text-center">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#nuevoMovimiento" title="Agregar Nuevo Movimento">
			{{-- Agregar Nuevo Movimiento --}}
			<i class="fas fa-plus-square"> Nuevo Movimiento</i>
		</button>

		<!-- Modal -->
		<div class="modal fade" id="nuevoMovimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Nuevo Movimiento</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="{{ route('movimientos.store') }}">
							{{ csrf_field() }}
							 <div class="form-group">
							 	<label for="cuenta">Cuenta</label>
							 	<div class="input-group">
							 		<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
									</div>
								 	<select class="form-control" id="cuenta" name="cuenta" required>
								 		<option value="">Selecciona una opción...</option>
								 		@foreach($cuentas AS $cuenta)
								 		<option value="{{ $cuenta->id }}">{{ $cuenta->nombre }}</option>
								 		@endforeach
								 	</select>
							 	</div>
							 </div>
							 <div class="form-group">
							 	<label for="tipo">Tipo de Movimiento</label>
							 	<div class="input-group">
							 		<div class="input-group-prepend">
							 			<span class="input-group-text"><i class="fas fa-keyboard"></i></span>
							 		</div>
								 	<select class="form-control" id="tipo" name="tipo" required>
								 		<option value="">Selecciona una opción...</option>
								 		<option value="E">Gasto</option>
								 		<option value="I">Ingreso</option>
								 	</select>
							 	</div>
							 </div>
							<div class="form-group">
								<label for="descripcion">Descripción</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-align-right"></i></span>
									</div>
									<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
								</div>
							</div>
							<div class="form-group">
								<label for="monto">Monto</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
									</div>
									<input type="number" min="0.00" max="100000.00" step="0.01" class="form-control" id="monto" name="monto" placeholder="Monto" required>
								</div>
							</div>
							<button type="submit" class="btn btn-dark btn-sm" title="Guardar Movimiento"><i class="fas fa-save"> Guardar</i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>
		<table id="tableMovimientos" class="table table-sm table-hover" style="width:100%">
			<thead class="thead-dark">
				<tr>
					<th>#</th>
					<th>Cuenta Mov</th>
					<th>Descripción</th>
					<th>Monto</th>
					<th>Tipo</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				@foreach($movimientos AS $movimiento)
				<tr>
					<td>{{ $movimiento->id }}</td>
					<td>{{ $movimiento->nombre }}</td>
					<td>{{ $movimiento->descripcion }}</td>
					<td>{{ $movimiento->monto }}</td>
					@if($movimiento->tipo == "I")
					<td>INGRESO</td>
					@else
					<td>GASTO</td>
					@endif
					<td>{{ date('d-m-Y', strtotime($movimiento->fecha_creacion_mov)) }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop
		