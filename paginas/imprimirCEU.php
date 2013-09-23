<?php 
if(isset($_GET["ceu"])){
	$ceu=$_GET["ceu"];
	$objSisnej=new Sisnej;
	$consultarCuenta=$objSisnej->consultar_ceu($ceu);
}
?>