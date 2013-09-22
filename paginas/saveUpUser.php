<?php
$idF=$_POST["txtId"];
$usuario=$_POST["txtUsuario"];
$nombre=$_POST["txtNombre"];
if(isset($_POST["txtApellido"])){
	$apellido=$_POST["txtApellido"];
}
$privilegio=$_POST["lstCargo"];
$campos[0]=$nombre;
//$campos[1]=$email;
print_r($campos);
$objMedio=new Sisnej;
//conectar();
/*$objGuardar=new Noticias;
//$actMag=$objGuardar->actualizar_magistrado($idF,$campos);
$rs = $objGuardar->actualizar_magistrado($idF,array($nombre,$email));*/
if($privilegio=="notificador"){
	$rs=mysql_query("UPDATE notificador SET Nombre='$nombre',Apellido='$apellido' WHERE Usuario='$idF'") or die(mysql_error());	
}else if($privilegio=="adminceu"){
	$rs=mysql_query("UPDATE adminceu SET Nombre='$nombre' WHERE Usuario='$idF'") or die(mysql_error());	
}

if($rs){
	echo "<br>Registro actualizado<br>";
	//$objMedio->agregarBitacora("Se modificó la información del usuario ".$nombre." ".$apellido." el día ".date('d-m-Y H:i:s'),$_SESSION["user"],"2");
}else{
	echo "Hubo un error";
}
//header("Location:?mod=login");
?>