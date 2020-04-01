	<div class="container">
		<h1>Crear una Nota</h1>

		<form method="post" action="<?php echo base_url('index.php/nota/crearNota');?>">
			<div class="form-group">

				<div class="col-md-12">
					<strong>Seleccione la asignatura</strong>
					<select name="asignatura" class="form-control" id="asignatura"> 
						<? foreach($asignaturas as $row):?> 
							<? echo '<option value="'.$row['id'].'"> '.$row['nombre'].' </option>';?> 
						<? endforeach;?> 
					</select> 
				</div>
				<div class="col-md-12">
					<strong>Fecha Evaluacion</strong>
					<input type="date" id="evaluacion" name="evaluacion" class="form-control" placeholder="Ingrese Fecha" required="">
				</div>
				<div class="col-md-12">
					<strong>Matricula Alumno</strong>
					<input type="text" class="form-control" name="matricula" id="matricula" placeholder="123" required>
				</div>
				<div class="col-md-12">
					<strong>Nota</strong>
					<input type="double" name="nota" class="form-control" placeholder="Ingrese un numero" required="">
				</div>

				<div class="col-md-12">
					<button class="btn btn-success" type="submit">Aceptar</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
