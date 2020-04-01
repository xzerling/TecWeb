	<div id="listado">
<div id="container">
	<h1>Módulo Notas</h1>

	<!--
	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>
	!-->
		<a href="<?php echo base_url('index.php/nota/crear')?>"><button class="btn btn-warning"> Agregar Nota </button></a>
		<table class="table table-striped" align="center">
			<thead>
				<tr>
					<th>Asignatura</th>
					<th>Evaluacion</th>
					<th>Alumno</th>
					<th>Nota</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; foreach($resultados as $row):  ?>
					<tr>
						<td>
							<input type="hidden" id="id<?=$i?>" value="<?=$row->id?>" readonly>
							<input type="hidden" id="refInstAsignatura<?=$i?>" value="<?=$row->asignatura?>" readonly> 
							<?php echo $row->asignatura; ?> 
						</td>
						<td >
							<input type="hidden" id="evaluacion<?=$i?>" value="<?=$row->fecha?>" readonly> 
							<?php echo $row->fecha; ?> 
						</td>
						<td >
							<input type="hidden" id="alumno<?=$i?>" value="<?=$row->nombre?>" readonly> 
							<?php echo $row->nombre; ?> 
						</td>
						<td > <input type="hidden" id="nota<?=$i?>" value="<?=$row->nota?>" readonly> 
							<?php echo $row->nota; ?></td>
						<td><button class="btn btn-secondary" onclick="editar(<?=$i?>)">Editar</button></td>
						<td><button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button></td>

					</tr>
				<?php $i++; endforeach;?>
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
				<label for="asignaturaEdit" class="col-lg-2 control-label">Asignatura</label>
				<input type="hidden" id="idEdit">
				<input type="hidden" id="refAsignaturaEdit">
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="asignaturaEdit" disabled="disabled">
				</div>
			</div>

			<div class="form-group">
				<label for="evaluacionEdit" class="col-lg-2 control-label">Evaluacion</label>
				<input type="hidden" id="refAsignaturaEdit">
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="evaluacionEdit" disabled="disabled">
				</div>
			</div>

			<div class="form-group">
				<label for="nombreEdit" class="col-lg-2 control-label">Nombre</label>
				<input type="hidden" id="nombreEdit">
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="nombreEdit" disabled="disabled">
				</div>
			</div>


			<div class="form-group">
				<label for="notaEdit" class="col-lg-2 control-label">Nota</label>
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="notaEdit">
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
		console.log("editar")
		console.log(indice);
		$("#idEdit").val($("#id"+indice).val());
		$("#asignaturaEdit").val($("#refInstAsignatura"+indice).val());
		$("#nombreEdit").val($("#alumno"+indice).val());
		$("#evaluacionEdit").val($("#evaluacion"+indice).val());
		$("#notaEdit").val($("#nota"+indice).val());
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

		var nota = $("#notaEdit").val();

		var base_url = "<? echo base_url()?>";
		$.post(
			base_url+"index.php/nota/guardarCambios",
			{
				id:id,
				nota: nota
			},function(){
				$("#myModal1").modal('hide');
				$("#listado").hide('slow');
				//cambiar cargar datoss
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
