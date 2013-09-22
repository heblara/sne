<h1><img src='img/usercard.png' /><br><br>INFORMACIÓN DE SU CUENTA</h1>
<?php 
if($_SESSION["tipo"]=="Abogado"){
	$consultarCEU=$objSisnej->consultar_ceu($_SESSION["ceu"]);
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
<?php
		//print_r($datos);
	}
}else if($_SESSION["tipo"]=="notificador"){
	$consultarCEU=$objSisnej->consultar_notificador($_SESSION['nombre']);
	if($consultarCEU->rowCount()>0){
		$datos=$consultarCEU->fetch(PDO::FETCH_OBJ);
		?>
	<table id="tcontainer">
		<tr>
			<th>Nombres:</th>
			<td><?php echo $datos->Nombre ?></td>
		</tr>
		<tr>
			<th>Apellidos:</th>
			<td><?php echo $datos->Apellido ?></td>
		</tr>
		<tr>
			<th>Juzgado:</th>
			<td><?php 
			$consultarJuzgado=$objSisnej->consultar_juzgado($consultarUsuario->idJuzgado)->fetch(PDO::FETCH_OBJ);
            $juzgado=$consultarJuzgado->Juzgado;
            $municipio=$consultarJuzgado->Municipio;
            $departamento=$consultarJuzgado->Departamento;
			echo $juzgado." DE ".$municipio.", ".$departamento; ?></td>
		</tr>
	</table>
<?php
		//print_r($datos);
	}
}else if($_SESSION["tipo"]=="adminceu"){
	
}
?>