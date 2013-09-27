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
			$mensaje="<p>Ha recibido una nueva Notificacion en su Cuenta Electrónica Única sobre ".$txtAsunto." del ".$njuzgado.", es necesario que ingrese a su cuenta para que pueda ver el contenido.<br><a href='sne.csj.gob.sv'>Ingresar al sistema</a></p>";

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
					if(Enviar_Email($resNotificado->CEU,$resNotificado->Nombre,$mensaje,"Corte Suprema de Justicia, Sistema de Notificacion Electronica","",$txtAsunto,"")){
						$error="no";
						$a++;
					}else{
						$error="si";
						$b++;
					}
				}else{
				}
			}
		}
	if($error=="no"){
		echo "<center>La notificación ha sido enviada al usuario.</center>";
	}else{
		echo "<center>Surgi&oacute; un error al enviar la notificación.</center>";
	}
?>