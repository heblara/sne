<?php
include("conexionM.php");

$consul="select * from persona where NIT='".$_GET["NIT"]."'";
$resul=$db->query($consul)or die("no se realizo la busqueda persona");
$num_row=$resul->num_rows;
$row=$resul->fetch_assoc();
//verificacion si existe la persona
if($num_row>0){
	//verificacion si no ha realizado su voto
	$consulVoto="select * from votacion where NIT='".$_GET["NIT"]."'";
	$resulVoto=$db->query($consulVoto)or die("no se verifico su voto");
	$num_rowVoto=$resulVoto->num_rows;
	if($num_rowVoto==0){
		echo $row["Nombre"]."*3";
	}else{
		echo $row["Nombre"]."*2";	
	}
	
}else{
   echo "1*1";	
}
?>