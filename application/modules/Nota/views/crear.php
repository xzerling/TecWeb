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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<div class="container">
		<h1>Crear una Nota</h1>

		<form method="post" action="<?php echo base_url('index.php/nota/crearNota');?>">
			<div class="form-group">

				<div class="col-md-12">
					<strong>Seleccione la evaluación</strong>
					<select name="asignatura" class="form-control" id="asignatura"> 
						<?$i=0;foreach($asignaturas as $row):?>

							<? echo '<option value="'.$row['id'].'"> '.$row['id'].'. '.$row['nombre'].' '.$row['anio'].' '.$row['semestre'].' '.$row['seccion'].' </option>';?> 
						<?$i++;endforeach;?>
					</select> 
				</div>
				<div class="col-md-12">
					<strong>Fecha Evaluacion</strong>

					<?$i=0;foreach($asignaturas as $row):?>

						<input type="hidden" id="fecha<?=$row['id']?>" value="<?=$row['fecha']?>" readonly> 
						<?$i++;endforeach;?>
					<input type="text" id="fecha" name="fecha" class="form-control" value= "" placeholder="Seleccione evaluacion" required="" disabled="disabled">
				</div>
				<div class="col-md-12">
					<strong>Alumno</strong>
					<select name="alumno" class="form-control" id="alumno"> 
						<?$i=0;foreach($alumnos as $row):?>

							<? echo '<option value="'.$row['matricula'].'"> '.$row['nombre'].'</option>';?> 
						<?$i++;endforeach;?>
					</select> 
				</div>
				<div class="col-md-12">
					<strong>Nota</strong>
					<input type="double" name="nota" class="form-control" placeholder="Ingrese un numero, por ejemplo: 7.0" required="">
				</div>

				<div class="col-md-12">
					<button class="btn btn-success" type="submit">Aceptar</button>
				</div>
			</div>
		</form>
	</div>

</body>
</html>

<script type="text/javascript">
	$("#asignatura").change(function(){
	  console.log("cambio");

	  var id = $("#asignatura").val();
	  obtenerAlumnos(id);

	  var fechaInicial = $("#fecha"+id).val();
	  $("#fecha").val(fechaInicial);
	}); 

	var id = $("#asignatura").val();
	var fechaInicial = $("#fecha"+id).val();
	$("#fecha").val(fechaInicial);

	function obtenerAlumnos(id){
		var base_url = "<? echo base_url()?>";
		console.log("obtenerAlumnos");
		console.log(id);
		$.post(
			base_url+"index.php/nota/cargarAlumnosNuevo",
			{id:id},
			function(url, data){
				//var html = $.parseHTML(data);
				//alert(url);
				var x = document.createElement('div');
   				x.innerHTML = url;

				var nuevosAlumnos = x.querySelector('#alumno').innerHTML;
				document.querySelector('#alumno').innerHTML = nuevosAlumnos;
				
			}
		)
	}
</script>
