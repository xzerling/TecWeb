
<div id="listado">
<div id="container">
	<h1>Módulo Desempeño</h1>

	<div id="desempeño">
    <table id="tabla" name="tabla" class="table table-striped">
	<th>Nombre Asignatura</th>
	<th>Año</th>
	<th>Nombre Alumno</th>
	<th>Matrícula</th>
	<th>Nota</th>
	<?$i=0;foreach($calificaciones as $row):?>
		<tr class="trhideclass<?=$i?>">
			<td>
				<input type="hidden" id="refAsignatura<?=$i?>" value="<?=$row['refAsignatura']?>" readonly>
				<input type="hidden" id="nombreAsignatura<?=$i?>" value="<?=$row['nombreAsignatura']?>" readonly>
				<p><?=$row['nombreAsignatura']?></p>
			</td>

			<td><input type="hidden" id="anio<?=$i?>" value="<?=$row['anio']?>" readonly>
				<p><?=$row['anio']?></p>
			</td>

			<td>
				<input type="hidden" id="nombre<?=$i?>" value="<?=$row['nombre']?>" readonly>
				<p><?=$row['nombre']?></p>
			</td>

			<td><input type="hidden" id="refAlumno<?=$i?>" value="<?=$row['refAlumno']?>" readonly>
				<p><?=$row['refAlumno']?></p>
			</td>

			<td>
				<input type="hidden" id="nota<?=$i?>" value="<?=$row['nota']?>" readonly>
				<p><?=$row['nota']?></p>
			</td>

			
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
				<input type="hidden" id="refAsignaturaEdit">
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="nombreEdit" disabled="disabled">
				</div>
			</div>

			<div class="form-group">
				<label for="seccionEdit" class="col-lg-2 control-label">Seccion</label>
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="seccionEdit">
				</div>
			</div>

			<div class="form-group">
				<label for="semestreEdit" class="col-lg-2 control-label">Semestre</label>
				<div class="col-lg-10">
				<select id="semestreEdit" class="form-control">
						<option value="1">Otoño</option>
						<option value="2">Primavera</option>
						<option value="3">Verano</option>
						<option value="4">Invierno</option>
					</select>
				</div>
			</div>

			<div class="form-group">
				<label for="anioEdit" class="col-lg-2 control-label">Año</label>
				<div class="col-lg-10">
					<input type="text" class ="form-control" id="anioEdit">
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
	$("#searchFilter").change(function(){
	  filtrar();
	}); 

	$('#searchFilter').on('input',function(e){
		var tabla = $($('#tabla').children()[0]).children();
		var largoTabla = tabla.length;
	    mostrarTodos(largoTabla);
	});

	function filtrar(){
		var searchFilter = $('#searchFilter').val();
		var atributoFilter = $('#atributoFilter').val();
		var tabla = $($('#tabla').children()[0]).children();
		var largoTabla = tabla.length;

		var localNombre;
		var localSemestre;
		var localAnio;

		console.log(searchFilter, atributoFilter, largoTabla);
		
		for (var i = 0; i < largoTabla-1 ; i++) {
			localRow = tabla[i];

			localNombre = $("#nombre"+i).val();
			localSemestre = $("#semestre"+i).val();;
			localAnio = $("#anio"+i).val();

			console.log(localNombre, localSemestre, localAnio, atributoFilter);

			if(searchFilter != ""){
				//ocultarTodos(largoTabla);
				//nombre
				if(atributoFilter == '1'){
					if(localNombre != searchFilter){
						console.log("mostrar");
						$('.trhideclass'+(i)).hide();
					}
				}else if(atributoFilter == '2'){
					//semestre
					if(localSemestre != searchFilter){
						console.log("mostrar");
						console.log(i);
						$('.trhideclass'+(i)).hide();
					}
				}else if(atributoFilter == '3'){
					//año	
					if(localAnio != searchFilter){
						console.log("mostrar");
						$('.trhideclass'+(i)).hide();
					}
				}
			}else{
				mostrarTodos(largoTabla);
			}
		}
	}

	function ocultarTodos(largoTabla){
		var tabla = $($('#tabla').children()[0]).children();
		
		for (var i = 0; i < largoTabla-1 ; i++) {
			$('.trhideclass'+(i)).hide();
		}
	}

	function mostrarTodos(largoTabla){
		var tabla = $($('#tabla').children()[0]).children();
		
		for (var i = 0; i < largoTabla-1 ; i++) {
			$('.trhideclass'+(i)).show();
		}
	}

	function editar(indice){
		console.log("editar")
		console.log(indice);
		$("#idEdit").val($("#id"+indice).val());
		$("#refAsignaturaEdit").val($("#refAsignatura"+indice).val());
		$("#nombreEdit").val($("#nombre"+indice).val());
		$("#seccionEdit").val($("#seccion"+indice).val());
		$("#semestreEdit").val($("#semestre"+indice).val());
		$("#anioEdit").val($("#anio"+indice).val());
		$("#myModal1").modal('show');
	}

	function cargarDatos(){
		var base_url = "<? echo base_url()?>";
		$.post(
			base_url+"index.php/instanciaAsignatura/cargarDatos",
			{},
			function(url,data){
				$("#listado").html(url,data);
			}
		);
	}

		function guardarCambios() {
		var id 		= $("#idEdit").val();
		var seccion = $("#seccionEdit").val();
		var semestre= $("#semestreEdit").val();
		var anio 	= $("#anioEdit").val();
		var refAsignatura = $("#refAsignaturaEdit").val();

		var base_url = "<? echo base_url()?>";
		$.post(
			base_url+"index.php/instanciaAsignatura/guardarCambios",
			{
				id:id,
				seccion: seccion,
				semestre: semestre,
				anio: anio,
				refAsignatura: refAsignatura
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
			base_url+"index.php/instanciaAsignatura/eliminarDato",
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
