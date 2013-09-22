<?php
	extract($_POST);
	$archivo="";
	$documento=$_FILES["documento"]["tmp_name"];
	$Imagen=$_FILES["documento"]["tmp_name"];
	$size=$_FILES["documento"]["size"];
	$rutadoc=$_FILES["documento"]["name"];
	$archivo=$rutadoc;
	$a=0;
	$b=0;
	$error="no";
	$funcionarios=explode("###",$idFuncionario);
		for($i=0;$i<count($funcionarios);$i++){
			$idnot=$funcionarios[$i];
			$conNotificado=$objSisnej->consultar_notificado_especifico($idnot);
			$resNotificado=$conNotificado->fetch(PDO::FETCH_OBJ);
			$mensaje="<img src='img/CSJ.png' width='100px' /><p>Ha recibido una nueva Notificacion en su Cuenta Electrónica Única, es necesario que ingrese a su cuenta para que pueda ver el contenido.</a>";
			$conLastId=$objSisnej->obtener_id();
			$resLastId=$conLastId->fetch(PDO::FETCH_OBJ);
			//echo $resLastId->ProximoId;
			if($guardarCorreo=$objSisnej->guardar_notificacion($txtAsunto,$txtContenido,$resNotificado->CEU,$rutadoc,$_SESSION["juzgado"])){
				if($rutadoc!=""){
					copy($documento,$rutadoc);
				}
				$consultarCorreo=$objSisnej->consultar_correo($resLastId->ProximoId);
				$resCorreo=$consultarCorreo->fetch(PDO::FETCH_OBJ);
				if($consultarCorreo->rowCount()>0){
					//function Enviar_Email($Correo_Envio, $Nombre_Envio, $Mensaje_Envio, $Firma_Envio, $Correo_Envia, $Asunto_Mensaje,$Imagen) 
					if(Enviar_Email($resNotificado->CEU,$resNotificado->Nombre,$mensaje,"Corte Suprema de Justicia, Sistema de Notificacion Electrónica","no-reply@csj.gob.sv","Notificando resolucion a las ".date("H:i:s")." del dia".date("d-m-Y"),"")){
						$error="no";
						$a++;
					}
				}else{
					$error="si";
					$b++;
				}
			}
		}
	if($error=="no"){
		echo "<center>El correo electr&oacute;nico fue enviado al destinatario.</center>";
	}else{
		echo "<center>Surgi&oacute; un error al enviar el correo.</center>	";
	}
?>