<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>


	<meta charset="utf-8">
	<title>Vista Asignaturas</title>

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

<div id="listado">
<div id="container">
	<h1>Módulo Asignaturas</h1>

	<div id="asignaturas">



		<div id="filtrar" class="col-lg-3">
			<input type="text" class ="form-control" id="searchFilter" placeholder="Buscar">
			<select id="atributoFilter" class="form-control">
							<option value="1">Nombre</option>
							<option value="2">Semestre</option>
							<option value="3">Año</option>
						</select>
			<button class="btn btn-secondary" onclick="filtrar()">Filtrar</button>
			<br>
		</div>
			<br>
		<table id="tabla" name="tabla" class="table table-striped">
			<th>Nombre</th>
			<th>Seccion</th>
			<th>Semestre</th>
			<th>Anio</th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>


			<?$i=0;foreach($asignaturas as $row):?>
				<tr class="trhideclass<?=$i?>">
					<td><input type="hidden" id="id<?=$i?>" value="<?=$row['id']?>" readonly>
						<input type="hidden" id="refAsignatura<?=$i?>" value="<?=$row['refAsignatura']?>" readonly>
						<input type="hidden" id="nombre<?=$i?>" value="<?=$row['nombre']?>" readonly>
						<p><?=$row['nombre']?></p>
					</td>

					<td><input type="hidden" id="seccion<?=$i?>" value="<?=$row['seccion']?>" readonly>
						<p><?=$row['seccion']?></p>
					</td>

					<td><input type="hidden" id="semestre<?=$i?>" value="<?=$row['semestre']?>" readonly>
						<p><?=$row['semestre']?></p>
					</td>

					<td><input type="hidden" id="anio<?=$i?>" value="<?=$row['anio']?>" readonly>
						<p><?=$row['anio']?></p>
					</td>
					<td><button class="btn btn-secondary" onclick="editar(<?=$i?>)">Editar</button></td>
					<td><button class="btn btn-danger" onclick="eliminar(<?=$i?>)">Eliminar</button></td>
					<td><button class="btn btn-success" onclick="cargarDatoss(<?=$i?>)">Agregar Archivo</button></td>
					<td><a href="<?=base_url()?>index.php/instanciaAsignatura/verDatos?idInstancia=<?=$row['id']?>" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Ver Archivos</a></td>
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

<div id="myModal2" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
  				<h3 class="mt-5">Importar alumnos desde Excel a MySQL usando PHP</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
			</div>
			<div class="modal-body">
				


	        <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
	            <div>
	                <label>Elija Archivo Excel</label> <input type="file" name="file"
	                    id="file" accept=".xls,.xlsx">

	            </div>
	        
	        </form>
        


			</div>
			<div class="modal-footer">
				<button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                <button id="submit" name="import" class="btn btn-success" onclick="enviarExcel()">Importar Registros</button>
	        
			</div>
		</div>
	</div>
	
</div>


<div id="myModal33" style="display: none;" class="modal" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
  				<h3 class="mt-5">Agregar Archivos al Curso</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
      			<span aria-hidden="true">&times;</span>
        		</button>
			</div>

			<div class="modal-body">

				<form class="form-group"  method="post" name="cargarArchivo" id="cargarArchivo" enctype="multipart/form-data">

					<div class="form-group">
						<label for="nombreA" class="col-lg-2 control-label">Nombre</label>
						<input type="hidden" id="idA">
						<input type="hidden" id="refAsignaturaA">
						<div class="col-lg-10">
							<input type="text" class ="form-control" id="nombreA" disabled="disabled">
						</div>
					</div>

					<div class="form-group">
						<label for="seccionEdit" class="col-lg-2 control-label">Seccion</label>
						<div class="col-lg-10">
							<input type="text" class ="form-control" id="seccionA" disabled="disabled">
						</div>
					</div>

					<div class="form-group">
						<label for="semestreA" class="col-lg-2 control-label">Semestre</label>
						<div class="col-lg-10">
						<select id="semestreA" class="form-control" disabled="disabled">
								<option value="1">Otoño</option>
								<option value="2">Primavera</option>
								<option value="3">Verano</option>
								<option value="4">Invierno</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="anioA" class="col-lg-2 control-label">Año</label>
						<div class="col-lg-10">
							<input type="text" class ="form-control" id="anioA" disabled="disabled">
						</div>
					</div>
				
		            <label for="archivo" class="col-sm2 control-label">Elegir archivo</label>
		          
					<div class="col-lg-10">
						<input type="file" id="archivoCurso" name="archivoCurso" accept="">
						<input type="hidden" id="idA" name = idA>
					</div>

					<div class="modal-footer">
					<button class="btn btn-warning" data-dismiss="modal">Cancelar</button>
	                <button type="submit" id="submit" value = "Submit"  name="import" class="btn btn-success" onclick="upload_file()">Cargar Archivo</button>
					</div>

				</form> 
			</div>
		</div>
	</div>
</div>
	

</body>
</html>

<script>
	function upload_file(){//Funcion encargada de enviar el archivo via AJAX
				$(".upload-msg").text('Cargando...');
				var inputFile = document.getElementById("archivoCurso");
				var file = inputFile.files[0];
				var data = new FormData();
				data.append('archivoCurso',file);
				var base_url = "<? echo base_url()?>";
				console.log("uploading");


				var idA = $("#idA").val();
				data.append('idA', idA);
				var nombreCurso = $("#nombreA").val();
				data.append('nombreCurso', nombreCurso);
				var anio = $("#anioA").val();
				data.append('anio', anio);
				var semestre = $("#semestreA").val();
				data.append('semestre', semestre);
				var nombreArchivo = $('#archivoCurso').prop('files')[0].name;
				data.append('nombreArchivo', nombreArchivo);


				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					data.append('file'+i, file);
				});*/
							
				$.ajax({
					url: base_url+"index.php/instanciaAsignatura/cargarArchivo",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					//idA: idA,
					//file: file,
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}


</script>





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

	function cargarDatoss(indice)
	{

		var base_url = "<? echo base_url()?>";
		console.log("mostrando modal 3")
		console.log("indice: " + indice)
		console.log($("#id"+indice).val());
		$("#idA").val($("#id"+indice).val());
		console.log("idA: "+$("#idA").val());
		$("#refAsignaturaA").val($("#refAsignatura"+indice).val());
		console.log($("idA").val());
		$("#nombreA").val($("#nombre"+indice).val());
		console.log($("idA").val());
		$("#seccionA").val($("#seccion"+indice).val());
		$("#semestreA").val($("#semestre"+indice).val());
		$("#anioA").val($("#anio"+indice).val());


		$("#idEdit").val($("#id"+indice).val());

		$("#myModal33").modal('show');
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


	function CargarExcel(){
		console.log("cargar Excel")

		//$("#idEdit").val($("#id"+indice).val());

		$("#myModal2").modal('show');
	}

	function enviarExcel() {
		var base_url = "<? echo base_url()?>";
		var file = $('#file').prop('files')[0];
	    var form_data = new FormData();                  
   		form_data.append('archivo', file);
   		alert(form_data.get("archivo"));  

	$.ajax(

    {
        url : base_url+"index.php/instanciaAsignatura/cargarAlumnos",
        type: "POST",
        contentType: false,
        processData: false,
        data: form_data,  
        success:function(data, textStatus, jqXHR)
        {
        	console.log("funciona")
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
            console.log("error al enviar el archivo")
            console.log(textStatus)
            console.log(errorThrown)

        }
    });

	}


</script>
