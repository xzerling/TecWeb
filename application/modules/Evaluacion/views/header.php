<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Bienvenido</title>
<link rel="shortcut icon" href="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSCdu7rmFivHO96-lkavgW2G93YH_hGBGKkIKjJ0iMLiphyeO1n" style="border-radius: 50%;">

	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>/css/hoja1.css">
	<script type="text/javascript" src="<?= base_url()?>/js/inicio.js"></script>
	<style type="text/css">


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

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Plataforma de gestion</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Brand</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="nav-item ">
          <a href="href=<?= base_url()?>index.php">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url()?>index.php/dashboard">Dashboard</a>
				</li>
				<li class="nav-item">
           <a class="nav-link" href="<?=base_url()?>index.php/instanciaAsignatura">Asignatura</a>
        </li>
        <li class="nav-item active">
        	<a class="nav-link" href="<?=base_url()?>index.php/evaluacion">Evaluacion</a>
        </li>
    		<li class="nav-item ">
          <a class="nav-link" href="<?=base_url()?>index.php/nota">Notas</a>
        </li>
        <li class="nav-item ">
         <a class="nav-link" href="<?=base_url()?>index.php/observacion">Observacion</a>
        </li>
        <li class="nav-item ">
           <a class="nav-link" href="<?=base_url()?>index.php/desempeno">Desempeño</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="<?=base_url()?>index.php/notificacion">Notificacion</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="<?= base_url()?>Welcome/loginf">Cerrar sesion</a>
         </li>			
			</ul>
      <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Buscar</button>
      </form>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
