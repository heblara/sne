<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ingreso de la votacion</title>
<link href="estilos.css" rel="stylesheet" />
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script language="javascript" src="../js/congelar.js"></script>
<script type="text/javascript" language="javascript">
function congelar(){
  $(document).ready(function() { 
  $.blockUI({ 
  css:{width:'100%',left:'0%',border:'none',cursor:'default',color:'black',backgroundColor:'none'},
  message: $('#Formulario'),
  overlayCSS:{opacity:0.7}
   }); 
  });//fin de jquery
}
function descongelar(){
  setTimeout($.unblockUI, 1);
}
</script>
</head>
<body onload="document.frmNit.txtNit.focus()">
<table width="416" height="273" border="0" align="center" onclick="document.getElementById('opcion1').focus()">
  <tr>
    <td height="41" align="center"><img src="img/Baner.jpg" /></td>
  </tr>
  <tr>
  <td>
    <div id="divNombre" align="center"></div>
    <div id='divPregunta'>
    <form id='votacion' name='votar' action='guardarVoto.php' method='post'  onsubmit='return validarFormulario();'>
    <table width='83%' border='0' align='center'>
      <tr>
      	<td><H1>RESPONDA LA SIGUIENTE PREGUNTA.</H1></td>
      </tr>
      <tr>
        <td height='95' align='center'><p><?php
    		include("conexion.php");
    		$utf8=mysql_query("SET NAMES 'utf8'");
    		$consultarPregunta=mysql_query("select * from Pregunta");
    		while($res=mysql_fetch_assoc($consultarPregunta)){
    			echo "<div id='pregunta'><b>".$res["Pregunta"]."</b></div>";
    		}
		?></p></td>
        </tr>
        <tr>
        <td align='center'>
        <table align='center' cellspacing='25' cellpadding='5'>
        <tr>
        <td align='center'><img src='img/like.gif' width='40' /><br />
        <input type='radio' name='opcion' id='opcion1' value='1'/></td>
        <td align='center'><img width='40' src='img/dislike.gif' /><br />
        <input type='radio' name='opcion' id='opcion2' value='2'/></td>
        <td align='center'><img width='40' src='img/unknown.gif' /><br />
        <input type='radio' name='opcion' id='opcion3' value='3'/>
        <input type="hidden" name="txtNitP" id="txtNitP"/>
        <input type="hidden" name="txtOpcion" id="txtOpcion"/>
        </td>
        </tr>
        </table>
        </td>
        </tr>
      <tr>
        <input type="button" value="Congelar" onclick="congelar()">
        <td align='center'><p><input type='image' name='cmdVotar' value='Votar' src='img/votar.jpg' />
        </p></td>
      </tr>
    </table>
    </form>
    </div>
    
</td>
  </tr>
  <tr>
    <td height="116">
    
    </td>
  </tr>
  <tr>
    <td height="71" align="center" valign="top"><img src="img/Footer.jpg" alt="" width="800" height="80" /></td>
  </tr>
</table>

<!--FORMULARIO DE CARGA-->
<div id="Formulario" align="center" style="display:none; font-weight:bold;">
    <form name="frmNIT" id="frmNIT" onsubmit="return false;">
    <table border="0" width="45%">
    <tr>
    <td colspan="2" align="right">Ingrese el numero de NIT (Sin Guiones)</td>
    <td>
    <input type="text" maxlength="14" id="txtNit" name="txtNit" onkeypress="return numNit(event,this.value)" onkeyup="cargarNombre(this.value)"/>
    </td>
    </tr>
    </table>
    <input type="button" value="Descongelar" onclick="descongelar()">
    </form>
    <div id="cargarNombre"></div>
    </div>
</body>
</html>