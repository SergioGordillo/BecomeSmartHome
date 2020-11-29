<?php

session_start();
require_once 'config/parameters.php';
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';
require_once 'helpers/load-data.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){ //CON ESTA FUNCIÓN LLAMO AL CONTROLADOR DE ERROR CUANDO SEA NECESARIO
	$error = new errorController();
	$error->index();
}

if(isset($_GET['controller'])){ //COMPRUEBO QUE ME LLEGA EL CONTROLADOR POR LA URL
	$nombre_controlador = $_GET['controller'].'Controller';

}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){ //SI NO LE PONGO LOS VALORES POR DEFECTO
	$nombre_controlador = controller_default;
	
}else{ //SI NO, LANZO ERROR
	show_error();
	exit();
}

if(class_exists($nombre_controlador)){ //COMPRUEBO QUE EXISTE LA CLASE DEL CONTROLADOR
	$controlador = new $nombre_controlador();  //SI EXISTE ESA CLASE CREO EL OBJETO
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){ //SI ME LLEGA LA ACCIÓN Y EL MÉTODO LO INVOCO
		$action = $_GET['action'];
		$controlador->$action();
	}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){ //SI NO LE PONGO LOS VALORES POR DEFECTO
		$action_default = action_default;
		$controlador->$action_default();
	}else{ //SI NO, LANZO ERROR
		show_error();
	}
}else{ //SI LA CLASE DEL CONTROLADOR NO EXISTE LANZO ERROR
	show_error();
}

require_once 'views/layout/footer.php';


