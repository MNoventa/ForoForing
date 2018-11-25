<?php
	
	require_once("../modelo/objetos.php");
	$newObject = new Objeto_foro();

	//Fecha para capturar la última modificación

	$fecha = date('Y-m-d');

// ***************    Sección moficación titulo tema

	if(isset($_GET["titulo"])){

		$titulo = trim($_GET["titulo"]);
		$titorig = trim($_GET["titoriginal"]);

		$longtitulo = strlen($titulo);
	
		if ($longtitulo>20){
			header("location: ../vista/ver_cmnts.php?tema=".$titorig."&errtit=true&sesion=defined");
		
		}else if ($titulo==null){
			header("location: ../vista/ver_cmnts.php?tema=".$titorig."&errtitnull=true&sesion=defined");

		}else if (strpos($titulo, " ")){
			header("location: ../vista/ver_cmnts.php?tema=".$titorig."&errespacio=true&sesion=defined");		
		}else{
			$newObject->editarTemaTit($titulo, $titorig, $fecha);
		}

	}else{

// ***************    Sección moficación descripción tema

		$descripcion = $_POST["inputEditTema"];
		$titorigPost = $_POST["tituloOriginal"];

		$longitudDesc = strlen($descripcion);

		if ($longitudDesc>145){
			header("location: ../vista/ver_cmnts.php?tema=".$titorigPost."&titdesc=true&sesion=defined");
		
		}else if ($descripcion==null){
			header("location: ../vista/ver_cmnts.php?tema=".$titorigPost."&titdescnull=true&sesion=defined");

		}else{

			$newObject->editarTemaDesc($descripcion, $titorigPost, $fecha);

			header("location: ../vista/ver_cmnts.php?tema=".$titorigPost."&sesion=defined");
		}
	}

?>