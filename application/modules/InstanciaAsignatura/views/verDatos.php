<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Archivos Cargados</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<div class="container">


		<form method="post" action="<?php echo base_url('index.php/instanciaAsignatura');?>">

				<form class="form-group"  method="post" name="cargarArchivo" id="cargarArchivo" enctype="multipart/form-data">
					<h3>Archivos Cargados</h3>
					<div class="form-group">
						<input type="hidden" id="idA">
						<input type="hidden" id="refAsignaturaV">
						<input type="hidden" class ="form-control" id="nombreV" disabled="disabled">

					</div>

					<div class="form-group">

							<input type="hidden" class ="form-control" id="seccionV" disabled="disabled">


					<div class="form-group">
						<label for="semestreV" class="col-lg-2 control-label">Semestre</label>
						<div class="col-lg-10">
						<select id="semestreV" class="form-control" disabled="disabled">
								<option value="1">Otoño</option>
								<option value="2">Primavera</option>
								<option value="3">Verano</option>
								<option value="4">Invierno</option>
							</select>
						</div>
					</div>


					<label for="anioA" class="col-lg-2 control-label">Año</label>
						<div class="col-lg-10">
							<input type="text" class ="form-control" id="anioV" disabled="disabled">
						</div>

			    <table id="tabla" name="tabla" class="table table-striped">
				<th>Nombre</th>
				<th>Directorio</th>
				<th></th>

				<?$i=0;foreach($tabla as $row):?>
					<tr class="trhideclass<?=$i?>">
						<td><p><?=$row['semestre']?></p></td>

						<td><input type="hidden" id="urlDocumento<?=$i?>" value="<?=$row['urlDocumento']?>" readonly>
							<p><?=$row['urlDocumento']?></p>
						</td>
						<td><a class="btn btn-primary" title="Descargar Archivo" href="<?=base_url()?><?=$row['urlDocumento']?>" download= >Descargar </a></td>

					</tr>
				<?$i++;endforeach;?>
				</table>


					<div class="modal-footer">
					<button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
					</div>

				</form> 
		</form>
	</div>

</body>
</html>
