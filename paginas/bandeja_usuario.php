<script type="text/javascript" src="lib/alertify.js"></script>
<link rel="stylesheet" href="themes/alertify.core.css" />
<link rel="stylesheet" href="themes/alertify.default.css" />
<script src="lib/eventos.js">
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
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

$(document).ready(function(){
  //console.log($("#cmdEnviar"));
  $("#borrar").click(function(){
    var formulario = $("#CrearCuenta").serializeArray();
    $.ajax({
      type: "GET",
      dataType: 'json',
      url: "procesos/eliminarCorreo.php",
      data: formulario,
    }).done(function(respuesta){
      //$("#mensaje").html(respuesta.mensaje);
      if(respuesta.mensaje==1){
        error("Esa cuenta ya existe, no se pueden duplicar registros");
      }else if(respuesta.mensaje==2){
        ok("<br><b>Se ha creado la cuenta, un correo ha sido enviado a la cuenta personal del usuario a espera de validar dicha cuenta.</b><br>");
        document.getElementById("CrearCuenta").reset();
      }else if(respuesta.mensaje==3){
        error("Por favor complete los datos requeridos");
      }
    });
  });
});
</script>
<?php
	$consultarNot=$objSisnej->consultar_notificacion_abogado($_SESSION["ceu"]);
	$registrarIngreso=$objSisnej->registrar_ingreso($_SESSION["ceu"],date('Y-m-d H:i:s'));	
?>
<table width='100%' id="tcontainer" class="hovertable">
<?php
	while($resNot=$consultarNot->fetch(PDO::FETCH_OBJ)){
		$consultaBorrado=$objSisnej->consultar_borrados_not($resNot->idNotificacion,$_SESSION["tipo"]);
		if($consultaBorrado->rowCount()==0){
		if($resNot->Leido==1){
			$estilo='';
		}else{
			$estilo='font-weight:bold;';
		}
		$fec=strtotime($resNot->Fecha);
		$hoy=strtotime(date("d-m-Y H:i:s",time()));
		$tiempo=floor($hoy-$fec);
		$mins=floor($tiempo/60);
		$horas=floor($mins/60);
		$dia=floor($horas/24);
		$semana=floor($dia/7);
?>
	<tr style="<?php echo $estilo ?>" onmouseover="this.style.backgroundColor='#ffff66';" onmouseout="this.style.backgroundColor='#d4e3e5';">
		<td width='50%'>
			<?php 
				if($resNot->Leido==1){
			?>
				<img src="img/email_open.png" style="float:left;padding-right:15px;" />
			<?php 
				}else{ 
			?>
				<img src="img/email_new.png" style="float:left;padding-right:15px;" />
			<?php } ?>
			<?php echo "<a href='?mod=notificacion&id=".base64_encode($resNot->idNotificacion)."'>".$resNot->Asunto."</a>" ?>
		</td>
		<td width="11.35%">
			<?php 
			if($mins<60){
				echo "Hace ".round($mins)." minutos";
			}else if($mins>=60 && $horas<24){
				echo "Hace ".round($horas)." horas";
			}else if($horas>=24 && $dia<=7){
				$horas=abs(($dia*24)-$horas);
				echo "Hace ".round($dia)." d&iacute;as ";
				if($horas>0){
					echo $horas." horas";
				}
			}else if($dia>7){
				$fecha=substr($resNot->Fecha,0,10);
				$fecha2=explode("-",$fecha);
				echo $fecha2[0]." ".num2month($fecha2[1])." ".$fecha2[2];
			}
			//echo " - ".$resNot->Fecha ?></td>
		<td><?php echo $resNot->Juzgado ?></td>
		<td><?php 
			if($dia>=15){
		?>
		<a href="#" onclick="Javascript:confirmar('Realmente desea eliminar?',<?php echo $resNot->idNotificacion; ?>);">
				<img src="img/elim.png" width="24" title="Eliminar Noticia" id="eliminar" /></a>
		<!--<img src="img/elim.png" width="32" title="Eliminar Noticia" id="eliminar" /><a href='?mod=delnot&id=".base64_encode($resNot->idNotificacion)."' title='Quitar esta notificación de la bandeja'><img src='img/elim.gif' /></a>-->
		<?php
			} 
			?>
		</td>
	</tr>
<?php
	}
	}
?>
</table>
