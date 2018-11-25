<?php
	
	require_once("../modelo/objetos.php");

	session_start();
	$usuario = $_SESSION["usuario"];

	$newObject = new Objeto_foro();

	$fecha = date('Y-m-d');
	$titulo = $_POST["titulo"];
	$descripcion = $_POST["descripcion"];

	$longdescripcion = strlen($descripcion);
	$longtitulo = strlen($titulo);


	if ($longdescripcion>145){
		header("location: ../vista/ver_temas.php?errdesc=true");
	
	}else if ($longtitulo>20){
		header("location: ../vista/ver_temas.php?errtit=true");
	
	}else if ($titulo==null){
		header("location: ../vista/ver_temas.php?errtitnull=true");

	}else if ($descripcion==null){
		header("location: ../vista/ver_temas.php?errdescnull=true");

	//Detectar espacios vacíos en la cadena
	}else if (strpos($titulo, " ")){
		header("location: ../vista/ver_temas.php?errespacio=true");

	}else{

		$introdTema = $newObject->set_temas($titulo, $usuario, $fecha, $descripcion);

		header("Location: ../vista/ver_temas.php?errdesc=false & errtit=false & errtitnull=false & errdescnull=false & repe=false & errespacio=false");
	}


?>