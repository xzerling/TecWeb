
	<div class="container">
		<h1>Crear Observación</h1>
		<form method="post" action="<?php echo base_url('index.php/observacion/crearObservacion');?>">
			<div class="form-group">
				<div class="col-md-12">
					<strong>Profesor</strong>
					<!-- Select para profesores !-->
					<select name="refProfesor" class="form-control">
						<?php foreach($profesores as $row):?>
							<?php echo '<option value="'.$row->correo.'"> '.$row->nombre.'</option>'; ?>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col-md-12">
					<strong>Alumno</strong>
					<!-- Select para alumnos -->
					<select name="refAlumno" class="form-control">
						<?php foreach($alumnos as $row):?>
							<?php echo '<option value="'.$row->matricula.'"> '.$row->nombre.'</option>'; ?>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col-md-12">
					<strong>Comentario</strong>
					<input type="text" name="comentario" class="form-control" placeholder="Ingrese el comentario" required="">
				</div>
				<div class="col-md-12">
					<button class="btn btn-success" type="submit">Aceptar</button>
				</div>
			</div>
		</form>
	</div>
</body>
