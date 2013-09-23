<?php 
if(isset($_GET["ceu"])){
	$ceu=$_GET["ceu"];
	$objSisnej=new Sisnej;
	$consultarCEU=$objSisnej->consultar_ceu($ceu);
	if($consultarCEU->rowCount()>0){
		$datos=$consultarCEU->fetch(PDO::FETCH_OBJ);
?>
	<table width='100%' id='datauser'>
		<tr>
			<th width='25%'>Nombre:</th>
			<td><?php echo $datos->Nombre ?></td>
		</tr>
		<tr>
			<th>Carne de abogado No:</th>
			<td><?php echo $datos->Carne ?></td>
		</tr>
		<tr>
			<th>Fecha Expedici&oacute;n del carnet:</th>
			<td><?php echo $datos->FechaExpedicion ?></td>
		</tr>
		<tr>
			<th>N&uacute;mero de acuerdo:</th>
			<td><?php echo $datos->NoAcuerdo ?></td>
		</tr>
		<tr>
			<th>Fecha de acuerdo:</th>
			<td><?php echo $datos->FechaAcuerdo ?></td>
		</tr>
		<tr>
			<th>DUI:</th>
			<td><?php echo $datos->DUI ?></td>
		</tr>
		<tr>
			<th>NombreDUI:</th>
			<td><?php echo $datos->NombreDUI ?></td>
		</tr>
		<tr>
			<th>Direcci&oacute;n:</th>
			<td><?php echo $datos->Direccion ?></td>
		</tr>

	</table>
?>
	}
}
?>