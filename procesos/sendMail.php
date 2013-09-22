<?php
	include("header.php");
	extract($_POST);
	session_start();
	$respuesta = new stdClass();
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
			$mensaje="Ha recibido una nueva Notificacion en su Cuenta Electrónica Única";
			$conLastId=$objSisnej->obtener_id();
			$resLastId=$conLastId->fetch(PDO::FETCH_OBJ);
			echo $resLastId->ProximoId;
			if($guardarCorreo=$objSisnej->guardar_notificacion($txtAsunto,$txtContenido,$resNotificado->CEU,$rutadoc,$_SESSION["juzgado"])){
				if($rutadoc!=""){
					copy($documento,$rutadoc);
				}
				$consultarCorreo=$objSisnej->consultar_correo($resLastId->ProximoId);
				$resCorreo=$consultarCorreo->fetch(PDO::FETCH_OBJ);
				if($consultarCorreo->rowCount()>0){
					if(Enviar_Email($resNotificado->CEU,$resNotificado->Nombre,$mensaje,"Notificación Corte Suprema de Justicia","",$txtAsunto,"")){
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
		$respuesta->mensaje = 3;
		echo "<center>".$a." correos electr&oacute;nicos fueron enviados</center>";
	}else{
		$respuesta->mensaje = 2;
		echo "<center>Hubo errores, ".$a." correos fueron enviados y ".$b." dieron error</center>	";
	}
echo json_encode($respuesta);
?>