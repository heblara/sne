<script language="JavaScript">
var objeto = false;
function procesaResultado() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
//  document.getElementById('resultado').innerHTML = "Cargando datos con ajax...";
  document.getElementById("rowRes").style.display="";
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
	    objeto.open("GET", "paginas/busquedaCEU.php?opc="+sel+"&usuario=" + valor, true);
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
	    objeto.open("GET", "paginas/busquedaCEU.php?opc="+sel+"&usuario=" + valor + "&pagina="+pag, true);
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
<h1>BUSQUEDA DE CUENTAS ELECTRÓNICAS ÚNICAS</h1><br /><br />
<form name="buscar">
<table align='center' width="100%">
<tr>
<!--<td>Elegir tipo de busqueda:</td>
<td>
<select name='lstTipo' onchange='seleccionar()'>
<option value='0'>Todo</option>
<option value='1'>Por Titulo</option>
<option value='2' selected>Por fecha</option>
</select>
</td>
<td>-->
<!--<div id="cargarCaja"></div>-->
<div id="fecha" style='display:;'>
Texto a buscar:&nbsp;&nbsp;&nbsp;
<input type='search' id='txtDato' name='txtDato' onkeyup='leerDatos(this.value,0);' size="100" placeholder="Digite el texto a buscar (Nombre, Número de carnet, CEU)" />
<!--<input id='txtFecha' name='txtFecha' readonly />
<input type='button' value='Enviar' onClick="leerDatos(document.buscar.txtFecha.value,document.buscar.lstTipo.value);">-->
</div>
</td>
</tr>
<tr>
  <th colspan="6" style="display:none;" id="rowRes"><div id="resultado" style='background:silver;width:100%;'></div></th>
</tr>
<style type="text/css">
  @import url("estilos.css");
</style>
<?php
//include("conexion.php");
ob_start();
//echo "<a style='text-align:left;' title='Cerrar esta ventana' href='#' onclick=\"document.getElementById('resultado').style.display='none'\"><img src='img/elim.png' width='16' /></a><br>";
@session_start();
//$condicion=" AND idNotificador=".$_SESSION["juzgado"]." ";
$mod="modificarcuenta";
$condicion="";
/*if(isset($_SESSION["privilegio"])){
  if($_SESSION["privilegio"]=="DIG"){
    $condicion=" AND Usuario='".$_SESSION["user"]."' ";
    $mod="modificarNoticiaD";
  }else{
    $condicion="";
    $mod="modificarNoticia";
  }
}*/ 
$opc="";
$objBuscar=new Sisnej;
  $consulta="SELECT * FROM ceu ORDER BY CEU ASC";
  //echo $consulta;
//echo $consulta;
$tamanopag=10;
$pagina=1;
$inicio=0;
if(isset($_GET["pagina"])){
  if($_GET["pagina"]>1){
    $pagina=$_GET["pagina"];
    $inicio=($pagina - 1)*$tamanopag;
  }else{
    $inicio = 0;
    $pagina=1;
  }
}
$con1=$objBuscar->buscarNoticias($consulta);
$total=$con1->rowCount();
$limit=" limit " .$inicio.",".$tamanopag;
$total_paginas = ceil($total / $tamanopag);
//echo "Se muestran paginas de " . $tamanopag . " registros cada una<br>"; 
echo "P&aacute;gina " . $pagina . " de " . $total_paginas . "";
$con2=$objBuscar->buscarNoticias($consulta.$limit);
$total=$con2->rowCount();
  if ($total > 0) { 
  echo "<table align='center' width='100%'>";
    echo "<tr>";
  echo "<td colspan='13' align='center'>";
  if ($total_paginas > 1){ 
      echo "Paginas: ";
      for ($i=1;$i<=$total_paginas;$i++){ 
         if ($pagina == $i) {
           //si muestro el índice de la página actual, no coloco enlace 
           echo "&nbsp;".$pagina . "&nbsp;"; 
         }else {
           //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
           ?>
                     &nbsp;
            <a href="?mod=buscarceu&pagina=<?php echo $i ?>"><?php echo $i; ?></a>
                     <?php
         }
      } 
    }
    echo "</td></tr>"; 
  echo "<tr><th class='title' colspan='5' width='20%'>CEU</th>
  <th class='title' width='30%'>Nombre</th>";
  echo "<th class='title' width='20%'>Carne de Abogado</th>
  <th class='title' width='20%'>DUI</th>
  <th class='title'>Opcion</th></tr>";
  $i=0;
  while($row=$con2->fetch(PDO::FETCH_OBJ)){
    $i++;
    //echo "Not ".$row->IdNotificacion;
    if($i%2==0){
    $estilo="background-color:silver;color:black;";
  }else{
    $estilo="background-color:white;color:black;";
  }
    echo "<tr><td colspan='5' style='$estilo'>".$row->CEU."</td><td style='$estilo'>".$row->Nombre."</td>";
    echo "<td align='center' style='$estilo'>".$row->Carne."</td>";
    echo "<td align='center' style='$estilo'>".$row->DUI."</td>";
    if(isset($_SESSION["autenticado"])){
      if($_SESSION["autenticado"]=="si"){
      echo "<td align='center' style='$estilo'><a href='?mod=".$mod."&id=".base64_encode($row->CEU)."'><img src='img/edit.png' width='32' title='Editar usuario' /></a>&nbsp;&nbsp;&nbsp;";
          ?>
        <a onclick="Javascript:var opc=confirm('Realmente desea deactivar al usuario?');if(opc){location.href='?mod=elimCEU&id=<?php echo base64_encode($row->CEU); ?>'}"><img src="img/delete.png" width="20" title="Eliminar Usuario" /></a></td>
          <?php  
      }
    }
    /*echo "<td align='center'>";
    echo "<a href='#'>Seleccionar</a>";
    echo "</td>";*/
    echo "</tr>";
  }
  echo "<tr>";
  echo "<td colspan='13' align='center'>";
  if ($total_paginas > 1){ 
      echo "Paginas: ";
      for ($i=1;$i<=$total_paginas;$i++){ 
         if ($pagina == $i) {
           //si muestro el índice de la página actual, no coloco enlace 
           echo "&nbsp;".$pagina . "&nbsp;"; 
         }else {
           //si el índice no corresponde con la página mostrada actualmente, coloco el enlace para ir a esa página 
           ?>
                     &nbsp;
            <a href="?mod=buscarceu&pagina=<?php echo $i ?>"><?php echo $i; ?></a>
                     <?php
         }
      } 
    }
    echo "</td></tr>";  
  echo "</table>";
  }//fin de if que verifica que existan datos?>
 <?php
  exit();
ob_end_flush();
?>
</table>
</form>