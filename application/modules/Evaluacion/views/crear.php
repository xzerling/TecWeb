
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<div class="container">
		<h1>Crear una Evaluacion</h1>

		<form method="post" action="<?php echo base_url('index.php/evaluacion/crear_evaluacion');?>">
			<div class="form-group">
				<div class="col-md-12">
					<strong>Fecha</strong>
					<input type="date" name="fecha" class="form-control" placeholder="Ingrese Fecha" required="">
				</div>
				<div class="col-md-12">
					<strong>¿ Cuántos días antes le gustaría recibir notificaciones de la evaluación ?</strong>
					<input type="number" name="diasAntes" class="form-control" placeholder="Ingrese un numero" required="">
				</div>
				<div class="col-md-12">
					<strong>¿ Cuántos días después le gustaría recibir notificaciones de la evaluación ?</strong>
					<input type="number" name="diasDespues" class="form-control" placeholder="Ingrese un numero" required="">
				</div>
				<div class="col-md-12">
					<strong>Asignatura</strong>
					<select name="refInstAsignatura" class="form-control">
						<?php foreach($resultados as $row):?>
							<?php echo '<option value="'.$row->id.'"> '.$row->nombre.' '.$row->anio.' '.$row->semestre.' '.$row->seccion.'</option>';?>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col-md-12">
					<button class="btn btn-success" type="submit">Aceptar</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>
