<?php
//@require("phpmailer/class.phpmailer.php");
function Enviar_Email($Correo_Envio, $Nombre_Envio, $Mensaje_Envio, $Firma_Envio, $Correo_Envia, $Asunto_Mensaje,$Imagen) 
{
	require("phpmailer/class.phpmailer.php");
	if($Correo_Envia!=""){
		$Correo_Emisor=$Correo_Envia;
	}else{
		$Correo_Emisor="heberlara07@gmail.com";
	}
	
	$mail = new PHPMailer();
	$mail->IsSMTP();  // send via SMTP     
	$mail->Host = 'mail.csj.gob.sv';
	//$mail->From     = "heberlara07@gmail.com";
	//$mail->Host     = "mail.csj.gob.sv"; // SMTP servers
//	$mail->Host     = "mail.oj.gob.sv"; // SMTP servers
//	$mail->Host     = "mail.tejutepeque.com"; // SMTP servers
	//$mail->From     = $Correo_Emisor;
	//$mail->UserName = "ahurtado@mail.oj.gob.sv";
	//$mail->From     = "heberlara07@gmail.com";
	$mail->FromName = $Firma_Envio;
	$mail->AddAddress($Correo_Envio,$Nombre_Envio);
	$mail->WordWrap = 50;
	$mail->CharSet  = "UTF-8";	                            
	$mail->IsHTML(true);
	$mail->Subject  =  $Asunto_Mensaje;
	$mail->Body     =  $Mensaje_Envio;
	$mail->AltBody  =  "Alt Body";
	if($Imagen!=""){
		$mail->AddAttachment($Imagen);	
	}
	//echo $mail->AddAttachment($Imagen);
	$mail->AddEmbeddedImage("img/CSJ.png",'Imagen');	
	if(!$mail->Send())
	{
		echo "Error al enviar el correo: " . $mail->ErrorInfo."<br>";
		return false;	
	}
	else
	{
		return true;
	}
}
function num2month($month){
	if($month==1){
		$mes="enero";
	}else if($month==2){
		$mes="febrero";
	}else if($month==3){
		$mes="marzo";
	}else if($month==4){
		$mes="abril";
	}else if($month==5){
		$mes="mayo";
	}else if($month==6){
		$mes="junio";
	}else if($month==7){
		$mes="julio";
	}else if($month==8){
		$mes="agosto";
	}else if($month==9){
		$mes="septiembre";
	}else if($month==10){
		$mes="octubre";
	}else if($month==11){
		$mes="noviembre";
	}else if($month==12){
		$mes="diciembre";
	}
	return $mes;
}
function dias2letras($dia){
	$letras="";
	//echo $dia;
	switch($dia){
		case 0:
			$letras="Domingo";
		break;
		case 1:
			$letras="Lunes";
		break;
		case 2:
			$letras="Martes";
		break;
		case 3:
			$letras="Miercoles";
		break;
		case 4:
			$letras="Jueves";
		break;
		case 5:
			$letras="Viernes";
		break;
		case 6:
			$letras="Sabado";
		break;
	}
	return $letras;
}

function borrar_directorio($dir, $borrarme)
{
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) 
    {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) borrar_directorio($dir.'/'.$obj, true);
    }
    closedir($dh);
    if ($borrarme)
    {
        @rmdir($dir);
    }
}
function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 	return $key;
}
?>
