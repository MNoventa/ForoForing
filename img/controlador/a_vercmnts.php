
<?php

	echo "
		<div class='temaCmntFlex'>
			<article class='temaCreaFech' id='temaCreaFech'>
				<h2>".$tema."</h2>
				<h4><span class='destacar'>Creado por:</span> ".$resultadoTema[1]."</h4>
				<h4><span class='destacar'>Fecha:</span> ".$resultadoTema[2]."</h4>

	";

	if($resultadoTema[3]!=null){
		echo "<h4><span class='destacar'>Última modificación:</span> ".$resultadoTema[3]."</h4>";
	
	}else{
		echo "<h4><span class='destacar'>Última modificación:</span> Nunca</h4>";
	}
	
	echo "	</article>
			
			<article class='temaDesc' id='temaDesc'>
				<h3 class='h3cmnts'><span class='destacar'>Descripción:</span><br><span>".$resultadoTema[0]."</span></h3>
			</article>		
		</div> 
	
	";

	if(isset($_SESSION["usuario"])){
		if ($_SESSION["usuario"]!=$resultadoTema[1]){
			echo "<div id='editTema' class='oculto'></div>";

		}else{
			echo "<div class='icon-tools' id='editTema''></div>

			<span id='avisoEditTema'><span class='icon-info'></span>Configura tu tema creado para modificarlo o borrarlo</span>
			";
		}
	}
	
	//Error al editar comentario/tema:

		if(isset($_GET['errlongedit'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar comentario:</strong><br><br><span>El comentario no puede contener más de 350 caracteres</span></div>';
		
		}else if(isset($_GET['errcmntedit'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar comentario:</strong><br><br><span>Parece que te olvidaste de poner un comentario</span></div>';		
		
		}else if(isset($_GET['repe'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar titulo del tema:</strong><br><br><span>El tema propuesto ya ha sido utilizado</span></div>';		
		
		}else if(isset($_GET['errtit'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar titulo del tema:</strong><br><br><span>El tema propuesto no puede contener más de 20 dígitos</span></div>';		
		
		}else if(isset($_GET['errtitnull'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar titulo del tema:</strong><br><br><span>Parece que te olvidaste de poner un titulo para el tema</span></div>';		
		
		}else if(isset($_GET['errespacio'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar titulo del tema:</strong><br><br><span>El tema propuesto no puede contener espacios en blanco</span></div>';		
		
		}else if(isset($_GET['titdesc'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar la descripción del tema:</strong><br><br><span>La descripción del titulo no puede superar los 145 caracteres</span></div>';		
		
		}else if(isset($_GET['titdescnull'])){
			echo '<div class="advertCmnt"><span class="icon-warning"></span><strong>Error al editar la descripción del tema:</strong><br><br><span>Parece que te olvidaste de poner una descripción al tema</span></div>';		
		}

	echo "<hr> <h3 class='centrar h3cmnts'>Comentarios:</h3>";

	//Paginación:

	$tamanyo_paginas=5; //Cuantos registros queremos ver por página

		if(isset($_GET["pagina"])){

			if($_GET["pagina"]==1){
				header("Location: ver_cmnts.php?tema=".$tema." &sesion=".$sesion."");
		
			}else{
				$pagina=$_GET["pagina"];
			}
		
		}else{
			$pagina=1; //Página en la que estamos cargando en la web
		}

	$empezar_desde=($pagina-1)*$tamanyo_paginas;

	$cantidasDePaginas = $newObject->get_comentarios_paginacion($tamanyo_paginas, $tema);


	//Fin paginación

	$todos_cmnts = $newObject->get_comentarios($tema, $usuario, $empezar_desde, $tamanyo_paginas);

	$todos_cmnts_num = count($todos_cmnts);

	for($i = 0; $i < $todos_cmnts_num; $i++){
		echo $todos_cmnts[$i] . "<br>";
	}


	echo "<hr><div class='divNavegacion'>

		Paginación:<br>";

		
		for ($i=1; $i<=$cantidasDePaginas; $i++){

			if($i == $pagina){
				echo "<a href='?pagina=" . $i . "&tema=".$tema." &sesion=".$sesion."' class='pagActual'>" . $i . "</a>";

			}else{
				echo "<a href='?pagina=" . $i . "&tema=".$tema." &sesion=".$sesion."'>" . $i . "</a>";
			}
		}

		echo "<br><br>Se mostrará un máximo de " . $tamanyo_paginas . " comentarios por página " . "<br>";
		echo "Mostrando la página " . $pagina . " de " . $cantidasDePaginas . "</strong><br><br>";

	echo "</div>";			

		

		if($_GET["sesion"]!="undefined"){

			echo "
				<form action='../controlador/crear_cmnt.php' id='formcmnt' method='post'>
			
			";
					/*Mensajes de error en el caso de que:

						- Comentario tenga más de 350 caracteres..
					*/
						if(isset($_GET['errlong'])){
							echo '<span>*El comentario no puede contener más de 350 caracteres</span>';
						
						}else if(isset($_GET['errcmnt'])){
							echo '<span>*Parece que te olvidaste de poner un comentario</span>';		
						}
			
			echo "	
					<h3 class='h3formcmnt'>Añade un comentario:</h3>

					<div id='cmnt'><label for='comentario'></label><br><textarea name='comentario' id='comentario' cols='30' rows='10'></textarea></div>

					<input type='hidden' value='".$tema."' name='tema'>

					<input type='submit'>
				</form>
			"; 
		}

?>