<?php 
include("paginas/num2letras.php");
?>

<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script language="javascript" src="js/congelar.js"></script>
<script>
var objeto = false;
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
function procesaeliminar() {
// Si aun esta revisando los datos...
if (objeto.readyState == 1) {
//  document.getElementById('resultado').innerHTML = "Cargando datos con ajax...";
  notificacion("Eliminando");
  //document.getElementById('resultado').innerHTML = "<td colspan='6'><img src='img/load.gif' title='Cargando datos' width='32' />";
}
// Si el estado es 4 significa que ya termino
  if (objeto.readyState == 4) {
    // objeto.responseText trae el Resultado que metemos al DIV de arriba
    //document.getElementById('resultado').innerHTML = objeto.responseText;
    alerta(objeto.responseText);
    location.reload();
    leerDatos(document.getElementById("txtDato").value,0);
  }
}
function eliminarnot(valor) {
  crearObjeto();
  if (objeto.readyState != 0) {
    alert('Error al crear el objeto XML. El Navegador no soporta AJAX');
  } else {
    // Preparar donde va a recibir el Resultado
    objeto.onreadystatechange = procesaeliminar;
var ca=/^[ ]{1}/;
var com=ca.test(valor);
  if((!com=="") || (valor=="")){document.getElementById("resultado").innerHTML="";}else{
  // Enviar la consulta
      objeto.open("GET", "procesos/elimNot.php?id=" + valor, true);
      objeto.send(null);
  }
    
  }
}
</script>
<script type="text/javascript" language="javascript">
/*function congelar(){
  $(document).ready(function() { 
  $.blockUI({ 
	  css:{width:'100%',left:'0%',border:'none',cursor:'default',color:'black',backgroundColor:'none'},
	  message: $('#Formulario'),
   }); 
  });//fin de jquery
}*/
/*
function descongelar(){
  setTimeout($.unblockUI, 1);
}*/
</script>
<script type='text/javascript'>
	$(document).keyup(function(e) {

  if (e.keyCode == 27) { descongelar() }   // esc
});
</script>
  <style>
  label {
    display: inline-block;
    width: 5em;
  }
  </style>
<?php 
if(isset($_GET["id"])){
?>
<script type="text/javascript">congelar();</script>
<?php
}
?>
<table width='100%' id="tcontainer" style="padding-top:30px;" id='bandeja'>
<?php
	$consultarNot=$objSisnej->consultar_notificaciones($_SESSION["juzgado"]);
	$i=0;
	while($resNot=$consultarNot->fetch(PDO::FETCH_OBJ)){
		$consultaBorrado=$objSisnej->consultar_borrados_not($resNot->idNotificacion,$_SESSION["tipo"]);
			if($consultaBorrado->rowCount()==0){
				$i++;
	?>
		<tr id='<?php echo $resNot->idNotificacion ?>'>
			<td width='40%'>
			<?php //echo $resNot->idNotificacion."- ";
			echo $i ?>&nbsp;
			<a href="?mod=seguimiento&id=<?php echo base64_encode($resNot->idNotificacion) ?>"><?php echo "".$resNot->Asunto ?></td></a>
			<td width='11.35%'><?php echo $resNot->Fecha ?></td>
			<td width='16.217%' align="center">
				<?php $consultarSeg=$objSisnej->consultar_seguimiento($resNot->idNotificacion);
				$seg=$consultarSeg->fetch(PDO::FETCH_OBJ);
			 ?>
				<?php if(@$seg->Tipo=="1"){?><img width='24px' src='img/read.png' title="Leído <?php echo $seg->Fecha ?>" /><?php } ?>
			</td>
			<td width='16.217%' align="center">
			<?php 
				$fec=strtotime($resNot->Fecha);
				$hoy=strtotime(date("d-m-Y H:i:s",time()));
				$tiempo=$hoy-$fec;
				//echo $hoy." - ".$fec." = ".$tiempo;
				if($tiempo>86400){
			?>

					<a target="_blank" href='procesos/boleta.php?id=<?php echo base64_encode($resNot->idNotificacion) ?>'><img width='24px' src='img/full-time.png' /></a>
			<?php 
				} 
			?>
			</td>
			<td width='8.217%' align="center"><img title="Recibido <?php echo $resNot->Fecha ?>" width='24px' src='img/read.png'></td>
			<td width='8%' align="center">
				<?php if($tiempo>1296000){ ?>
				<a href="#" onclick="Javascript:confirmar('Realmente desea eliminar?',<?php echo $resNot->idNotificacion; ?>);">
				<img src="img/elim.png" width="24" title="Eliminar Noticia" id="eliminar" /></a>
				<?php } ?>
			</td>
		</tr>
	<?php
		}
	}
?>
</table>

<!-- IMPRIMIR BOLETA -->
<div id="Formulario" align="center" style="display:none; font-weight:bold;">
<?php 
$id=base64_decode($_GET["id"]);
$consultarNot=$objSisnej->consultar_notificacion($id);
$resNot=$consultarNot->fetch(PDO::FETCH_OBJ);
$conNotificado=$objSisnej->consultar_notificado_especifico($resNot->CEU);
$resceu=$conNotificado->fetch(PDO::FETCH_OBJ);
$leido=0;
$fecha="";
$observacion="";
$consultarSeguimiento=$objSisnej->consultar_seguimiento($id);
while($res=$consultarSeguimiento->fetch(PDO::FETCH_OBJ)){
	if($res->Tipo=="1"){
		$leido++;
		$fecha=$res->Fecha;
	}
}
//if($consultarSeguimiento->rowCount()>0){
	
//}
if($leido>0){
	if($leido==1){
		$vez="vez";
	}else{
		$vez="veces";
	}
	$observacion.=strtoupper("El mensaje ha sido leído ".num2letras($leido,true)." ".$vez." y la ultima fue el ".$fecha."<br>");
}else{
	$observacion.=strtoupper("El mensaje aun no ha sido leido<br>");
}
$consultarIngreso=$objSisnej->consultar_ingreso($resNot->CEU,$resNot->FechaEnvio);
$j=0;
while($ingreso=$consultarIngreso->fetch(PDO::FETCH_OBJ)){
	$j++;
	//echo $ingreso->Fecha;
}
//if($consultarIngreso->rowCount>0){
	//$observacion.=strtoupper("El mensaje ha sido leÍdo ".num2letras($leido)." veces y la ultima vez fue el ".$fecha." <br>");
	$observacion.=strtoupper("El usuario ingresÓ ".num2letras($j)." veces");
//}

echo "
<table width='100%' align='center'>
<tr>
	<td align='center'>
	<iframe width='100%' height='300px' src='procesos/boleta.php?id=".base64_decode($_GET["id"])."'></td>
</tr>
<tr>
	<td align='center'><a href='#' onclick='descongelar()'>Cerrar (X)</a></td>
</tr>
</table>";
?>
</div>
</body>
</html>
