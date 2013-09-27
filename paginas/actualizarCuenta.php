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
		echo "Datos actualizados correctamente";
	}
}else{
	echo "No es posible procesar la información";
}
?>