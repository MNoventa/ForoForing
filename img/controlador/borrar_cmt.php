<?php

	require_once("../modelo/objetos.php");
	
	$coment_a_borrar = trim($_GET["comentario"]);
	$idPrevious = trim($_GET["idPrevious"]);

	$newObject = new Objeto_foro();
	$resultado = $newObject->borrarComentario($coment_a_borrar);

	if ($resultado==false){
		echo "<br>no ha ocurrido nada";
	
	}else{
		//Volver a la pagina del tema en cuestión
		header("location: ../vista/ver_cmnts.php?tema=". $idPrevious ."&sesion=defined");
	}

?>

