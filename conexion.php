<?php
if($link=mysql_connect("localhost", "root", "admincsj")){
	mysql_select_db("sisnej");
}else{
	echo "No se pudo establecer la conexion";
}
function conectar(){
	if($link=mysql_connect("localhost", "root", "admincsj")){
		mysql_select_db("sisnej");
	}else{
		echo "No se pudo establecer la conexion";
	}
}
function desconectar()
{
	mysql_close();
}
?>