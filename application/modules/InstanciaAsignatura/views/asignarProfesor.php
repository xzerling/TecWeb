
	<div class="container">
		<h1>Asignar Curso a Profesor</h1>
		<form method="post" action="<?php echo base_url('index.php/instanciaAsignatura/guardarProfesorAsignatura')?>">
			<div class="form-group">
				<div class="col-md-12">
					<strong>Asignatura</strong>
					<select name="refInstAsignatura" class="form-control">
						<?php foreach($asignaturas as $row):?>
							<?php echo '<option value= "' .$row->id. '"> '.$row->nombre.' - '.$row->seccion.' </option>';?>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-12">
					<strong>Profesor</strong>
					<select name="refProfesor" class="form-control">
						<?php foreach($profesores as $row):?>
							<?php echo '<option value="' .$row->correo. '"> '.$row->nombre.' </option>';?>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-md-12">
					<button type="submit" class="button btn-success">Aceptar</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
