
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<div class="container">
		<h1>Crear una Asignatura</h1>

		<form method="post" action="<?php echo base_url('index.php/instanciaAsignatura/crearAsignatura');?>">
			<div class="form-group">

				<div class="col-md-12">
					<strong>Seleccione la asignatura</strong>
					<select name="refInstanciaAsignatura" class="form-control"> 
						<? foreach($asignaturas as $row):?> 
							<? echo '<option value="'.$row['id'].'"> '.$row['nombre'].' </option>';?> 
						<? endforeach;?> 
					</select> 
				</div>

				<div class="col-md-12">
					<strong>Ingrese la sección</strong>
					<input type="text" class="form-control" name="seccion" id="ingresoSeccion" placeholder="Sección" required>
				</div>
				
				<div class="col-md-12">
					<strong>Seleccione el semestre</strong>
					<select name="semestre" id="semestre" class="form-control">
						<option value="1">Otoño</option>
						<option value="2">Primavera</option>
						<option value="3">Verano</option>
						<option value="4">Invierno</option>
					</select>
				</div>

				<div class="col-md-12">
					<strong>Ingrese el año</strong>
					<input type="text" class="form-control" name="anio" id="ingresoAnio" placeholder="Año" required>
				</div>
				<div class="col-md-12">
					<button class="btn btn-success" type="submit">Aceptar</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
