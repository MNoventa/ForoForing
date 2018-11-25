<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>FORING - Ver comentarios</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
	<!--<script src="../js/script.js"></script>-->
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="../style/estilos5.css">
	<link rel="stylesheet" href="../fuentes/style1.css">
	<link rel="shortcut icon" href="../img/enigma.ico"/>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
	<meta name="keywords" content="foro, foring, ver comentarios, crear, borrar, mario garcia lucas">
	<meta name="description" content="Visualiza los comentarios de los distintos temas de FORING. ¡Crea nuevo comentarios y bórralos a tu antojo!">

</head>

<body class="bodyCmnts">

	<?php
		require_once("../modelo/objetos.php");
		$newObject = new Objeto_foro();
		

		$sesion = trim($_GET["sesion"]);
		$tema = trim($_GET["tema"]);

		if($sesion!='undefined'){
			session_start();
			$usuario = $_SESSION["usuario"];
		
		}else{
			$usuario = 'undefined';
		}

		$resultadoTema = $newObject->get_tema_only($tema);

	?>
	
	<header id="headerNav">
		<nav>
			<div class="contGnral">
				<img src="../img/logo_ext2.png" alt="" id="logo">

				<input type="checkbox" id="checkboxMenu">
				<label id="headerMenuLabel" for="checkboxMenu" class="icon-th-menu-outline labelCnt2"></label>

				<ul id="ulcnt2">
					<li><a href="../vista/ver_temas.php">Volver a temas</a></li>

					<?php
						if($_GET["sesion"]!="undefined"){
							echo "<li><a href='../controlador/borrar_sesion.php'>Cerrar sesión</a></li>";								
						}else{
							echo "<li><a href='registro.php'>Registrarse</a></li>";
						}
					?>

				</ul>
			</div>
		</nav>
	</header>

	<section id="banner" class="cmnts">
		<div class="contGnral secComentarios">
			<section class="secComentariosClass">		

<!-- Incluir código php paginación y mostrar temas-->	

			<?php require_once("../controlador/a_vercmnts.php");?>

			</section>
		</div>
	</section>


<!-- Div de advertencia al querer borrar/editar un comentario -->

	<div class="lightbox" id="light"></div>
	
	<!--Advertencia para borrar comentario-->

	<div class="lightboxAlerta" id="fade">
		<span class="icon-warning editYborrar"></span><p>¿Quieres borrar de veras el comentario?</p>
		<div><input type="button" value="Confirmar" id="btnConfirmar"></div>
		<div><input type="button" value="Rechazar" id="btnRechazar"></div>
	</div>

	<!--Advertencia para borrar comentario-->

	<div class="lightboxAlerta" id="fadeTemaB">
		<span class="icon-warning editYborrar"></span><p>¿Quieres borrar de veras el tema?</p>
		<div><input type="button" value="Confirmar" id="btnConfirmarB"></div>
		<div><input type="button" value="Rechazar" id="btnRechazarB"></div>
	</div>

	<!--Advertencia para editar comentario-->

	<div class="lightboxAlerta" id="fadeCmnt">
		<p><span class="icon-pen editYborrar"></span>Edita tu comentario</p>
		
		<form action="../controlador/editar_cmnt.php" method="post" name="formEditCmnt">
			<textarea name="inputEditCMnt" id="inputEditCMnt" cols="30" rows="10"></textarea>
			<input type="hidden" id="idCmnt" name="idCmnt"> <!--Aqui se guardará el idComentario-->
			<input type="hidden" id="temaCmnt" name="temaCmnt"> <!--Aqui se guardará el idComentario-->
			<div><input type="submit" value="Confirmar" id="btnConfirmar2"></div>
			<div><input type="button" value="Rechazar" id="btnRechazar2"></div>
		</form>		
	</div>

<!-- Div de advertencia al querer borrar/editar un tema -->
	
	<div class="lightboxAlerta" id="fadeTema">
		<p><span class="icon-pen editYborrar"></span>Edita tu tema o elimínalo si lo deseas<br><br></p>
		
		<form action="../controlador/editar_tema.php" method="post" name="formEditDesc" id="formEditTema">
			<span id="editTitDesd">Edita el titulo del tema:</span><br>
			<input type="text" id="tituloEdit" name="tituloEdit">
			<input type="hidden" id="tituloOriginal" name="tituloOriginal">
			
			<div class="icon_ticks" id="icon_ticks">
				<span class="icon-arrow-repeat-outline"></span>
			</div><br>

			<span id="editTitDesd">Edita la descripción del tema:</span>
			<textarea name="inputEditTema" id="inputEditTema" cols="30" rows="10"></textarea>

			<div><input type="submit" value="Confirmar" id="btnConfirmar3"></div>
			<div><input type="button" value="Rechazar" id="btnRechazar3"></div>
		</form>
		<hr>
		<span id="editTitDesd" class="elimTema">Elimina el tema por completo:</span> <br>
		<section id='borraTodoTema' class='borraTodoTema icon-trash'></section>

	</div>


<!-- Incluir footer dinámicamente -->

<?php require("footer.php");?>

<script>
	
	$(document).ready(function(){

		var flag = false;
		var scroll;
		logo = document.getElementById("logo");	
		header = document.getElementById("headerNav");
		ul = document.getElementById("ulcnt2");
		labelNav = document.getElementById("headerMenuLabel");

		$(window).scroll(function(){
				
			scroll = $(window).scrollTop();

			if(scroll>80){
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

		//Mostrar advertencia al borrar/editar comentario/tema

		botonBorrar = document.getElementsByClassName("borrarTema");
		botonConfBorrar = document.getElementById("btnConfirmar");
		botonRechBorrar = document.getElementById("btnRechazar");
		btnRechazar2 = document.getElementById("btnRechazar2");
		modificaCmnt = document.getElementsByClassName("modificaCmnt");
		inputEditCMnt = document.getElementById("inputEditCMnt");
		ImputIdCmnt = document.getElementById("idCmnt");
		temaCmnt = document.getElementById("temaCmnt");
		editTema = document.getElementById("editTema");
		icon_ticks = document.getElementById("icon_ticks");
		tituloOriginal = document.getElementById('tituloOriginal');
		borraTodoTema = document.getElementById('borraTodoTema');
		var temaCreaFech = document.getElementById("temaCreaFech");
		var titulo = temaCreaFech.childNodes[1].innerHTML;
		
		borraTodoTema.addEventListener("click", function(){	
			document.getElementById("fadeTema").style.display='none';
			document.getElementById("fadeTemaB").style.display='block';

			document.getElementById("btnRechazarB").addEventListener("click", function(){
				document.getElementById('light').style.display='none';
				document.getElementById('fadeTemaB').style.display='none';
			})

			document.getElementById("btnConfirmarB").addEventListener("click", function(){
				window.location="../controlador/borrar_tema.php?tema="+titulo+"";
			})
		});

		editTema.addEventListener("click", function(){
			var temaDesc = document.getElementById("temaDesc");
			var desc = temaDesc.childNodes[1].childNodes[2].innerHTML;

			tituloOrig = document.getElementById('tituloEdit').setAttribute("value", titulo);
			document.getElementById('tituloOriginal').setAttribute("value", titulo);
			document.getElementById('inputEditTema').value = desc;

			document.getElementById('light').style.display='block';
			document.getElementById('fadeTema').style.display='block';

			btnRechazar3.addEventListener("click", function(){
				document.getElementById('light').style.display='none';
				document.getElementById('fadeTema').style.display='none';
			})
		})

		icon_ticks.addEventListener("click", function(){

			var valorInputTit = document.getElementById('tituloEdit').value;
			window.location="../controlador/editar_tema.php?titulo=" + valorInputTit +"&titoriginal=" + tituloOriginal.value+"";

		});

		for(var i=0; i<botonBorrar.length; i++){
			botonBorrar[i].addEventListener("click", alertaBorrar);
		}

		for(var i=0; i<modificaCmnt.length; i++){
			modificaCmnt[i].addEventListener("click", editaCmnt);
		}

		function editaCmnt(e){
			var elemento = e.target;
			var elementoid = e.target.id;
			var elementoPadre = elemento.parentNode;
			var elementoHijo = elementoPadre.previousSibling;
			var elementoHijoAntes = elemento.nextSibling;
			var elmntHijoAntes2id = elementoHijoAntes.nextSibling.id;
			var divCmts = elementoHijo.previousSibling.innerHTML;

			
			inputEditCMnt.value = divCmts;
			ImputIdCmnt.setAttribute("value", elementoid);
			temaCmnt.setAttribute("value", elmntHijoAntes2id);

			document.getElementById('light').style.display='block';
			document.getElementById('fadeCmnt').style.display='block';

			btnRechazar2.addEventListener("click", function(){
				document.getElementById('light').style.display='none';
				document.getElementById('fadeCmnt').style.display='none';
			})
		}

		function alertaBorrar(e){

			var idPrevious = e.target.parentNode.id;
			var idBoton = e.target.id;

			document.getElementById('light').style.display='block';
			document.getElementById('fade').style.display='block';

			botonRechBorrar.addEventListener("click", function(){
				document.getElementById('light').style.display='none';
				document.getElementById('fade').style.display='none';

			})

			botonConfBorrar.addEventListener("click", function(){
				window.location="../controlador/borrar_cmnt.php?comentario=" + idBoton +"&idPrevious=" + idPrevious;
			})

		}

	});

</script>


</body>
</html>
