<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FORING - Inicio</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!--<script src="js/script.js"></script>-->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="style/estilos5.css">
	<link rel="stylesheet" href="fuentes/style1.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<meta name="keywords" content="foro, foring, crear, tema, comentario, conversación, comentar, mario garcia lucas">
	<meta name="description" content="Foring es el foro perfecto para compartir tus ideas, o hacer preguntas con total libertad, y por supuesto: GRATIS.">
	<script src="js/formulario.js"></script>
	<link rel="shortcut icon" href="img/enigma.ico"/>

</head>

<body>
	
	<header id="headerNav">
		<nav>
			<div class="contGnral">
				<img src="img/logo_ext2.png" alt="" id="logo">

				<input type="checkbox" id="checkboxMenu">
				<label id="headerMenuLabel" for="checkboxMenu" class="icon-th-menu-outline labelCnt"></label>

					<ul id="ulcnt">
						<li><a href="#sectionT">Descubre</a></li>
						<li><a href="inscribir.php">Accede</a></li>
						<li><a href="registro.php">Registrate</a></li>
					</ul>
			</div>
		</nav>
	</header>

	<section id="banner" class="formYFirstInfo">
		<div class="contGnral formYFirstInfo">
			<article class="contenedorFirstInfo">
				<h1>Intercambia tus ideas u opiniones con los demás.</h1>
				<h2>Añade comentarios en los temas de la comunidad o crea temas de conversación tú mismo.</h2>
				<a href="vista/registro.php"><input type="button" value="¡Regístrate gratis ahora!"></a>
			</article>

			<article class="contenedorFormulario formconj">
					<div id="regisForm">
						<p>¡Regístrate gratis a <strong>FORING</strong> si aún no lo has hecho!</p>
					</div>
					
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

				<div class="wrap formconj">
					
					<form action="controlador/us_regis.php" class="formulario" name="formulario_registro" method="post">

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
								
							<input type="hidden" value="form1" name="form"/>
							<input type="submit" id="btn-submitForm" value="Registrarme">
						</div>
					</form>
				</div>
			</article>
		</div>
	</section>

<section id="sectionT" class="sectTemas pprincipal">
	<div class="contGnral">

		<div id="temaYDesc">
			<h3>Temas</h3>

			<p>Descúbre los temas de conversación creados por la comunidad, y echa un vistado sobre de lo que se está hablando.</p>
		</div>
		
		<?php require_once("controlador/a_paglogin.php"); ?>
	</div>
</section>

<!-- Incluir footer dinámicamente -->

<?php require("vista/footer.php");?>


<script>
	
	$(document).ready(function(){

	$("#banner").css({"height":$(window).height() + "px"});

	var flag = false;
	var scroll;
	logo = document.getElementById("logo");	
	header = document.getElementById("headerNav");
	ul = document.getElementById("ulcnt");
	labelNav = document.getElementById("headerMenuLabel");

	$(window).scroll(function(){
			
		scroll = $(window).scrollTop();

		if(scroll>250){
			ul.style.marginTop = "0px";
			logo.style.marginTop = "12px";
			logo.style.width = "50px";
			header.style.opacity = "1";
			header.style.height = "60px";
			logo.src = "img/logo.png";
			labelNav.style.marginTop = "14px";
		}else{
			ul.style.marginTop = "20px";
			logo.style.marginTop = "7px";
			logo.style.width = "150px";
			header.style.opacity = "0.6";
			header.style.height = "100px";
			logo.src = "img/logo_ext2.png";
			labelNav.style.marginTop = "35px";
		}
	});

});

</script>

</body>
</html>