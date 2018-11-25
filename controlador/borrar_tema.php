<?php

	require_once("../modelo/objetos.php");
	
	$tema_a_borrar =  trim($_GET["tema"]);
	
	$newObject = new Objeto_foro();
	$resultado = $newObject->borrarTema($tema_a_borrar);

	if ($resultado==false){
		echo "<br>no ha ocurrido nada";
	}else{
		header("location: ../vista/ver_temas.php");
	}
	

?>

