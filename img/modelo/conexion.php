<?php
	
	class Conectar{
		public static function conexion(){
			try{
				
				$conexion= new PDO("mysql:host=localhost; dbname=id4682021_foro", "id4682021_mario", "171095mgl1");

				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$conexion->exec("SET CHARACTER SET UTF8");

			}catch(Exception $e){
				die ("Error " . $e->getMessage());
				echo "Línea del error " . $e->getLine();
			}

			return $conexion;
		}
	}


?>