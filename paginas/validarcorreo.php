<?php
$user=base64_decode($_GET["ceu"]);
if($user=="" || $user==null || trim($user)==""){
    header("Location:?mod=home");
}else{
	$objUser=new Sisnej;
	$consultarCEU=$objUser->consultar_ceu($user);
	if($consultarCEU->rowCount()==1){
		$cuenta=$consultarCEU->fetch(PDO::FETCH_OBJ);
		$codigo=generarCodigo(8);
		$usuario = array($cuenta->Email,$codigo,"Abogado","1");
		$objUser->guardar_usuario($usuario);
        if($validar=$objUser->ValidarCuenta($user)){
        	echo "Su cuenta ha sido validada con exito<br>Su contrase&ntilde;a se ha enviado a su Correo Personal<br>Para ingresar a su cuenta haga <a href='http://sne.csj.gob.sv/?mod=login'>clic aqui</a>";
        	$mensaje="Su cuenta ha sido validada con exito<br>Para ingresar a su cuenta haga <a href='http://sne.csj.gob.sv/?mod=login'>clic aqui</a><br /><br />
        	Datos de acceso:<br />
        	Usuario: ".$cuenta->Email."<br />
        	Contrase&ntilde;a: ".$codigo."<br />
        	<br />
        	<hr />
        	<h3>Instrucciones básicas de acceso:</h3><br />
        	Debe cambiar su contrase&ntilde;a al primer inicio para que su contrase&ntilde;a sea m&aacute;s segura.";
        	//echo $mensaje;
        	Enviar_Email($cuenta->Email,$cuenta->Nombre,$mensaje,"Sistema de Notificacion Electronica Judicial, CSJ","","Activacion realizada con exito","");
        }
    }
}
?>