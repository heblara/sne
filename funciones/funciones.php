<?php
function Enviar_Email($Correo_Envio, $Nombre_Envio, $Mensaje_Envio, $Firma_Envio, $Correo_Envia, $Asunto_Mensaje,$Imagen) 
{
	if($Correo_Envia!=""){
		$Correo_Emisor=$Correo_Envia;
	}else{
		$Correo_Emisor="notificaciones@csj.gob.sv";
	}
	$mail = new PHPMailer();
	//$mail->SMTPDebug=2; 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	//$mail->SMTPSecure = "ssl"; 
	$mail->Host = "smtpout.secureserver.net"; 
	$mail->Port = 80; 
	$mail->Username = "info@heblara.biz"; 
	$mail->Password = "chame2904";
	$mail->From = $Correo_Emisor; 
	$mail->FromName = utf8_encode($Firma_Envio); 
	$mail->Subject 	= $Asunto_Mensaje;
	$mail->AddEmbeddedImage('img/CSJ.png','CSJ','img/CSJ.png','base64','image/png'); 
	$mail->Body    = plantilla($Mensaje_Envio);
	$mail->AltBody = $Mensaje_Envio; 
	$mail->AddAddress($Correo_Envio, $Nombre_Envio);
	$mail->AddReplyTo("notificacionelectronica.csj@gmail.com", "Responda a este mail");
	$mail->IsHTML(true); 
	if(!$mail->Send()) { 
		//return "Error: " . $mail->ErrorInfo; 
	} else { 
		//return "Mensaje enviado correctamente"; 
	}
	/*$mail = new PHPMailer();
	$mail->IsSMTP();  // send via SMTP     
	//$mail->SMTPDebug=1;
	$mail->Host = 'mail.csj.gob.sv';
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
		//echo "Error al enviar el correo: " . $mail->ErrorInfo."<br>";
		return false;	
	}
	else
	{
		return true;
	}*/
}
/*function Enviar_Email() {
	require("phpmailer/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();  // send via SMTP
	$mail->Host     = "mail.csj.gob.sv"; // SMTP servers
	//$mail->From     = $Correo_Emisor;
	$mail->From     = "notificaciones@csj.gob.sv";
	$mail->FromName = "Heber";
	$mail->AddAddress("heblaracsj@gmail.com","Heber Lara");
	$mail->WordWrap = 50;
	$mail->CharSet  = "UTF-8";	                            
	$mail->IsHTML(true);
	$mail->Subject  =  "Probando";
	$mail->Body     =  "Prueba";
	$mail->AltBody  =  "Alt Body";
	if($Imagen!=""){
		$mail->AddAttachment($Imagen);	
	}
	//echo $mail->AddAttachment($Imagen);
	//$mail->AddEmbeddedImage($Imagen,'Imagen');	
	if(!$mail->Send())
	{
		echo "Error: " . $mail->ErrorInfo;
		return false;	
	}
	else
	{
		return true;
	}
}*/
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
function num2letras($num, $fem = false, $dec = true) { 
   $matuni[2]  = "dos"; 
   $matuni[3]  = "tres"; 
   $matuni[4]  = "cuatro"; 
   $matuni[5]  = "cinco"; 
   $matuni[6]  = "seis"; 
   $matuni[7]  = "siete"; 
   $matuni[8]  = "ocho"; 
   $matuni[9]  = "nueve"; 
   $matuni[10] = "diez"; 
   $matuni[11] = "once"; 
   $matuni[12] = "doce"; 
   $matuni[13] = "trece"; 
   $matuni[14] = "catorce"; 
   $matuni[15] = "quince"; 
   $matuni[16] = "dieciseis"; 
   $matuni[17] = "diecisiete"; 
   $matuni[18] = "dieciocho"; 
   $matuni[19] = "diecinueve"; 
   $matuni[20] = "veinte"; 
   $matunisub[2] = "dos"; 
   $matunisub[3] = "tres"; 
   $matunisub[4] = "cuatro"; 
   $matunisub[5] = "quin"; 
   $matunisub[6] = "seis"; 
   $matunisub[7] = "sete"; 
   $matunisub[8] = "ocho"; 
   $matunisub[9] = "nove"; 

   $matdec[2] = "veint"; 
   $matdec[3] = "treinta"; 
   $matdec[4] = "cuarenta"; 
   $matdec[5] = "cincuenta"; 
   $matdec[6] = "sesenta"; 
   $matdec[7] = "setenta"; 
   $matdec[8] = "ochenta"; 
   $matdec[9] = "noventa"; 
   $matsub[3]  = 'mill'; 
   $matsub[5]  = 'bill'; 
   $matsub[7]  = 'mill'; 
   $matsub[9]  = 'trill'; 
   $matsub[11] = 'mill'; 
   $matsub[13] = 'bill'; 
   $matsub[15] = 'mill'; 
   $matmil[4]  = 'millones'; 
   $matmil[6]  = 'billones'; 
   $matmil[7]  = 'de billones'; 
   $matmil[8]  = 'millones de billones'; 
   $matmil[10] = 'trillones'; 
   $matmil[11] = 'de trillones'; 
   $matmil[12] = 'millones de trillones'; 
   $matmil[13] = 'de trillones'; 
   $matmil[14] = 'billones de trillones'; 
   $matmil[15] = 'de billones de trillones'; 
   $matmil[16] = 'millones de billones de trillones'; 
   
   //Zi hack
   $float=explode('.',$num);
   $num=$float[0];

   $num = trim((string)@$num); 
   if ($num[0] == '-') { 
      $neg = 'menos '; 
      $num = substr($num, 1); 
   }else 
      $neg = ''; 
   while ($num[0] == '0') $num = substr($num, 1); 
   if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num; 
   $zeros = true; 
   $punt = false; 
   $ent = ''; 
   $fra = ''; 
   for ($c = 0; $c < strlen($num); $c++) { 
      $n = $num[$c]; 
      if (! (strpos(".,'''", $n) === false)) { 
         if ($punt) break; 
         else{ 
            $punt = true; 
            continue; 
         } 

      }elseif (! (strpos('0123456789', $n) === false)) { 
         if ($punt) { 
            if ($n != '0') $zeros = false; 
            $fra .= $n; 
         }else 

            $ent .= $n; 
      }else 

         break; 

   } 
   $ent = '     ' . $ent; 
   if ($dec and $fra and ! $zeros) { 
      $fin = ' coma'; 
      for ($n = 0; $n < strlen($fra); $n++) { 
         if (($s = $fra[$n]) == '0') 
            $fin .= ' cero'; 
         elseif ($s == '1') 
            $fin .= $fem ? ' una' : ' un'; 
         else 
            $fin .= ' ' . $matuni[$s]; 
      } 
   }else 
      $fin = ''; 
   if ((int)$ent === 0) return 'Cero ' . $fin; 
   $tex = ''; 
   $sub = 0; 
   $mils = 0; 
   $neutro = false; 
   while ( ($num = substr($ent, -3)) != '   ') { 
      $ent = substr($ent, 0, -3); 
      if (++$sub < 3 and $fem) { 
         $matuni[1] = 'una'; 
         $subcent = 'as'; 
      }else{ 
         $matuni[1] = $neutro ? 'un' : 'uno'; 
         $subcent = 'os'; 
      } 
      $t = ''; 
      $n2 = substr($num, 1); 
      if ($n2 == '00') { 
      }elseif ($n2 < 21) 
         $t = ' ' . $matuni[(int)$n2]; 
      elseif ($n2 < 30) { 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = 'i' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      }else{ 
         $n3 = $num[2]; 
         if ($n3 != 0) $t = ' y ' . $matuni[$n3]; 
         $n2 = $num[1]; 
         $t = ' ' . $matdec[$n2] . $t; 
      } 
      $n = $num[0]; 
      if ($n == 1) { 
         $t = ' ciento' . $t; 
      }elseif ($n == 5){ 
         $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t; 
      }elseif ($n != 0){ 
         $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t; 
      } 
      if ($sub == 1) { 
      }elseif (! isset($matsub[$sub])) { 
         if ($num == 1) { 
            $t = ' mil'; 
         }elseif ($num > 1){ 
            $t .= ' mil'; 
         } 
      }elseif ($num == 1) { 
         $t .= ' ' . $matsub[$sub] . '?n'; 
      }elseif ($num > 1){ 
         $t .= ' ' . $matsub[$sub] . 'ones'; 
      }   
      if ($num == '000') $mils ++; 
      elseif ($mils != 0) { 
         if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub]; 
         $mils = 0; 
      } 
      $neutro = true; 
      $tex = $t . $tex; 
   } 
   $tex = $neg . substr($tex, 1) . $fin; 
   //Zi hack --> return ucfirst($tex);
   //$end_num=ucfirst($tex).' pesos '.$float[1].'/100 M.N.';
   $end_num=ucfirst($tex);
   return $end_num; 
} 
function plantilla($texto){
$html="<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Corte Suprema de Justicia</title>
</head>
<body>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td align='center' valign='top' bgcolor='#f6f3e4' style='background-color:#f6f3e4;'>
    <br>
    <br>
    <table width='600' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td align='center' valign='top' style='padding-left:13px; padding-right:13px; background-color:#ffffff;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
          <tr>
            <td align='center' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:48px;'><img src='cid:CSJ' /><br /><i>Corte Suprema de Justicia</i></td>
          </tr>
          <tr>
            <td align='center' valign='middle' style='padding-top:7px;'><table width='240' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td height='31' align='center' valign='middle' bgcolor='#003366' style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:19px; color:white;'><div style='color:white; font-size:15px;text-align:center;'><b>".date('d/m/Y')."</b></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align='center' valign='middle' style='padding-bottom:15px; padding-top:15px;'></td>
          </tr>
          <tr>
            <td align='center' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:24px; padding-bottom:5px;'>
            <tr>
            <td align='left' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:15px;'>
           		".$texto." <br /><br /><br /><br />
           		<div style='color:#003366; font-size:15px;text-align:center;'><b>Contáctenos</b></div>
             <div style='text-align:center;'>
             Centro de Gobierno, San Salvador, El Salvador C.A. 
Palacio Judicial Tel.: 2271-8888  <br />  Edificio de Oficinas Administrativas y Jurídicas Tel.:2231-8300<br>".date("Y")." csj.gob.sv
             </div><div>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align='center' valign='top'>&nbsp;</td>
  </tr>
</table>
</body>
</html>
";
return $html;
}
?>
