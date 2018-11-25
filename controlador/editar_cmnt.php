<?php
	
	require_once("../modelo/objetos.php");
	$newObject = new Objeto_foro();

	$comentario = $_POST["inputEditCMnt"];
	$idCmnt = $_POST["idCmnt"];
	$temaCmnt = $_POST["temaCmnt"];
	$fecha = date('Y-m-d'); 

	$longitudComent = strlen($comentario);

	//Comprobar longitud de caracteres:

	if($longitudComent > 350){
		header("location: ../vista/ver_cmnts.php?errlongedit=true & tema=".$temaCmnt." &sesion=defined");
	
	//Comprobar si no se ha borrado todo el comentario:

	}else if($comentario==null){
		header("location: ../vista/ver_cmnts.php?errcmntedit=true & tema=".$temaCmnt." &sesion=defined");

	}else{
		$introdTema = $newObject->editarComentario($comentario, $idCmnt, $fecha); 

		if($introdTema!=false){
			header("Location: ../vista/ver_cmnts.php?tema=".$temaCmnt." &sesion=defined");
		}else{
			echo "Error, el comentario no se ha editado";
		}	
	}

?>