<?php
	
	require_once("../modelo/objetos.php");

	$email = $_POST["email"];
	$contra = $_POST["pass"];

	$newObject = new Objeto_foro;

	//Validar usuario
	$encontrado = $newObject->get_usuario($email, $contra);

	if($encontrado != false){
		session_start();
		$_SESSION["usuario"] = $encontrado;

		header("location: ../vista/ver_temas.php");
		
	}else{
		header("location: ../vista/inscribir.php?errusuario=error");
	}


?>