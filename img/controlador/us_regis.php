<?php

	require_once("../modelo/objetos.php");
	$newObject = new Objeto_foro();

	$nombre = $_POST["nombre"];
	$email = $_POST["email"];
	$pass = $_POST["pass"];
	$formulario = $_POST["form"];


	//Comprobar longitud de carácteres:

	$longitudNombre = strlen($nombre);

	if($longitudNombre > 10){
		header("location: ../vista/pag_login.php?errlong=true");
	}

	//Encriptar password:

	$pass_cifrado = password_hash($pass, PASSWORD_DEFAULT, array("cost"=>12));			

	//Llamada a objetos del dir modelo!

	$usuario = $newObject->set_usuario($email, $pass_cifrado, $nombre);

	//Si todo está correcto, se crea la sesión, envia correo y direcciona a ver temas.

	if($usuario == 1){
		//Envio de correo:

		$to = $email;
		$subject = "¡Gracias por darte de alta!";
		$txt = "Te damos la bienvenida a FORING, gracias por registrarte, " . $nombre ."";
		$headers = "From: foroforing@gmail.com" . "\r\n" . "CC: foroforing@gmail.com";

		$exito = mail($to, $subject, $txt, $headers);

		if ($exito){
			//Crear sesión y direccionar a temas.

			$nombre;
			
			session_start();
			$_SESSION["usuario"] = $nombre;
			header("location: ../vista/ver_temas.php");
		
		}else{
			echo "No se pudo enviar el mensaje.";
		}

	//Si el nombre introducido ya está utilizado...
	
	}else if($usuario=="nombreUtilizado"){
		
		if($formulario == "form1"){
			header("location: ../vista/pag_login.php?errusuario=".$nombre."");
		
		}else{
			header("location: ../vista/registro.php?errusuario=".$nombre."");
		}

	//Si el correo introducido ya está utilizado...

	}else if($usuario=="correoUtilizado"){

		if($formulario == "form1"){
			header("location: ../vista/pag_login.php?errcorreo=".$email."");
		
		}else{
			header("location: ../vista/registro.php?errcorreo=".$email."");
		}
	}
?>