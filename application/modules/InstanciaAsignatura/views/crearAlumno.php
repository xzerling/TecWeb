<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<meta charset="utf-8">
	<title>Agregar alumno</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>

</head>
<body>

	<h1>Agregar nuevo alumno a asignatura </h1>
	<div class="container">
		<form method="post" action="<?= base_url()?>index.php/instanciaAsignatura/guardarAlumno">
			<div class="form-group">
				<div class="col-md-12">
					<strong> Matrícula </strong>
					<input type="text" name="matricula" class="form-control" placeholder="Matrícula" required>
				</div>
				<div class="col-md-12">
					<strong> Nombre</strong>
					<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
				</div>
				<div class="col-md-12">
					<strong> Correo </strong>
					<input type="text" name="correo" class="form-control" placeholder="Correo" required>
				</div>
				<div class="col-md-12">
					<strong> Asignatura </strong>
					<select name="refInstAsignatura" class="form-control">
						<? foreach($asignaturas as $row): ?>
							<? echo '<option value= "' .$row->id. '"> '.$row->nombre.' - '.$row->seccion.' - '.$row->semestre.' - '.$row->anio.' </option>'; ?>
						<? endforeach; ?>
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