<!DOCTYPE html>

	<?php
		
		session_start();


		if(!isset($_SESSION["usuario"])){		
			echo "<script language=Javascript> location.href=\"../index.php\"; </script>"; 
			die();
		}

		if(isset($_SESSION["usuario"])){						
			$usuario = $_SESSION["usuario"];
			$sesion = "defined";

		}


		if(isset($_GET["pagina"])){

			//header("Location: ver_temas.php");

			if($_GET["pagina"]==1){
				echo "<script language=Javascript> location.href=\"ver_temas.php\"; </script>"; 
				die();
			}
		}

	?>

<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FORING - Ver temas</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!--<script src="../js/script.js"></script>-->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="../style/estilos.css">
	<link rel="stylesheet" href="../fuentes/style1.css">
	<link rel="shortcut icon" href="../img/enigma.ico"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<meta name="keywords" content="foro, foring, ver temas, mario garcia lucas">
	<meta name="description" content="En ésta página web, se muestras los temas creados por la comunidad. No esperes más y crea un nuevo tema de conversación.">
</head>

<body>
	
	<header id="headerNav">
		<nav>
			<div class="contGnral">
				<img src="../img/logo_ext2.png" alt="" id="logo">

				<input type="checkbox" id="checkboxMenu">
				<label id="headerMenuLabel" for="checkboxMenu" class="icon-th-menu-outline labelCnt2"></label>

				<ul id="ulcnt">
					<li><a href="#sectionT">Ver temas</a></li>
					<li><a href="../controlador/borrar_sesion.php">Cerrar sesión</a></li>
				</ul>
			</div>
		</nav>
	</header>
	
	<section id="banner" class="temas">
		
		<section class="sectTemas temas">
			<div class="contGnral">

				<?php					
				
					echo "<h3>¡Hola ".$usuario."!</h3>";

				?>

				<p>Crea tu propio tema de conversación para que las demás personas puedan comentar en él, o dirígete más abajo en la página web para descubrir qué temas de conversación ha creado ya la comunidad.<br><br>
				<span id="consejo"><i>Ten en cuenta que los temas que tu creas, sólo podrán ser eliminados por ti mismo o por un administrador si no cumplen las normas de la comunidad</i></span></p>
				
				<div id="h2Tema">
					<h2>Crear un nuevo tema:</h2>
				</div>

				<form action="../controlador/crear_tema.php" id="crearTema" method="post" class="formtemas">
				
				<?php
					/*Mensajes de error en el caso de que:

						- Titulo tenga más de 20 caracteres.
						- Descripción tenga más de 145 caracteres.
						- No se haya especificado titulo del tema.
						- No se haya puesto descripción del tema.						
					*/
						if(isset($_GET["errdesc"])){
							if($_GET["errdesc"]=="true"){
								echo "<span>*La descripción no puede tener más de 145 caracteres.</span>";
							}
						
						}else if(isset($_GET["errtit"])){
							if($_GET["errtit"]=="true"){
								echo "<span>*El titulo no puede tener más de 20 caracteres.</span>";
							}
						
						}else if(isset($_GET["errtitnull"])){
							if($_GET["errtitnull"]=="true"){
								echo "<span>*Debes poner un titulo para el tema.</span>";
							}
						
						}else if(isset($_GET["errdescnull"])){
							if($_GET["errdescnull"]=="true"){
								echo "<span>*Debes poner una descripción para el tema.</span>";
							}
						
						}else if(isset($_GET["repe"])){
							if($_GET["repe"]=="true"){
								echo "<span>*El tema que escribiste, ya existe.</span>";
							}
						
						}else if(isset($_GET["errespacio"])){
							if($_GET["errespacio"]=="true"){
								echo "<span>*El tema no puede contener espacios en blanco</span>";
							}
						}
				?>
										
					<div><label for="titulo">Titulo:</label><br><input type="text" id="titulo" name="titulo"></div>

					<div id="desc"><label for="descripcion">Descripción:</label><br><textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea></div>

					<input type="submit">
				</form>
			</div>
		</section>


	</section>

			<section id="sectionT" class="sectTemas pprincipal">
			<div class="contGnral">
				<div id="temaYDesc">
					<h3>Temas</h3>

					<p>Descúbre los temas de conversación creados por la comunidad, y echa un vistado sobre de lo que se está hablando.</p>
				</div>
		
<!-- Incluir código php paginación y mostrar temas-->		

		<?php require("../controlador/a_vertemas.php");?>

			</div>
	</section>

<!-- Div de advertencia al querer borrar un tema -->

	<div class="lightbox" id="light"></div>

	<div class="lightboxAlerta" id="fade"><p>¿Estás seguro de que quieres borrar éste tema?</p>
		<div><input type="button" value="Confirmar" id="btnConfirmar"></div>
		<div><input type="button" value="Rechazar" id="btnRechazar"></div>
	</div>

<!-- Incluir footer-->

<?php require("footer.php");?>

<script>
	
	$(document).ready(function(){

		var tamañoP = $(window).height();

		if ($(window).width()<400){
			tamañoP = tamañoP+130;
		}else{
			tamañoP = $(window).height();
		}

	$("#banner").css({"height":tamañoP + "px"});

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
			logo.src = "../img/logo.png";
			labelNav.style.marginTop = "14px";
		}else{
			ul.style.marginTop = "20px";
			logo.style.marginTop = "7px";
			logo.style.width = "150px";
			header.style.opacity = "0.6";
			header.style.height = "100px";
			logo.src = "../img/logo_ext2.png";
			labelNav.style.marginTop = "35px";
		}
	});

	//Mostrar advertencia al borrar tema

	botonBorrar = document.getElementsByClassName("borrarTema");
	botonConfBorrar = document.getElementById("btnConfirmar");
	botonRechBorrar = document.getElementById("btnRechazar");
	contBtnBorrar = document.getElementById("contTemas");

	for(var i=0; i<botonBorrar.length; i++){
		botonBorrar[i].addEventListener("click", alertaBorrar);
		botonBorrar[i].addEventListener("mouseover", hoverBorrar);
		botonBorrar[i].addEventListener("mouseout", hoverDownBorrar);
	}

	function alertaBorrar(e){
		var idBoton = e.target.id;

		document.getElementById('light').style.display='block';
		document.getElementById('fade').style.display='block';

		botonRechBorrar.addEventListener("click", function(){
			document.getElementById('light').style.display='none';
			document.getElementById('fade').style.display='none';
		})

		botonConfBorrar.addEventListener("click", function(){
			console.log(idBoton);
			window.location="../controlador/borrar_tema.php?tema=" + idBoton;
		})
	}

	function hoverBorrar(e){
		var obj = e.target.parentNode;
		var obj2 = obj.previousSibling;
		var obj3 = obj2.previousSibling;
		var obj4 = obj3.childNodes[1];
		var obj5 = obj4.childNodes;
		var elem1 = obj4.childNodes[1];
		var elem2 = obj4.childNodes[3];
		var elem3 = obj4.childNodes[5];
		elem1.style.background = "#ECCBCB";
		elem2.style.background = "#ECCBCB";
		elem3.style.background = "#ECCBCB";
	}

	function hoverDownBorrar(e){
		var obj = e.target.parentNode;
		var obj2 = obj.previousSibling;
		var obj3 = obj2.previousSibling;
		var obj4 = obj3.childNodes[1];
		var obj5 = obj4.childNodes;
		var elem1 = obj4.childNodes[1];
		var elem2 = obj4.childNodes[3];
		var elem3 = obj4.childNodes[5];
		elem1.style.background = "#fff";
		elem2.style.background = "#fff";
		elem3.style.background = "#fff";
	}

});

</script>

</body>
</html>