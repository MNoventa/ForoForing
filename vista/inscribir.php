<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FORING - Darse de alta</title>	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!--<script src="../js/script.js"></script>-->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="../style/estilos.css">
	<meta name="keywords" content="foro, foring, inscribirse, dar de alta, login, mario garcia lucas">
	<meta name="description" content="Página de inscripción de Foring, no pierdas un minuto más sin registrarte en el foro.">
	<link rel="shortcut icon" href="../img/enigma.ico"/>	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<script src="../js/formulario.js"></script>

</head>

<body>

	<section id="banner" class="inscribirse">
		<div class="contGnral formunico">
			<article class="contenedorFormulario formunico">
				<h2 class="formins">¡Accede a FORING!</h2>
				<div class="wrap formunico">
					<img src="../img/logo.png" alt="">

					<?php
						if(isset($_GET["errusuario"])){
							echo "<span>El correo o contraseña son incorrectos.</span>";
						}
					?>

					<form action="../controlador/us_validar.php" class="formulario" name="formulario_registro" method="post">
						<div>
							<div class="input-group">
								<input type="email" id="emailForm" name="email">
								<label class="labelForm" for="email">Correo:</label>
							</div>

							<div class="input-group">
								<input type="password" id="passForm" name="pass">
								<label class="labelForm" for="pass">Contraseña:</label>
							</div>

							<div class="input-group checkbox">
								<input type="checkbox" name="terminos" id="terminos" value="true">
								<label for="terminos">Acepto el uso de cookies para esta web</label>
								<a href="http://politicadecookies.com/" target="blank">Saber más.</a>
							</div>

							<input type="submit" id="btn-submitForm" value="Registrarme">	
						</div>
					</form>
				
				<a href="../index.php" class="volverInicio">Volver a Inicio</a>
				</div>
			</article>
		</div>
	</section>


<script>
	
$(document).ready(function(){

	var tamañoP = $(window).height();

	if ($(window).width()<400){
		tamañoP = tamañoP+130;
	}else{
		tamañoP = $(window).height();
	}

	$("#banner").css({"height":tamañoP + "px"});
});

</script>

</body>
</html>