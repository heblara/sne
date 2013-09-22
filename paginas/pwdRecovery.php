<?php
$id=base64_decode($_GET["id"]);
$consultarUsuario=mysql_query("Select * from usuario where idUser='".$id."'");
$usuario=mysql_fetch_assoc($consultarUsuario);
if($resetearContraseña=mysql_query("UPDATE usuario SET Contrasena = '".md5($usuario["Usuario"])."' where idUser='".$id."'")){
	echo "Contraseña actualizada para el usuario ".$usuario["Usuario"]." La contraseña es su mismo usuario.";
}

?>