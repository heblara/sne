<?php 
if(isset($_GET["id"])){
  $id=base64_decode($_GET["id"]);
  $objSisnej=new Sisnej;
  $consultarCuenta=$objSisnej->consultar_ceu($id);
  $cuenta=$consultarCuenta->fetch(PDO::FETCH_OBJ);
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
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
<form name="crearCuenta" id="CrearCuenta" method="post" action="?mod=actualizarCuenta">
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
            <select disabled="disabled" name="estados" id="estados">
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