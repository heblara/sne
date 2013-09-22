<table width='100%' id="tcontainer">
<?php
	$id=base64_decode($_GET["id"]);
	$consultarNot=$objSisnej->consultar_notificacion($id);
	$objSisnej->MarcarLeido($id);
	$objSisnej->DarSeguimiento($id,'1',$_SESSION["ceu"],"abogado");
	while($resNot=$consultarNot->fetch(PDO::FETCH_OBJ)){
?>
	<tr>
		<th align='right' width='10%'>Remitente:</th>
		<td>&nbsp;</td>
		<td><?php echo $resNot->Juzgado ?></td>
	</tr>
	<tr>
		<th align='right'>Asunto:</th>
		<td>&nbsp;</td>
		<td style=''><?php echo $resNot->Asunto ?></td>
	</tr>
	<tr>
		<th align='right'>Fecha:</th>
		<td>&nbsp;</td>
		<td><?php echo $resNot->Fecha ?></td>
	</tr>
	<tr>
		<th align='right'>Archivo adjunto:</th>
		<td>&nbsp;</td>
		<td>
			<?php if($resNot->Archivo!=""){ ?>
			<a href='<?php echo $resNot->Archivo ?>'><img src='img/clip.png' width='24px' />
			<?php $ar=explode('/', $resNot->Archivo);
				echo $ar[1] ;
			?>
			</a>
		<?php
		}else{
			echo "<i>No hay archivo adjunto</i>";
		}
		?>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>
			<?php echo $resNot->Contenido ?>
		</td>
	</tr>
<?php
	}
?>
</table>