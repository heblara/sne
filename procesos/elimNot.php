<?php 
include("header.php");
session_start();
if(isset($_GET["id"])){
	$respuesta = new stdClass();
	$objSisnej=new Sisnej;
	$id=$_GET["id"];
	//if($eliminar=$objSisnej->eliminar_notificacion($id)){
	//$borrado=array($_SESSION["usuario"],date('Y-m-d H:i:s'),$_GET["id"]);
	if($registrar=$objSisnej->DarSeguimiento($id,'2',$_SESSION["nombre"],$_SESSION["tipo"])){
		echo "Notificacion eliminada";
	}
	//}
	//echo "Notificacion eliminada";
	//header("Location:?mod=modificargaleria");
}
?>