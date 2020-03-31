<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
      	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
<body>

<div id="listado">
<div id="container">
	<h1>Módulo Asignaturas</h1>

	<div id="asignaturas">

	<button class="btn btn-secondary" onclick="CargarExcel()">Cargar Alumnos</button>

	<a href="<?=base_url()?>index.php/instanciaAsignatura/crear" class="btn btn-success">
          <span class="glyphicon glyphicon-plus"></span> Agregar Asignatura
        </a>
	<form method="post" action="<?=base_url()?>index.php/asignatura">
		<button class="btn btn-warning" type="submit">BD Asignaturas</button>
	</form>

	<div id="filtrar" class="col-lg-3">
		<input type="text" class ="form-control" id="searchFilter">
		<select id="atributoFilter" class="form-control">
						<option value="1">Nombre</option>
						<option value="2">Semestre</option>
						<option value="3">Año</option>
					</select>
		<button class="btn btn-secondary" onclick="filtrar()">Filtrar</button>
	</div>

    <table id="tabla" name="tabla" class="table table-striped">
	<th>Nombre</th>
	<th>Seccion</th>
	<th>Semestre</th>
	<th>Anio</th>
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
		</tr>
	<?$i++;endforeach;?>
	</table>

	</div>
	

	<a href="<?= base_url()?>index.php/instanciaAsignatura/asignaturasAsignadas"><button class="btn btn-success">Asignaturas Asignadas</button></a>

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