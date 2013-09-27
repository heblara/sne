<?php 
extract($_POST);
$objSisnej=new Sisnej;
$cuenta=array();
$cuenta[0]=$txtNombre;
$cuenta[1]=$txtCarne;
$cuenta[2]=$txtFechaExp;
$cuenta[3]=$txtAcuerdo;
$cuenta[4]=$txtFechaAcuerdo;
$cuenta[5]=$txtDUI;
$cuenta[6]=$txtNombreDUI;
$cuenta[7]=$txtDireccion;
$cuenta[8]=$paises;
$cuenta[9]=$estados;
$cuenta[10]=$txtEmail;
$cuenta[11]=$txtMovil;
$cuenta[12]=$lstEstado;
$consultarCEU=$objSisnej->consultar_ceu($txtEmail);
if($consultarCEU->rowCount()==1){
	if($guardarCuenta=$objSisnej->actualizar_cuenta($cuenta)){
		echo "<br /><b>Datos actualizados correctamente</b><br />";
		$consultarUsuario=$objSisnej->buscar_usuario($txtEmail);
		if($lstEstado==1){
			if($consultarUsuario->rowCount==0){
				$codigo=generarCodigo(6);
				$usuario = array($txtEmail,$codigo,"Abogado","1");
				$objSisnej->guardar_usuario($usuario);
				$objSisnej->ValidarCuenta($txtEmail);
				echo "La cuenta del usuario ha sido validada con exito<br>Su contrase&ntilde;a se ha enviado a su Correo Personal<br>Para ingresar a su cuenta haga <a href='http://sne.csj.gob.sv/?mod=login'>clic aqui</a>";
	        	$mensaje="Su cuenta ha sido validada con exito<br>Para ingresar a su cuenta haga <a href='http://sne.csj.gob.sv/?mod=login'>clic aqui</a><br /><br />
	        	Datos de acceso:<br />
	        	Usuario: ".$txtEmail."<br />
	        	Contrase&ntilde;a: ".$codigo."<br />
	        	<br />
	        	<hr />
	        	<h3>Instrucciones básicas de acceso:</h3><br />
	        	Debe cambiar su contrase&ntilde;a al primer inicio para que su contrase&ntilde;a sea m&aacute;s segura.";
	        	Enviar_Email($txtEmail,$txtNombre,$mensaje,"Sistema de Notificacion Electronica Judicial, CSJ","","Activacion realizada con exito","");
			}
		}
	}
}else{
	echo "No es posible procesar la información";
}
?>