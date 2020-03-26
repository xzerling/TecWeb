<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	<title>Vista Observacion</title>

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

	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</head>

	<body>
		<div id="listado">
			<div id="container">
				<h1>Módulo Observación</h1>

				<a href="<?= base_url('index.php/observacion/crear/')?>">Agregar Observacion</a>

				<table class="table table-striped" align="center">
					<thead>
						<tr>
							<th>Profesor</th>
							<th>Alumno</th>
							<th>Comentario</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=0; foreach($resultados as $row):?>
						<tr>
							<td>
								<input type="hidden" id="id<?=$i?>" value="<?=$row->id?>" readonly> 
								<input type="hidden" id="profesor<?=$i?>" value="<?= $row->correo?>" readonly>
								<?php echo $row->correo; ?>
							</td>
							<td>
								<input type="hidden" id="matricula<?=$i?>" value="<?=$row->matricula?>" readonly>
								<input type="hidden" id="nombre<?=$i?>" value="<?=$row->nombre?>" readonly>
								<?php echo $row->nombre;?>
							</td>
							<td>
								<input type="hidden" id="comentario<?=$i?>" value="<?= $row->comentario?>" readonly>
								<?php echo $row->comentario?>
							</td>
							<td>
								<button class="btn btn-secondary" onclick="editar(<?=$i?>)">Editar</button>
							</td>
							<td>
								<button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button>
							</td>
						</tr>
						<?php $i++; endforeach; ?>
					</tbody>
				</table>
				<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>

			</div>
		</div>

		<div id="myModal1" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5>Editar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
			</div>
			<div class="modal-body">
				

			<div class="form-group">
				<label for="correoEdit" class="col-lg-2 control-label">Profesor</label>	
				<input type="hidden" id="idEdit">
				<div class="col-lg-10">
					<input type="text" class="form-control" id="correoEdit" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="matriculaEdit" class="col-lg-8 control-label">Alumno</label>
				<input type="hidden" id="matriculaEdit">
				<div class="col-lg-10">
					<input type="text" class="form-control" id="nombreEdit" readonly>
				</div>
			</div>

			<div class="form-group">
				<label for="comentarioEdit" class="col-lg-8 control-label">Comentario</label>
				<div>
					<input type="text" class="form-control" id="comentarioEdit">
				</div>
			</div>


			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
				<button class="btn btn-success" onclick="guardarCambios()">Guardar</button>
			</div>
		</div>
	</div>
		
	</div>


	</body>

</html>

<script type="text/javascript">
	function editar(indice){
		$("#idEdit").val($("#id"+indice).val());
		$("#correoEdit").val($("#profesor" + indice).val());
		$("#matriculaEdit").val($("#matricula" + indice).val());
		$("#nombreEdit").val($("#nombre" + indice).val());
		$("#comentarioEdit").val($("#comentario" + indice).val());
		$("#myModal1").modal('show');
	}

	function cargarDatos(){
		var base_url = window.location.origin+window.location.pathname;
		$.post(
			base_url+"/index",
			{},
			function(url,data){
				$("#listado").html(url,data);
			}
		);
	}

	function guardarCambios() {
		var id 		= $("#idEdit").val();
		var correo 	= $("#correoEdit").val();
		var matricula 	= $("#matriculaEdit").val();
		var comentario = $("#comentarioEdit").val();
		var base_url = window.location.origin+window.location.pathname;
		console.log(id,correo,matricula,comentario);
		console.log(base_url)
		$.post(
			base_url+'/guardarCambios',
			{
				id: id,
				correo: correo,
				matricula: matricula,
				comentario: comentario
			},function(){
				$("#myModal1").modal('hide');
				$("#listado").hide('slow');
				cargarDatos();
				$("#listado").show('slow');
			}
		);
	}

	function eliminar(indice){
		var base_url = window.location.origin+window.location.pathname;
		var id = $("#id"+indice).val();
		console.log("eliminar");
		console.log(id);
		$.post(
			base_url+"/eliminarDato",
			{id: id},
			function(){
				$("#listado").hide('slow');
				cargarDatos();
				$("#listado").show('slow');
			}
		)
	}

</script>