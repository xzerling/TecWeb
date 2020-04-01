<div id="listado">
	<div class="container">

		<h1>Cursos asignados a un Profesor</h1>

		<a href="<?= base_url()?>index.php/instanciaAsignatura/asignarProfesor">Asignar Profesor</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Profesor</th>
					<th>Asignatura</th>
					<th>Seccion</th>
				</tr>
			</thead>
			<tbody>
				
				<?php $i=0; foreach($asignaturas as $row):?>
					<tr>
						<td>
							<input type="hidden" id="refInstAsignatura<?=$i?>" value="<?= $row->refInstAsignatura?>">
							<?php echo $row->nombre; ?>
						</td>
						<td>
							<?php echo $row->nombreasignatura;?>
						</td>
						<td>
							<?php echo $row->seccion; ?>
						</td>
						<td>
							<button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button>
						</td>
					</tr>
				<?php $i++; endforeach; ?>
				
			</tbody>
		</table>
	</div>
	</div>
</body>
</html>

<script type="text/javascript">
	
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

	function eliminar(indice){
		var base_url = window.location.origin+'/TecWeb/index.php/instanciaAsignatura';
		var refInstAsignatura = $("#refInstAsignatura"+indice).val();
		console.log("eliminar");
		console.log(refInstAsignatura);
		$.post(
			base_url+"/eliminarAsignacion",
			{refInstAsignatura: refInstAsignatura},
			function(){
				$("#listado").hide('slow');
				cargarDatos();
				$("#listado").show('slow');
			}
		)
	}
</script>
