<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Monitoreo de Evaluaciones</title>

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

	.my-custom-scrollbar {
		position: relative;
		height: 250px;
		overflow: auto;
	}
	.table-wrapper-scroll-y {
		display: block;
	}

	.box-green{
	background-color:#72ff67; 
	width:30px;
	height:30px;
	}

	.box-yellow{
	background-color:#fff667; 
	width:30px;
	height:30px;
	}

	.box-red{
	background-color:#ff7676; 
	width:30px;
	height:30px;
	}	

	</style>

	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
	<h1>Monitoreo de ingreso de notas</h1>

	<div class="container">
		<div class="row">
			<div class="box-green"></div> <p> Calificadas </p>
			<div class="box-yellow"></div> <p> Pendientes de Calificar </p>
			<div class="box-red"></div> <p> Atrasadas sin Calificar </p>
		</div>
	</div>

	<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Asignatura</th>
					<th>Seccion</th>
					<th>Semestre</th>
					<th>Año</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>
				<? foreach($evaluadas as $row): ?>
				<tr bgcolor="#72ff67">
					
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->semestre; ?></td>
						<td> <? echo $row->anio; ?></td>
						<td> <? echo $row->fecha ?> </td>
				</tr>
				<? endforeach;?>
				<? foreach($pendientes as $row): ?>
					<tr bgcolor="fff667">
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->semestre; ?></td>
						<td> <? echo $row->anio; ?></td>
						<td> <? echo $row->fecha; ?> </td>
					</tr>
				<? endforeach;?>
				<? foreach($atrasadas as $row): ?>
					<tr bgcolor="ff7676">
						<td> <? echo $row->nombre; ?> </td>
						<td> <? echo $row->seccion; ?> </td>
						<td> <? echo $row->semestre; ?></td>
						<td> <? echo $row->anio; ?></td>
						<td> <? echo $row->fecha; ?> </td>
					</tr>
				<? endforeach;?>
			</tbody>
		</table>
	</div>

</body>
</html>