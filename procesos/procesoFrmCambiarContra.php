<?php
include("header.php");
sleep(1);
session_start();
$respuesta = new stdClass();
extract($_POST);
$error=false;
if($txtContraActual==""){
	$respuesta->mensaje = "La contraseña actual es obligatoria";
	$error=true;
}
if($error==false){
	$consul=mysql_query("SELECT * FROM usuario WHERE Usuario='".$_SESSION["nombre"]."' and Contrasena=md5('".$_POST["txtContraActual"]."')");	
	//$respuesta->mensaje = "SELECT * FROM usuario WHERE Usuario='".$_SESSION["nombre"]."' and Contrasena=md5('".$_POST["txtContraActual"]."')"
	$nr=mysql_num_rows($consul);
	if($nr==1){
		if($txtContraNueva==""){
			$respuesta->mensaje = "Debe ingresar una contraseña nueva para continuar";
			$error=true;
		}else if($txtContraConfir==""){
			$respuesta->mensaje = "Es necesario confirmar la nueva contraseña";
			$error=true;
		}else if($txtContraConfir!=$txtContraNueva){
			$respuesta->mensaje = "La nueva contraseña no coincide con su confirmación";
			$error=true;
		}else{
			if(mysql_query("UPDATE usuario SET Contrasena=md5('".$_POST["txtContraNueva"]."') WHERE Usuario='".$_SESSION["nombre"]."'")){
				$respuesta->mensaje = "1";
				//echo "Contraseña cambiada";
			}else{
				$respuesta->mensaje = "2";
				//echo "Error al cambiar la contraseña";
			}
		}	
	}else{
		//echo "La contraseña actual es invalida";
		$respuesta->mensaje = "3";
	}
	//$respuesta->mensaje="SELECT * FROM usuario WHERE Usuario='".$_SESSION["nombre"]."' and Contrasena=md5('".$_POST["txtContraActual"]."')";
}
//$respuesta->mensaje = "SELECT * FROM usuario WHERE Usuario='".$_SESSION["nombre"]."' and Contrasena=md5('".$_POST["txtContraActual"]."')"
echo json_encode($respuesta);
?>