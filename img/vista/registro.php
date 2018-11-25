<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FORING - Registro</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!--<script src="../js/script.js"></script>-->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="../style/estilos5.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<link rel="shortcut icon" href="../img/enigma.ico"/>
	<meta name="keywords" content="foro, foring, iniciar sesión, acceder, mario garcia lucas">
	<meta name="description" content="Acceder a FORING y reanuda las conversaciones que tienes con los demás, o crea temas nuevos.">
	<script src="../js/formulario.js"></script>

</head>

<body>
	


	<section id="banner" class="registro">
		<div class="contGnral formunico">
			<article class="contenedorFormulario formunico">
				<h2>¡Regístrate en FORING!</h2>
				<div class="wrap formunico">
					<img src="../img/logo.png" alt="">

					<?php

					/*Mensajes de error en el caso de que:

						- Usuario ya esté en uso.
						- Correo ya esté en uso.
						- Nombre tenga más de 10 caracteres.
					*/
						if(isset($_GET["errusuario"])){
							$usuario = $_GET["errusuario"];
							echo "<span>*¡El nombre de usuario: <u>".$usuario."</u> ya tiene dueño!</span>";
						
						}else if(isset($_GET["errlong"])){
							echo "<span>*El nombre no puede tener más de 10 caracteres.</span>";
						
						}else if(isset($_GET["errcorreo"])){
							$correo = $_GET["errcorreo"];
							echo "<span>*¡La dirección de e-mail: <u>".$correo."</u> ya tiene dueño!</span>";
						
						}
					?>

					<form action="../controlador/us_regis.php" class="formulario" name="formulario_registro" method="post">
						<div>
							<div class="input-group">
								<input type="text" id="nombreForm" name="nombre">
								<label class="labelForm" for="nombre">Nombre:</label>
							</div>

							<div class="input-group">
								<input type="email" id="emailForm" name="email">
								<label class="labelForm" for="email">Correo:</label>
							</div>

							<div class="input-group">
								<input type="password" id="passForm" name="pass">
								<label class="labelForm" for="pass">Contraseña:</label>
							</div>

							<div class="input-group">
								<input type="password" id="pass2Form" name="pass2">
								<label class="labelForm" for="pass2">Repetir contraseña:</label>
							</div>

							<div class="input-group checkbox">
								<input type="checkbox" name="terminos" id="terminos" value="true">
								<label for="terminos">Acepto el uso de cookies para esta web</label>
								<a href="http://politicadecookies.com/" target="blank">Saber más.</a>
							</div>
							
							<input type="hidden" value="form2" name="form"/>
							<input type="submit" id="btn-submitForm" value="Registrarme">	
						</div>
					</form>

				<a href="pag_login.php" class="volverInicio">Volver a Inicio</a>
				</div>
			</article>
		</div>
	</section>


<script>
	
	$(document).ready(function(){

	$("#banner").css({"height":$(window).height() + "px"});
});

</script>

</body>
</html>