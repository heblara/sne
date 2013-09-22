<script type="text/javascript" src="lib/alertify.js"></script>
<link rel="stylesheet" href="themes/alertify.core.css" />
<link rel="stylesheet" href="themes/alertify.default.css" />
<script src="lib/eventos.js">
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
$(document).ready(function(){					
$("#btnCambiar").click(function(){
	var formulario = $("#frmCambiarContra").serializeArray();
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: "procesos/procesoFrmCambiarContra.php",
		data: formulario,
	}).done(function(respuesta){
		//$("#mensaje").html(respuesta.mensaje);
		//alerta(respuesta.mensaje);
		if(respuesta.mensaje==1){
			ok("Contraseña cambiada");
		}else if(respuesta.mensaje==2){
			error("No fue posible actualizar la contraseña");
		}else if(respuesta.mensaje==3){
			error("La contraseña actual es invalida");
		}else{
			error(respuesta.mensaje);
		}
	});
});
});
</script>
<div id="divCon" align="center">
<!--
<form name="frmCambiarContra" id="frmCambiarContra" action='?mod=cambiarPwd' method="post">
-->
<form name="frmCambiarContra" id="frmCambiarContra">
<table cellpadding="1" cellspacing="4" border="0" class="tAgregar" align="center">
<caption><h1>Cambiar contrase&ntilde;a</h1></caption>
<tr>
<td>Contrase&ntilde;a actual</td>
<td><input type="password" name="txtContraActual" id="txtContraActual" class="inputText" maxlength="25" size="25" placeholder="••••••••••••••••••"></td>
<td><div id="errortxtContraActual"></div></td>
</tr>
<tr>
<td>Contrase&ntilde;a nueva</td>
<td><input type="password" name="txtContraNueva" id="txtContraNueva" class="inputText" maxlength="25"  size="25" placeholder="••••••••••••••••••"></td>
<td><div id="errortxtContraNueva"></div></td>
</tr>
<tr>
<td>Confirmacion de contrase&ntilde;a</td>
<td><input type="password" name="txtContraConfir" id="txtContraConfir" class="inputText" maxlength="25"  size="25" placeholder="••••••••••••••••••"></td>
<td><div id="errortxtContraConfir"></div></td>
</tr>
<td><input type="button" name="btnCambiar" id="btnCambiar" value="Cambiar"></td>
</table>
</form>
</div>
<div class="error" align="center" id="divError"></div>