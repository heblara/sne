<?php
$consulta="SELECT * FROM usuario WHERE idUser='".base64_decode($_GET["id"])."'";
$objBuscar=new Sisnej;
$con1=$objBuscar->consultar_usuarios($consulta);
$row=$con1->fetch(PDO::FETCH_OBJ);
$total=$con1->rowCount();
if($total>0){
?>
<form name='addUser' action="?mod=saveUpUser" method="post">
<table align="center">
<tr>
<caption><b>Modificar informacion de usuario</b></caption>
</tr>
<tr>
<td>Usuario:</td>
<td><input type="text" maxlength="50" size="20" name="txtUsuario" value="<?php echo $row->Usuario ?>" readonly="readonly"></td>
</tr>
<tr>
<td>Nombre:</td>
<?php 
	$nombre="";
	if($row->TipoUsuario=="adminceu"){
		$conAdminCeu=$objBuscar->consultar_adminceu($row->Usuario);
		$adminceu=$conAdminCeu->fetch(PDO::FETCH_OBJ);
		$nombre=$adminceu->Nombre;
		?><td><input type="text" maxlength="100" size="50"  name="txtNombre" value="<?php echo $nombre ?>"></td><?php
	}else if($row->TipoUsuario=="notificador"){
		$conNotificador=$objBuscar->consultar_notificador($row->Usuario);
		$notificador=$conNotificador->fetch(PDO::FETCH_OBJ);
		$nombre=$notificador->Nombre;
		?><td><input type="text" maxlength="100" size="20"  name="txtNombre" value="<?php echo $notificador->Nombre ?>"><br><input type="text" maxlength="100" size="20"  name="txtApellido" value="<?php echo $notificador->Apellido ?>"></td><?php		
	} ?>
<input type="hidden" maxlength="100" size="50"  name="txtId" value="<?php echo $row->idUser ?>">
</tr>
<tr>
<td>Cargo:</td>
<td>
<select name="lstCargo">
<option value='adminceu' <?php if($row->TipoUsuario=="adminceu"){ echo "selected";}?>>Administrador de cuentas electr&oacute;nicas &uacute;nicas</option>
<option value='notificador' <?php if($row->TipoUsuario=="notificador"){ echo "selected";}?>>Notificador</option>
</select>
</td>
</tr>
<tr>
<tr>
<td>Estado:</td>
<td><select id="lstEstado" name="lstEstado">
<option value="1" <?php if($row->Estado==1){ echo "selected"; } ?>>Activo</option>
<option value="0" <?php if($row->Estado==0){ echo "selected"; } ?>>Inactivo</option>
</select></td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="cmdEnviar" value="Guardar Cambios" /></td>
</tr>
</table>
</form>
<?php
}
?>