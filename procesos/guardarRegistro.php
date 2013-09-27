<?php 
include("header.php");
extract($_POST);
$objSisnej=new Sisnej;
$respuesta = new stdClass();
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
$cuenta[12]=0;
$error=false;
for ($i=0; $i < count($cuenta); $i++) { 
	if($cuenta[$i]=="" || $cuenta[$i]==false){
		$error=true;
	}	
}
if($error==true){
	$respuesta->mensaje=3;
}else{
	$consultarCEU=$objSisnej->consultar_ceu($txtEmail);
	if($consultarCEU->rowCount()==1){
		$respuesta->mensaje = "1";
	    //echo "Esa cuenta ya existe, no se pueden duplicar registros";
	}else{
		if($guardarCuenta=$objSisnej->crear_cuenta($cuenta)){
			$codigo=generarCodigo(6);
			$respuesta->mensaje = "2";
			/*$usuario = array($txtEmail,$codigo,"Abogado","0");
			$objSisnej->guardar_usuario($usuario);*/
			$mensaje="Su registro se ha procesado exitosamente, para hacer valida estos datos, debe presentarse personalmente a las Oficinas Administrativas y Jur&iacute;dicas de la Corte Suprema de Justicia.";
			Enviar_Email($txtEmail,$txtNombre,$mensaje,"Notificacion Electronica Judicial Corte Suprema de Justicia","","Validacion de correo electronico","");
			/**/
			//echo "<br><b>Se ha creado la cuenta, un correo ha sido enviado a la cuenta personal del usuario a espera de validar dicha cuenta.</b><br>";
		}
	}
}
echo json_encode($respuesta);
/*print_r($_POST);
print_r($cuenta);*/
?>