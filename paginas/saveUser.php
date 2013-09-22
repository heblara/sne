<?php
$usuario=$_POST["txtUsuario"];
$nombre=$_POST["txtNombre"];
$email=$_POST["txtEmail"];
$cargo=$_POST["lstCargo"];
$apellido=$_POST["txtApellido"];
$juzgado=0;
if(isset($_POST["combobox"])){
	$juzgado=$_POST["combobox"];
}
$error=1;
$carg="";
if($cargo=="1"){
	$carg="notificador";
}else if($cargo=="2"){
	$carg="adminceu";
}
if(mysql_query("INSERT INTO usuario VALUES('','".$usuario."',md5('".$usuario."'),'".$carg."','1')") or die(mysql_error())){
	if($cargo=="1"){
		if(mysql_query("INSERT INTO notificador VALUES('','".$usuario."','".$nombre."','".$apellido."',".$juzgado.")") or die(mysql_error())){
			$error=0;
		}
	}else if($cargo=="2"){
		if(mysql_query("INSERT INTO adminceu VALUES('','".$usuario."','".$nombre."')") or die(mysql_error())){
			$error=0;
		}
	}
	if($error==0){
		echo "<center>Se ha agregado exitosamente el nuevo usuario</center>";
	}else{
		echo "Hubo un error";
	}
	//session_start();
	//$objMedio->agregarBitacora("Se agrego el usuario ".$usuario." el día ".date('d-m-Y h:i:s a'),$_SESSION["user"],"1");
}else{
	echo "No se guardo";
}
//header("Location:?mod=login");
?>