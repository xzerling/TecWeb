       	
	<div class="row" style="margin: 0;" >
		<div class="col-12" align="center">
			<div class="col-md-4 col-md-offset-4" align="center">
				<br>
				<h2>Iniciar sesion en el sistema</h2>
				<form method="post" action="<?= base_url()?>Welcome/loginf">
					<div class="form-group">
						<input class = "form-control" type="text" name="rut" placeholder="rut xxXXXxxx-X" 
						required maxlength="10" pattern="\d{3,8}-[\d|kK]{1}">
					</div>
					<div class="form-group">
						<input class = "form-control" type="password" name="clave" placeholder="Contraseña" required>	
					</div>	
					<!--button type="submit" class="btn btn-dark btn-block">Entrar</button-->
					<a href="<?=base_url()?>index.php/dashboard">Entrar</a>	
					<b>
					<!--a href="<?= base_url()?>Welcome/registrarse" style="color:#34495E">Aun no esta registrado, hacer click aqui</a-->
					</b>	
				</form>		
			</div>
		 </div>
 	  </div>
