<?php

	
	class Objeto_foro{

		//Conexión devuelta del Conexion.php
		private $db;

		//private $nombreUsuario;

		public function __construct(){

			require_once("conexion.php");

			//Asociación de la conexión a la private $db
			$this->db=Conectar::conexion();
		}


		public function get_comentarios_paginacion($tamanyo_paginas, $tema){ 

			$sql="SELECT * FROM comentarios WHERE TEMA = :tema";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array("tema"=>$tema));

			$cantidad_registros=$resultado->rowCount(); //Cuantos registros tenemos en total

			$total_paginas= ceil($cantidad_registros/$tamanyo_paginas);

			/*En este caso:

					12/3 =  4 (y lo redondea por si a caso el resultado fuera impar)

					4 cantidad de páginas que se mostrarán

			*/
			$resultado->closeCursor();

			return $total_paginas;

		}

		public function get_comentarios($tema, $usuario, $empezar_desde, $tamanyo_paginas){

			$contador = 0;

			$todo=array();

			$sql = "SELECT Comentario, Fecha, idUsuario, Tema, IdComentario, Modificado FROM comentarios WHERE Tema = :tema ORDER BY Fecha DESC LIMIT $empezar_desde,$tamanyo_paginas";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":tema"=>$tema));

			if($resultado->rowCount()>0){

				while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

					$idUsuario=$registro['idUsuario'];

					$sql2 = "SELECT Nombre FROM usuarios WHERE IdUsuario = $idUsuario";

					$resultado2 = $this->db->query($sql2);

					while($registro2 = $resultado2->fetch(PDO::FETCH_ASSOC)){

						//Si el comentario fué modificado:
						if($registro['Modificado']!=null){
							$modif = "<div class='cmntModif'>Comentario editado el: ".$registro['Modificado']."</div>";
						}else{
							$modif = "";
						}
						
						if($registro2['Nombre']==$usuario || $usuario=="admin"){
								
							$todo[$contador] = 
				
								"<div class='contComentarios'>
										<div class='creadorFecha'>
											<div> Creado por: <strong>". $registro2['Nombre'] ."</strong></div>
											<div>". $registro['Fecha'] ."</div>
										</div>
										
										<div class='comentario'>". $registro['Comentario'] ."</div>
									
									<div id='btnesEditBorr'>
										<div class='icon-edit modificaCmnt' id=".$registro['IdComentario']."></div>

										<div id=".$registro['Tema']." class='borrarTema borraCmnt'>
											<div id=". $registro['IdComentario'] ." class='borraCmnt icon-trash' value='Borrar comentario'></div>
										</div>
									</div>
								".$modif."
								</div>";

								$contador ++;
						}else{

							$todo[$contador] = 
	
								"<div class='contComentarios'>
										<div class='creadorFecha'>
											<div> Creado por: <strong>". $registro2['Nombre'] ."</strong></div>
											<div>". $registro['Fecha'] ."</div>
										</div>
										
										<div class='comentario'>". $registro['Comentario'] ."</div>
								</div>";

							$contador ++;
						}
					}
				}
			}

			$resultado->closeCursor();
			return $todo;
		}

		public function set_comentario($comentario, $usuario, $fecha, $tema){
			
			$idUsuario;

			$sql = "SELECT idUsuario FROM usuarios WHERE NOMBRE = :nombre";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":nombre"=>$usuario));

			if($resultado->rowCount() > 0){
				while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

					$idUsuario=$registro["idUsuario"];
					$resultado->closeCursor();
				}
			
			}else{
				$resultado->closeCursor();
				return false;
			}

			$sql = "INSERT INTO comentarios (Comentario, Fecha, IdUsuario, Tema) VALUES (:comentario, :fecha, :idusuario, :tema)";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":comentario"=>$comentario, ":fecha"=>$fecha, ":idusuario"=>$idUsuario, ":tema"=>$tema));

			if($resultado->rowCount() > 0){

				$resultado->closeCursor();
				return true;

			}else{
				$resultado->closeCursor();
				return false;
			}				


		}

		public function borrarComentario($idComentario){

			$sql= "DELETE FROM comentarios WHERE IdComentario= :idComentario";

			$resultado=$this->db->prepare($sql);

			$resultado->execute(array(":idComentario"=>$idComentario));

			if($resultado->rowCount() > 0){
				
				$resultado->closeCursor();
				return true;
			
			}else{

				$resultado->closeCursor();
				return false;
			}				
		}

		public function editarComentario($comentario, $idCmnt, $fecha){
			
			$sql = "UPDATE comentarios SET COMENTARIO = :cmnt, MODIFICADO = :fecha WHERE IdComentario = :idcmnt";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":cmnt"=>$comentario, ":idcmnt"=>$idCmnt, ":fecha"=>$fecha));

			if($resultado->rowCount() > 0){
				
				$resultado->closeCursor();
				return true;
			
			}else{

				$resultado->closeCursor();
				return false;
			}
		}

		public function get_temas_paginacion($tamanyo_paginas){  
			
			try{

				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$sql="SELECT * FROM temas";

				$resultado = $this->db->prepare($sql);

				$resultado->execute(array());

				$cantidad_registros=$resultado->rowCount(); //Cuantos registros tenemos en total

				$total_paginas= ceil($cantidad_registros/$tamanyo_paginas);

				/*En este caso:

						12/3 =  4 (y lo redondea por si a caso el resultado fuera impar)

						4 cantidad de páginas que se mostrarán
				*/
				
				$resultado->closeCursor();

				return $total_paginas;

			}catch(Exception $e){ 

				die('Error: ' . $e->GetMessage());

			}
		}

		public function get_temas($usuario, $sesion, $empezar_desde, $tamanyo_paginas){
			try{

				$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$contadorafter = 0;

				$todoafter=array();

				$contador = 0;

				$todo=array();

				//Conocer num comentarios de los temas
				
				$aftersql = "CALL `MUESTRA_NUM_COMNTS`()";

				$resaftersql = $this->db->prepare($aftersql);

				$resaftersql->execute(array());

				while($registro = $resaftersql->fetch(PDO::FETCH_ASSOC)){

					$todoafter[$contadorafter] = $registro["Tema"];
					$contadorafter++;
					
					$todoafter[$contadorafter] = $registro["NumeroDeComentarios"];
					$contadorafter++;
				}	

				$resaftersql->closeCursor();

				//Mostrar tabla temas

				//$sql = "SELECT Titulo, Creador, Fecha, Descripción FROM temas ORDER BY Fecha DESC";

				$sql = "SELECT Titulo, Creador, Fecha, Descripción FROM temas ORDER BY Fecha DESC LIMIT $empezar_desde,$tamanyo_paginas";

				$resultado = $this->db->prepare($sql);

				$resultado->execute(array());

				if($resultado->rowCount()>0){

					while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

						$numComnts=0;

						$todos_temas_num = count($todoafter);

						for($i = 0; $i < $todos_temas_num; $i++){
							if($todoafter[$i] == $registro['Titulo']){
								$i++;
								$numComnts = $todoafter[$i];
							}
						}

						if($usuario!='undefined' & $registro["Creador"]==$usuario || $usuario=="admin"){
							
							$todo[$contador] = 
								
								"<a href='../vista/ver_cmnts.php?tema= ".$registro['Titulo']. "&sesion=".$sesion."' class='contEnlaceACmnts'>
							
									<div id='contTemas'>
										<div class='elemContTemas tituloDesc'>

										<span><strong>". $registro['Titulo'] ."</strong><br>
										". $registro['Descripción'] ."</span>	

										</div>
										<div class='elemContTemas numComnts'>
											<span>Núm. comentarios: <br><strong>
											". $numComnts ."</strong></span>
										</div>
										<div class='elemContTemas creadorFech'>
											<span>Creado por: <strong>". $registro['Creador'] ."</strong><br><br>
											". $registro['Fecha'] ."</span>
										</div>
									</div>
								</a>
							";

							$contador ++;
						
						}else{

							
							$todo[$contador] = 
								
								"<a href='../vista/ver_cmnts.php?tema= ".$registro['Titulo']. "&sesion=".$sesion."' class='contEnlaceACmnts'>
							
									<div id='contTemas'>
										<div class='elemContTemas tituloDesc'>

										<span><strong>". $registro['Titulo'] ."</strong><br>
										". $registro['Descripción'] ."</span>	

										</div>
										<div class='elemContTemas numComnts'>
											<span>Núm. comentarios: <br><strong>
											". $numComnts ."</strong></span>
										</div>
										<div class='elemContTemas creadorFech'>
											<span>Creado por: <strong>". $registro['Creador'] ."</strong><br><br>
											". $registro['Fecha'] ."</span>
										</div>
									</div>
								</a>";

							$contador ++;
						}

						$numComnts = 0;
					}

					$resultado->closeCursor();
					return $todo;

				}

			}catch(Exception $e){ 

				die('Error: ' . $e->GetMessage());

			}	

		}

		public function get_tema_only($tema){

			$matriz = array();

			$sql = "SELECT Descripción, Creador, Fecha, Modificado FROM temas WHERE Titulo= :tema";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":tema"=>$tema));

			if($resultado->rowCount() > 0){
				
				while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){

					$resultado->closeCursor();

					$matriz[0] = $registro["Descripción"];
					$matriz[1] = $registro["Creador"];
					$matriz[2] = $registro["Fecha"];
					$matriz[3] = $registro["Modificado"];
					return $matriz;
				}
			}

		}

		public function set_temas($titulo, $usuario, $fecha, $descripcion){

			//Comprobar si el tema ya está repetido

			$sql = "SELECT * FROM temas WHERE Titulo = :titulo";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":titulo"=>$titulo));

			if($resultado->rowCount()>0){
				$resultado->closeCursor();
				header("location: ../vista/ver_temas.php?repe=true");
			}

			//Si no lo está, se añade

			$sql = "INSERT INTO temas (Titulo, Creador, Fecha, Descripción) VALUES (:titulo, :creador, :fecha, :descripcion)";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":titulo"=>$titulo, ":creador"=>$usuario, ":fecha"=>$fecha, ":descripcion"=>$descripcion));

			if($resultado->rowCount()>0){
				$resultado->closeCursor();
				return true;
			}

			$resultado->closeCursor();
			return false;

		}

		public function editarTemaTit($titulo, $titorig, $fecha){

			//Comprobar si el tema ya está repetido

			$sql = "SELECT * FROM temas WHERE Titulo = :titulo";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":titulo"=>$titulo));

			

			if($resultado->rowCount()>0){
				$resultado->closeCursor();
				header("location: ../vista/ver_cmnts.php?tema=".$titulo."&repe=true&sesion=defined");
			
			}else if($resultado->rowCount()==0){
				$sql2 = "UPDATE temas SET TITULO = :titulo, MODIFICADO = :modif WHERE TITULO = :titorig";

				$resultado = $this->db->prepare($sql2);

				$resultado->execute(array(":titulo"=>$titulo, ":titorig"=>$titorig, ":modif"=>$fecha));

				$resultado->closeCursor();

				header("location: ../vista/ver_cmnts.php?tema=".$titulo."&sesion=defined");
			}			
		}

		public function editarTemaDesc($descripcion, $titorigPost, $fecha){

			$sql = "UPDATE temas SET DESCRIPCIÓN = :descr, MODIFICADO = :modif WHERE TITULO = :titulo";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":descr"=>$descripcion, ":titulo"=>$titorigPost, ":modif"=>$fecha));

			$resultado->closeCursor();
		}

		public function borrarTema($temario){

			$sql= "DELETE FROM temas WHERE Titulo= :temario";

			$resultado=$this->db->prepare($sql);

			$resultado->execute(array(":temario"=>$temario));

			if($resultado->rowCount() > 0){
				
				$resultado->closeCursor();
				return true;
			
			}else{

				$resultado->closeCursor();
				return false;
			}				
		}

		public function get_usuario($correo, $contra){

			$usuario = array();

			$sql = "SELECT * FROM usuarios WHERE Correo = :correo";
			
			$resultado = $this->db->prepare($sql);
			
			$resultado->execute(array(":correo"=>$correo));

			if($resultado->rowCount() > 0){
				while ($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
					//Array asociativo
					$usuario[0]=$registro["Nombre"];
					$usuario[1]=$registro["Contraseña"];

					if(password_verify($contra, $usuario[1])){
						$resultado->closeCursor();
						return $usuario[0];
					}
				}
			}

			$resultado->closeCursor();
			return false;
		}

		public function set_usuario($email, $pass, $nombre){
			
			$error;

			$sql = "SELECT Nombre FROM usuarios WHERE Nombre = :nombre";

			$resultado = $this->db->prepare($sql);

			$resultado->execute(array(":nombre"=>$nombre));

			if($resultado->rowCount()>0){
				$error = "nombreUtilizado";
				$resultado->closeCursor();
				return $error;
			
			}else{

				$sql = "SELECT Nombre FROM usuarios WHERE Correo = :email";

				$resultado = $this->db->prepare($sql);

				$resultado->execute(array(":email"=>$email));

			}if($resultado->rowCount()>0){
				$error = "correoUtilizado";
				$resultado->closeCursor();
				return $error;
			
			}else{

				$sql = "INSERT INTO usuarios (Nombre, Correo, Contraseña) VALUES (:nombre, :correo, :contra)";

				$resultado = $this->db->prepare($sql);

				$resultado->execute(array(":nombre"=>$nombre, ":correo"=>$email, ":contra"=>$pass));

				$resultado->closeCursor();
				return true;
			}

		}
	}

?>