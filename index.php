<?php
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
include_once ('DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('sisnej.class.php');
include("conf.php");
include("conexion.php");
if(isset($_GET['mod'])){
	//if(!empty($_GET['mod'])){
		$modulo = $_GET['mod'];
	//}
}else{
	$modulo = MODULO_DEFECTO;
}
if(isset($conf[$modulo]["layout"])){
	$path_layout = LAYOUT_PATH . '/' . $conf[$modulo]["layout"];
	if(!empty($conf[$modulo]['layout'])){
		include($path_layout);
	}
}else{
	$modulo="404";
	$path_layout = LAYOUT_PATH . '/' . $conf[$modulo]["layout"];
	include($path_layout);
}
?>