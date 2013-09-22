<?php 
include("paginas/num2letras.php");
?>
<table width='100%' id="tcontainer">
<?php
	$id=base64_decode($_GET["id"]);
	$consultarNot=$objSisnej->consultar_notificacion($id);
	/*$objSisnej->MarcarLeido($id);
	$objSisnej->DarSeguimiento($id,'1');*/
	while($resNot=$consultarNot->fetch(PDO::FETCH_OBJ)){
?>
	<tr>
		<th align='right' width='10%'>Remitente:</th>
		<td>&nbsp;</td>
		<td><?php echo $resNot->Juzgado ?></td>
	</tr>
	<tr>
		<th align='right' width='10%'>Enviado a:</th>
		<?php 
		$conNotificado=$objSisnej->consultar_notificado_especifico($resNot->CEU);
		$resceu=$conNotificado->fetch(PDO::FETCH_OBJ);
		?>
		<td>&nbsp;</td>
		<td><?php echo $resceu->Nombre." (".$resceu->CEU.")"?></td>
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
				echo $ar[0];
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
	<tr>
		<th align="center">Seguimiento de notificaci&oacute;n</th>
		<td>
		</td>
		<td>
			<?php 
			$leido=0;
			$fecha="";
			$consultarSeguimiento=$objSisnej->consultar_seguimiento($id);
			while($res=$consultarSeguimiento->fetch(PDO::FETCH_OBJ)){
				if($res->Tipo=="1"){
					$leido++;
					$fecha=$res->Fecha;
				}else if($res->Tipo=="2"){
					if($res->TipoUsuario=="Abogado"){
						echo strtoupper("<li>Fue borrado en fecha: ".$res->Fecha." por el usuario: ".$res->Usuario."</li>");
					}else if($res->TipoUsuario=="notificador"){
						$conNotificador=$objSisnej->consultar_notificador($res->Usuario);
						$notificador=$conNotificador->fetch(PDO::FETCH_OBJ);
						echo strtoupper("<li>Fue borrado en fecha: ".$res->Fecha." por el notificador: ".$notificador->Nombre." ".$notificador->Apellido."</li>");
					}
				}
			}
			if($leido>0){
				if($leido==1){
					$vez="vez";
				}else{
					$vez="veces";

				}
				echo strtoupper("<li>El mensaje ha sido leído ".num2letras($leido,true)." ".$vez." y la ultima fue el ".$fecha."</li>");
			}else{
				echo strtoupper("<li>El mensaje aun no ha sido leido</li>");
			}
			$consultarIngreso=$objSisnej->consultar_ingreso($resNot->CEU,$resNot->FechaEnvio);
			$j=0;
			while($ingreso=$consultarIngreso->fetch(PDO::FETCH_OBJ)){
				$j++;
				//echo $ingreso->Fecha;
			}
			if($j==1){
				$vez="vez";
			}else{
				$vez="veces";

			}
			if($j>0){
				echo strtoupper("<li>El usuario ingresÓ ".num2letras($j,true)." ".$vez." despuÉs de enviada la notificaciÓn</li>");
			}
			?>

		</td>
	</tr>
<?php
	}
?>
</table>