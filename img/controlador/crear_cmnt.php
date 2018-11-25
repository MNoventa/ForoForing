<?php
	
	require_once("../modelo/objetos.php");

	session_start();
	$usuario = $_SESSION["usuario"];

	$newObject = new Objeto_foro();

	$fecha = date('Y-m-d');
	$comentario = $_POST["comentario"];
	$tema = trim($_POST["tema"]);


	//Comprobar longitud de caracteres:

	$longitudComent = strlen($comentario);

	if($longitudComent > 350){
		header("location: ../vista/ver_cmnts.php?errlong=true & tema=".$tema." &sesion=defined");
	
	}else if($comentario==null){
		header("location: ../vista/ver_cmnts.php?errcmnt=true & tema=".$tema." &sesion=defined");

	}else{
		$introdTema = $newObject->set_comentario($comentario, $usuario, $fecha, $tema); 

		header("Location: ../vista/ver_cmnts.php?tema=".$tema." &sesion=defined");
	}

?>