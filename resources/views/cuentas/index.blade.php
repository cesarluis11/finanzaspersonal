@extends('welcome')
@section('encabezado')
<h1><i class="fas fa-file-invoice-dollar"></i> Cuentas</h1>
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
		<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#nuevaCuenta" title="Agregar Nueva Cuenta">
			<i class="fas fa-plus-square"> Agregar Nueva Cuenta</i>
		</button>

		<!-- Modal -->
		<div class="modal fade" id="nuevaCuenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalCenterTitle">Agregar Nueva Cuenta</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" action="{{ route('cuentas.store') }}">
							{{ csrf_field() }}
						  <div class="form-group">
						    <label for="nombreCuenta">Nombre</label>
						    <div class="input-group">
						    	<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-file-invoice-dollar"></i></span>
								</div>
						    	<input type="text" class="form-control" id="nombreCuenta" name="nombreCuenta" placeholder="Cuenta" required>
						    </div>	
						  </div>
						  <div class="form-group">
						    <label for="montoInicial">Monto Inicial</label>
						    <div class="input-group">
						    	<div class="input-group-prepend">
						    		<span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
						    	</div>
						    	<input type="number" min="0.00" max="100000.00" step="0.01" class="form-control" id="montoInicial" name="montoInicial" placeholder="Monto" required>
						    </div>
						  </div>
						  <button type="submit" class="btn btn-dark btn-sm" title="Guardar Cuenta"><i class="fas fa-save"> Guardar</i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div>
		<table id="tableCuentas" class="table table-sm table-hover" style="width:100%">
        <thead class="thead-dark">
            <tr>
            	<th>#</th>
                <th>Nombre</th>
                <th>Monto Apertura</th>
                <th>Fecha Creacion</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($cuentas AS $cuenta)
            <tr>
                <td>{{ $cuenta->id }}</td>
                <td>{{ $cuenta->nombre }}</td>
                <td>${{ $cuenta->monto_inicial }}</td>
                <td>{{ date('d-m-Y', strtotime($cuenta->fecha_creacion)) }}</td>
                <td><a href="{{ route('cuentas.destroy',$cuenta->id) }}" class="btn btn-dark btn-sm">Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
	</div>
</div>
@stop
		