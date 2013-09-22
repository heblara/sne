<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html> 
<head>  
<form name="placeholder" id="placeholder" method="get" action="#"> 
  <input id="popup_container" name="popup_container" type="text" /> 
<input type="button" name="imprimir" value="ver fecha" onclick="alert(document.placeholder.popup_container.value);"> 
</form> 
<table align="center">
<tr><td><table align="center">
<form name="frmlstSoporteTecnico.php" method="post" action="soportetecnico.php?var=lstST&b=y" onsubmit="return comprobar();">
<tr>
<td colspan="4">Buscar:</td><td><input type="text" name="txtBuscar"></td>
<td><select name="selTipo">
<option value="usuario">Usuario</option>
<option value="fecha">Fecha</option>
</select></td><td><input type="image" src="../botones/buscar1.gif" name="btnEnviar" title="Buscar Usuarios" /></td>
</tr>
</form>
</table>
<tr>

<td colspan="7">
<div id="error">
<?php
if($_GET["inf"]=="error"){
echo "Debe de haber datos en el buscador";
}
?>
</div></td>
</tr>
<tr>
<td colspan="7">
<?php 
if($_GET["b"]=="y"){
include("soportetecnico.php");
}
?>
</td>
</tr>
</table>
</body>