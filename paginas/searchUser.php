<script type="text/javascript" src="js/calendar/scripts/epoch_classes.js"></script>
<link rel="stylesheet" type="text/css" href="js/calendar/epoch_styles.css" />
<script language="JavaScript">

var objeto = false;
function procesaResultado() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
//  document.getElementById('resultado').innerHTML = "Cargando datos con ajax...";
  document.getElementById('resultado').innerHTML = "<td colspan='6'><img src='img/load.gif' title='Cargando datos' width='32' />";

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

function leerDatos(valor) {
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
	    objeto.open("GET", "paginas/busquedaUsuario.php?usuario=" + valor, true);
	    objeto.send(null);
	}
  }
}
// ------------------------------
</script>

</head>
<body>
<br />
<br />
<form name="buscar">
<table align='center' width="80%">
<caption style="padding-bottom:10px;"><h1>BUSQUEDA DE USUARIOS</h1><hr /></caption>
<tr align="center">
<td>Nombre del usuario:</td>
<td>
<input type='search' placeholder='Digite el nombre o usuario a buscar' name='txtMag' id='txtMag' onkeyup='leerDatos(document.buscar.txtMag.value);' size="100" /> 
</td>
<td>
<div id="cargarCaja"></div>
</td>
</tr>
<tr><th colspan="6"><div id="resultado" style='background:silver;'></div></th></tr>
</table>
</form>