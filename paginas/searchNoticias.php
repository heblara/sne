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

<script type='text/javascript' language='Javascript'>
function seleccionar(){
	/*document.getElementById("cargarCaja").style="display:none;";
	document.getElementById("fecha").style.diplay="none";*/
	var tipo=document.buscar.lstTipo.options[document.buscar.lstTipo.selectedIndex].value;
	//document.getElementById("txtFecha").style="display:none;";
	document.getElementById("fecha").style.display="none";
	if(tipo==1){
		document.getElementById("cargarCaja").innerHTML="&nbsp;&nbsp;Titular:<input type='search' id='txtTitular' name='txtTitular' onkeyup='leerDatos(this.value,document.buscar.lstTipo.options[document.buscar.lstTipo.selectedIndex].value);' />";
	}else if(tipo==2){
		document.getElementById("cargarCaja").innerHTML="";
		document.buscar.txtFecha.value="";
		document.getElementById("fecha").style.display="";
	}else{
		document.getElementById("cargarCaja").innerHTML="&nbsp;&nbsp;Texto:<input type='search' id='txtDato' name='txtDato' onkeyup='leerDatos(this.value,document.buscar.lstTipo.options[document.buscar.lstTipo.selectedIndex].value);' />";
	}
}
</script>
<br />
<br />
<form name="buscar">
<table align='center' width="80%">
<tr>
<td>Elegir tipo de busqueda:</td>
<td>
<select name='lstTipo' onchange='seleccionar()'>
<option value='0'>Todo</option>
<option value='1'>Por Titulo</option>
<option value='2' selected>Por fecha</option>
</select>
</td>
<td>
<div id="cargarCaja"></div>
<div id="fecha" style='display:;'>
Fecha: 
<input id='txtFecha' name='txtFecha' readonly />
<input type='button' value='Enviar' onClick="leerDatos(document.buscar.txtFecha.value,document.buscar.lstTipo.value);">
</div>
</td>
</tr>
<tr><th colspan="6"><div id="resultado" style='background:silver;'></div></th></tr>
</table>
</form>