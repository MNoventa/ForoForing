<?php

	require_once("../modelo/objetos.php");

	$foro = new Objeto_foro();

	//Paginación:

	$tamanyo_paginas=5; //Cuantos registros queremos ver por página

		if(isset($_GET["pagina"])){

			if($_GET["pagina"]==1){
				header("Location: ver_temas.php");
		
			}else{
				$pagina=$_GET["pagina"];
			}
		
		}else{
			$pagina=1; //Página en la que estamos cargando en la web
		}

	$empezar_desde=($pagina-1)*$tamanyo_paginas;

	$cantidasDePaginas = $foro->get_temas_paginacion($tamanyo_paginas);

	
	//Fin paginación

	$todos_temas = $foro->get_temas($usuario, $sesion, $empezar_desde, $tamanyo_paginas);

	$todos_temas_num = count($todos_temas);

	for($i = 0; $i < $todos_temas_num; $i++){
		echo $todos_temas[$i] . "<br>";
	}

	echo "<hr><div class='divNavegacion'>

		Paginación:<br>";

		for ($i=1; $i<=$cantidasDePaginas; $i++){

			if($i == $pagina){
				echo "<a href='?pagina=" . $i . "' class='pagActual'>" . $i . "</a>";

			}else{
				echo "<a href='?pagina=" . $i . "'>" . $i . "</a>";
			}
		}

		echo "<br><br>Se mostrará un máximo de " . $tamanyo_paginas . " temas por página " . "<br>";
		echo "Mostrando la página " . $pagina . " de " . $cantidasDePaginas . "</strong><br><br>";

	echo "</div>";	
?>