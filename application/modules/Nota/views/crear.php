<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Crear Notas</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
