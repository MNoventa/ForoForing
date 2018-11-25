<?php

	session_start();

	session_destroy();

	header("location: ../vista/pag_login.php");


?>