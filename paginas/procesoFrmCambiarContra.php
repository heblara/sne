<?php
sleep(1);
$consul=mysql_query("select * from usuario where Usuario='".$_SESSION["user"]."' and Contrasena=md5('".$_POST["txtContraActual"]."')",$link);
$nr=mysql_num_rows($consul);
if($nr==1){
	if(mysql_query("UPDATE usuario SET Contrasena=md5('".$_POST["txtContraNueva"]."') WHERE Usuario='".$_SESSION["user"]."'")){
		echo "Contraseña cambiada";
	}else{
		echo "Error al cambiar la contraseña";
	}
}else{
	echo "La contraseña actual es invalida";
}
?>