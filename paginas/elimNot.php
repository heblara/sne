<?php 
if(isset($_GET["id"])){
	$objSisnej=new Sisnej;
	$id=base64_decode($_GET["id"]);
	$eliminar=$objSisnej->eliminar_notificacion_notificador($id);
	echo "Notificacion eliminada";
	//header("Location:?mod=modificargaleria");
}
?>