<?php 
include("funciones/funciones.php");
date_default_timezone_set('America/Chicago'); 
session_start();
?>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Corte Suprema de Justicia</title>
<link href="estilos.css" rel="stylesheet" type="text/css" />
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
            <td align='center' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:48px;'><img src='img/CSJ.png' /><br /><i>Corte Suprema de Justicia</i></td>
          </tr>
          <tr>
            <td align='center' valign='middle' style='padding-top:7px;'><table width='240' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td height='31' align='center' valign='middle' bgcolor='#003366' style='font-family:Georgia, 'Times New Roman', Times, serif; font-size:19px; color:white;'><div style='color:white; font-size:15px;text-align:center;'><b><?php echo date('d/m/Y') ?></b></div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align='center' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:24px; padding-bottom:5px;'>
            <tr>
            <td align='left' valign='middle' style='font-family:Georgia, 'Times New Roman', Times, serif; color:#000000; font-size:15px;'>
              <?php 
                include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
            ?>   <br /><br /><br /><br />
<div>
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