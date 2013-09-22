<?php
function conectar()
{
	mysql_connect("localhost", "root", "admincsj");
	mysql_select_db("paises");
}

function desconectar()
{
	mysql_close();
}
?>