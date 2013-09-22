<table align="center" width="100%">
<tr>
<th width="10%">Fecha</th>
<th width="10%">Usuario</th>
<th width="70%">Accion</th>
<th width="10%">Tipo Accion</th>
</tr>
<?php
$bitacora=mysql_query('Select * from bitacora');
while($row=mysql_fetch_assoc($bitacora)){
?>
<tr>
<td><?php echo $bitacora["Fecha"]; ?></td>
<td><?php echo $bitacora["idUsuario"]; ?></td>
<td><?php echo $bitacora["Accion"]; ?></td>
<?php
if($bitacora["Tipo_Accion"]==1){
	$accion='Adicion';
}else if($bitacora["Tipo_Accion"]==2){
	$accion='Modificacion';
}else if($bitacora["Tipo_Accion"]==3){
	$accion='Eliminación/Desactivación';
}
?>
<td><?php echo $accion; ?></td>
</tr>
<?php
}
?>
</table>