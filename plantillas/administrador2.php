<?php
session_start();
include("funciones/funciones.php");
require("recortar.php");
require("seguridad.php");
ob_start();
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="estilos.css" rel="stylesheet" />
<title>.::Comunicaci&oacute;n Interna::.</title>
<script type="text/javascript">bkLib.onDomLoaded(function() {
		 new nicEditor({iconsPath : 'images/nicEditorIcons.gif'}).panelInstance('txtResumen');
		 });</script>
<script src="scripts/nicEdit.js" type="text/javascript"></script>
<!-- CALENDAR -->
<style type="text/css">
        /* some styling for the page */
        body{ font-size: 10px; }
        #content { font-size: 1.2em; /* for the rest of the page to show at a normal size */
                   font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
                   width: 950px; margin: auto;
        }
        .box { border: 1px solid #888; padding: 15px; margin:12px; font-size: 10px; }
        .code { margin: 6px; padding: 9px; background-color: #fdf5ce; border: 1px solid #c77405; }
        fieldset { padding: 0.5em 2em }
        hr { margin: 0.5em 0; clear: both }
        a { cursor: pointer; }
        #requirements li { line-height: 1.6em; }
		.form{
			font-size:15px;
		}
    </style>
<script src="js/jquery-1.8.2.js"></script>
 <link rel="stylesheet" href="js/datepicker/jquery-ui.css" />
    <script src="js/datepicker/jquery-ui.js"></script>
    <script>
    $(function() {
        $( "#txtFecha" ).datepicker();
    });
    </script>
<!-- FIN CALENDARIO -->
</head>
<body>
<table width="1024" border="0" align="center" id="content" class="tmain" style='background:#eef3fa'>
  <!--<tr>
    <td height="230" background="img/baner2.jpg" valign="top">
    </td>
  </tr>-->
  <tr>
  <td valign="top">
  <?php include("menu.php") ?>
  </tr>
<tr>
  <td align="center">
  <?php
if(isset($_SESSION["autenticado"])){
	if($_SESSION["autenticado"]=="si"){
	?>
  <table width="100%">
    <tr>
      <td width="715" align="center"><table align="center" id="infouser">
        <tr>
          <td rowspan="4"><img src='img/dato.png' alt="Usuario" width="50" /></td>
        </tr>
        <tr>
          <td>Usuario:</td>
          <td><?php 
		echo $_SESSION["Nombre"]; ?></td>
        </tr>
        <tr>
          <td>Cargo:</td>
          <td><?php echo $_SESSION["Cargo"]; ?></td>
        </tr>
      </table></td>
    </tr>
  </table></td>
	</tr>
	<tr>
	<td align="center" valign="top">
	<?php
	}
}else{
	?>
<script type="text/javascript" src="js/calendar/scripts/epoch_classes.js"></script>
<link rel="stylesheet" type="text/css" href="js/calendar/epoch_styles.css" />
<script language="JavaScript">
var objeto = false;
function procesaResultado() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
//  document.getElementById('resultado').innerHTML = "Cargando datos con ajax...";
  document.getElementById('resultado').innerHTML = "<td colspan='6'><img src='paginas/IndexCargando.gif' title='Cargando datos' width='32' />";
}
// Si el estado es 4 significa que ya termino
if (objeto.readyState == 4) {
  // objeto.responseText trae el Resultado que metemos al DIV de arriba
  document.getElementById('resultado').innerHTML = objeto.responseText;
}
}
function crearObjeto() {
  // --- Crear el Objeto dependiendo los diferentes Navegadores y versiones ---
  try { objeto = new ActiveXObject("Msxml2.XMLHTTP");  }
  catch (e) {
  try { objeto = new ActiveXObject("Microsoft.XMLHTTP"); }
  catch (E) {
  objeto = false; }
  }
  // --- Si no se pudo crear... intentar este ultimo metodo ---
  if (!objeto && typeof XMLHttpRequest!='undefined') {
    objeto = new XMLHttpRequest();
  }
}

// ------------------------------

function leerDatos(valor,sel) {
  crearObjeto();
  if (objeto.readyState != 0) {
    alert('Error al crear el objeto XML. El Navegador no soporta AJAX');
  } else {
    // Preparar donde va a recibir el Resultado
    objeto.onreadystatechange = procesaResultado;
var ca=/^[ ]{1}/;
var com=ca.test(valor);
	if((!com=="") || (valor=="")){document.getElementById("resultado").innerHTML="";}else{
	// Enviar la consulta
	    objeto.open("GET", "paginas/busqueda.php?opc="+sel+"&usuario=" + valor, true);
	    objeto.send(null);
	}
    
  }
}
function leerDatosPag(valor,sel,pag) {
  crearObjeto();
  if (objeto.readyState != 0) {
    alert('Error al crear el objeto XML. El Navegador no soporta AJAX');
  } else {
    // Preparar donde va a recibir el Resultado
    objeto.onreadystatechange = procesaResultado;
var ca=/^[ ]{1}/;
var com=ca.test(valor);
	if((!com=="") || (valor=="")){document.getElementById("resultado").innerHTML="";}else{
	// Enviar la consulta
	    objeto.open("GET", "paginas/busqueda.php?opc="+sel+"&usuario=" + valor + "&pagina="+pag, true);
	    objeto.send(null);
	}
    
  }
}
// ------------------------------
</script>
<table align='center' width="80%">
</table>
    <?php
	}
	?>
</td>
</tr>
  <tr>
    <td width="100%" height="24" valign="top"><div class="middle">
    <?php 
		include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
	?>	
    </div></td>
  </tr>
  <tr>
    <td valign="bottom">
    <div class="footer">
    <?php 
		include("footer.php");
	?>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
ob_end_flush();
?>