
	<div id="listado">
	<div class="container">
		<h1>Profesores</h1>

		<a href="<?php echo base_url('index.php/administracion/crear')?>" class="btn btn-success">
          <span class="glyphicon glyphicon-plus"></span> Agregar Profesor
        </a>

		<table class="table table-striped" align="center">
			<thead>
				<tr>
					<th>Correo</th>
					<th>Nombre</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<? $i=0; foreach($profesores as $row):?>
				<tr>
					<td>
						<input type="hidden" id="correo<?=$i?>" value="<?= $row->correo?>">
						<? echo $row->correo; ?>
					</td>
					<td>
						<? echo $row->nombre;?>
					</td>
					<td>
						<button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button>
					</td>
				</tr>
				<? $i++; endforeach;?>
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
		var base_url = window.location.origin+'/TecWeb/index.php/administracion';
		var correo = $("#correo"+indice).val();
		console.log("eliminar");
		console.log(correo);
		$.post(
			base_url+"/eliminarProfesor",
			{correo: correo},
			function(){
				$("#listado").hide('slow');
				cargarDatos();
				$("#listado").show('slow');
			}
		)
	}

</script>
