
<div id="listado">
<div id="container">
	<h1>Vista Asignaturas BD</h1>

	<div id="asignaturas">

    <table class="table table-striped">
	<th>Nombre</th>
	<th>Estado</th>
	<th></th>
	<th></th>
	<?$i=0;foreach($asignaturas as $row):?>
		<tr>
			<td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
				<input type="hidden" id="nombre<?=$i?>" value="<?=$row['nombre']?>" readonly>
				<p><?=$row['nombre']?></p>
			</td>
			<td><input type="hidden" id="estado<?=$i?>" value="<?=$row['estado']?>" readonly>
				<p><?=$row['estado']?></p>
			</td>
			
			<td><button class="btn btn-secondary" onclick="editar(<?=$i?>)">Editar</button></td>
			<td><button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button></td>
		</tr>
	<?$i++;endforeach;?>
	</table>

	</div>


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
				<label for="nombreEdit" class="col-lg-2 control-label">Nombre</label>
				<input type="hidden" id="idEdit">
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="nombreEdit">
				</div>
			</div>

			<div class="form-group">
				<label for="estadoEdit" class="col-lg-2 control-label">Estado</label>
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="estadoEdit">
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
		$("#nombreEdit").val($("#nombre"+indice).val());
		$("#estadoEdit").val($("#estado"+indice).val());
		$("#myModal1").modal('show');
	}

	function cargarDatos(){
		var base_url = "<? echo base_url()?>";
		$.post(
			base_url+"index.php/asignatura/cargarDatos",
			{},
			function(url,data){
				$("#listado").html(url,data);
			}
		);
	}

		function guardarCambios() {
		var id 		= $("#idEdit").val();
		var nombre 	= $("#nombreEdit").val();
		var estado 	= $("#estadoEdit").val();
		var base_url = "<? echo base_url()?>";
		console.log(id, nombre, estado);
		$.post(
			base_url+"index.php/asignatura/guardarCambios",
			{
				id:id,
				nombre:nombre,
				estado: estado
			},function(){
				$("#myModal1").modal('hide');
				$("#listado").hide('slow');
				//cambiar cargar datos
				cargarDatos();
				$("#listado").show('slow');
			}
		);
	}

	function eliminar(indice){
		var base_url = "<? echo base_url()?>";
		console.log("eliminar");
		console.log($("#id"+indice).val());
		$.post(
			base_url+"index.php/asignatura/eliminarDato",
			{id:$("#id"+indice).val()},
			function(){
				//alert("Dato Eliminar");
				$("#listado").hide('slow');
				cargarDatos();
				$("#listado").show('slow');
			}
		)
	}


</script>
