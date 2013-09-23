<?php 
if(isset($_GET["id"])){
  $id=base64_decode($_GET["id"]);
  $objSisnej=new Sisnej;
  $consultarCuenta=$objSisnej->consultar_ceu($id);
  $cuenta=$consultarCuenta->fetch(PDO::FETCH_OBJ);
?>
<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
function validarDUI(dui){
  var regex = /^\d{8}-\d$/;
  return regex.test(dui);
}
function validarEmail(email){
  var regex = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
  return regex.test(email);
}
function validarCel(cel){
  var regex = /^[1-9]{1}[0-9]{3}-[0-9]{4}$/;
  return regex.test(cel);
}
  function verificarVacios(form){
    var sAux="";
    var frm = document.getElementById(form);
    //alerta(document.getElementById("crearCuenta").elements[2].value);
    var vacio=false;
    var numero=false;
    var cdui="";
    var cemail="";
    for (i=0;i<frm.elements.length;i++)
    {
      /*sAux += "NOMBRE: " + frm.elements[i].name + " ";
      sAux += "TIPO :  " + frm.elements[i].type + " ";*/
      if(frm.elements[i].value=="" || frm.elements[i].value==0){
        sAux += "*" + frm.elements[i].title + "<br>" ;
        vacio=true;
      }
      if(frm.elements[i].type=="number"){
        numero=true;
        if(isNaN(frm.elements[i].value)){
          sAux += "* Campos de: Numero de Acuerdo, y Carnet solo deben contener numeros<br>" ;
        }
      }
      if(frm.elements[i].name=="txtDUI"){
        var dui=validarDUI(frm.elements[i].value);
        if(!dui){
          cdui="* Formato de DUI es incorrecto<br>";
        }
      }
      if(frm.elements[i].name=="txtEmail"){
        var email=validarEmail(frm.elements[i].value);
        if(!email){
          cemail="* Formato de Correo es incorrecto<br>";
        }
      }
      if(frm.elements[i].name=="txtMovil"){
        var cel=validarCel(frm.elements[i].value);
        if(!cel){
          ccel="Formato de numero movil invalido<br>";
        }
      }
    }
    /*document.getElementById("error").innerHTML="Verifique los siguientes campos: ".sAux;*/
    if(vacio==true){
      alerta("Por favor revise los siguientes campos:<br>"+sAux);
      return false;
    }else if(!dui){
      alerta("Formato de DUI es incorrecto");
      return false;
    }else if(!email){
      alerta(cemail);
      return false;
    }else if(!cel){
      alerta(ccel);
      return false;
    }else{
      return true;
    }
  }
</script>
<script>
$(document).ready(function(){
  //console.log($("#cmdEnviar"));
  $("#cmdEnviar").click(function(){
    var formulario = $("#CrearCuenta").serializeArray();
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "procesos/guardarCuenta.php",
      data: formulario,
    }).done(function(respuesta){
      //$("#mensaje").html(respuesta.mensaje);
      if(respuesta.mensaje==1){
        error("Esa cuenta ya existe, no se pueden duplicar registros");
      }else if(respuesta.mensaje==2){
        ok("<br><b>Se ha creado la cuenta, un correo ha sido enviado a la cuenta personal del usuario a espera de validar dicha cuenta.</b><br>");
      }else if(respuesta.mensaje==3){
        error("Por favor complete los datos requeridos");
      }
    });
  });
});
</script>
 <script>
  var date=new Date();
  $(function() {
    $( ".date" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showWeek: true,
      dateFormat: 'yy-mm-dd',
      yearRange: '1950:'+date.getFullYear()
    });
    /*$( "#txtFechaAcuerdo" ).datepicker({
      changeMonth: true,
      changeYear: true,
      showWeek: true,
      dateFormat: 'yy-mm-dd'
    });*/
  });
  </script>
<!-- FIN CALENDARIO -->
<link rel="stylesheet" type="text/css" href="select_dependientes.css">
<script type="text/javascript" src="select_dependientes.js"></script>
<form name="crearCuenta" id="CrearCuenta" method="post" action="?mod=actualizarCuenta" onsubmit="return validarVacios();">
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="2" align="center"><h3>
      CORTE SUPREMA DE JUSTICIA<br />
      DEPARTAMENTO DE INFORMÁTICA<br />
      FORMULARIO DE REGISTRO DE CUENTA ELECTRÓNICA ÚNICA (CEU)<br />
    SISTEMA DE NOTIFICACIÓN ELECTRÓNICA JUDICIAL (SISNEJ)</h3></td>
  </tr>
  <tr>
    <th align="right">Nombre:</th>
    <td><input type="text" name="txtNombre" id="txtNombre" maxchar="150" size="50" title="Ingrese el nombre del abogado" value="<?php echo $cuenta->Nombre ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Número de carné de abogado:</th>
    <td><input type="number" name="txtCarne" id="txtCarne" maxchar="150" min="0" value="<?php echo $cuenta->Carne ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Fecha de expedición:</th>
    <td><input type="text" name="txtFechaExp" id="txtFechaExp" class="date" maxchar="150" readonly='readonly' value="<?php echo $cuenta->FechaExpedicion ?>"  /></td>
  </tr>
  <tr>
    <th align="right">Número de acuerdo de autorización:</th>
    <td><input type="number" name="txtAcuerdo" id="txtAcuerdo" min="0" maxchar="150" value="<?php echo $cuenta->NoAcuerdo ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Fecha de acuerdo:</th>
    <td><input type="text" name="txtFechaAcuerdo" id="txtFechaAcuerdo" class="date" maxchar="50" value="<?php echo $cuenta->FechaAcuerdo ?>" readonly='readonly' /></td>
  </tr>
  <tr>
    <th align="right">Número de DUI:</th>
    <td><input type="text" name="txtDUI" id="txtDUI" maxchar="10" value="<?php echo $cuenta->DUI ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Nombre según DUI:</th>
    <td><input type="text" name="txtNombreDUI" id="txtNombreDUI" maxchar="150" size="50" value="<?php echo $cuenta->NombreDUI ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Dirección:</th>
    <td><textarea cols="40" name="txtDireccion" required><?php echo $cuenta->Direccion ?></textarea></td>
  </tr>
  <tr>
    <th align="right">Departamento:</th>
    <td>
    <?php
	function generaPaises($dep=0,$mun=0)
	{
		$objSisnej=new Sisnej;
		$departamentos=$objSisnej->consultar_departamentos();
		/*include 'conexion.php';
		conectar();
		$consulta=mysql_query("SELECT id, opcion FROM lista_paises");
		desconectar();*/
	
		// Voy imprimiendo el primer select compuesto por los paises
		echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
		echo "<option value='0'>Elige</option>";
		while($row=$departamentos->fetch(PDO::FETCH_OBJ))
		{
			?>
			<option value="<?php echo $row->IdDepto ?>" <?php if($row->IdDepto == $dep){ echo "selected"; } ?>><?php echo $row->DESCRIPCIO ?></option>
            <?php
		}
		echo "</select>";
	}
	?>
   <div id=""><?php 
   $departamentos=$objSisnej->consultar_departamentos();
    /*include 'conexion.php';
    conectar();
    $consulta=mysql_query("SELECT id, opcion FROM lista_paises");
    desconectar();*/
  
    // Voy imprimiendo el primer select compuesto por los paises
    echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)'>";
    echo "<option value='0'>Elige</option>";
    while($row=$departamentos->fetch(PDO::FETCH_OBJ))
    {
      ?>
      <option value="<?php echo $row->IdDepto ?>" <?php if($row->IdDepto == $cuenta->IdDepartamento){ ?> selected <?php } ?>><?php echo $row->DESCRIPCIO ?></option>
            <?php
    }
    echo "</select>";
   //generaPaises($cuenta->IdDepartamento,""); ?>
   <script type="text/javascript">
      document.getElementById('paises').onChange=cargaContenido('paises');
      </script>
   <script type="text/javascript">
   //alert(<?php echo $cuenta->IdDepartamento ?>);
   </script>
    </tr>
    <tr><th align="right">Municipio:</th><td>
    <div id="">
        <div id="">
            <select readonly="readonly" name="estados" id="estados">
                <option value="0">Selecciona opci&oacute;n...</option>
            </select>
        </div>
    </div>
    <!--<select name='lstDepto' id="lstDepto">
    <?php 
	/*$objSisnej=new Sisnej;
	$departamentos=$objSisnej->consultar_departamentos();
	while($row=$departamentos->fetch(PDO::FETCH_OBJ)){
	?>
    <option value="<?php echo $row->IdDepto ?>"><?php echo $row->DESCRIPCIO ?></option>
    <?php	
	}*/
	?>
    </select>--></td>
  </tr>
  <tr>
    <th align="right">Correo Electrónico Personal:</th>
    <td><input type="email" name="txtEmail" id="txtEmail" maxchar="100" readonly="readonly" value="<?php echo $cuenta->Email ?>" required /></td>
  </tr>
  <tr>
    <th align="right">Teléfono móvil:</th>
    <td><input type="text" name="txtMovil" id="txtMovil" maxchar="10" value="<?php echo $cuenta->Movil ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="cmdEnviar" id="cmdEnviar" value="Guardar cambios" /></td>
  </tr>
</table>
</form>
<?php 
}else{
  header("Location:?mod=crearcuenta");
}
?>