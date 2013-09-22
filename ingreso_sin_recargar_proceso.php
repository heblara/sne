<?php
function validaValor($cadena)
{
	// Funcion utilizada para validar el dato a ingresar recibido por GET	
	if(eregi('^[a-zA-Z0-9._αινσϊρ‘!Ώ? -]{1,40}$', $cadena)) return TRUE;
	else return FALSE;
}
$valor=trim($_GET['dato']); $campo=trim($_GET['actualizar']);
if(validaValor($valor) && validaValor($campo))
{
	// Si los campos son validos, se procede a actualizar los valores en la DB
	include 'conexion.php';
	conectar();

	// Actualizo el campo recibido por GET con la informacion que tambien hemos recibido
	mysql_query("UPDATE titulo SET Titulo='$valor' WHERE idTitulo='$campo'") or die(mysql_error());
	desconectar();
	include_once ('DBManager.class.php'); //Clase de Conexiσn a las Base de Datos
	include('sisnej.class.php');
	$objMedio=new Noticias;
	$objMedio->agregarBitacora("Se modificσ el tνtulo ".$campo." el dνa ".date('d-m-Y H:i:s'),$_SESSION["user"],"2");
}
// No retorno ninguna respuesta
?>