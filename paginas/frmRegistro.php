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
    var terminos="";
    var ter=false;
    var cdui="";
    var cemail="";
    var ccel="";
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
      if(frm.elements[i].type=="checkbox"){
        if(frm.elements[i].checked==false){
          ter=true;
          terminos="Debe aceptar los t&eacute;rminos y condiciones";
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
    }else if(ter){
      alerta("Debe aceptar los terminos y condiciones");
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
        url: "procesos/guardarRegistro.php",
        data: formulario,
      }).done(function(respuesta){
        //$("#mensaje").html(respuesta.mensaje);
        if(verificarVacios("CrearCuenta")){
          if(respuesta.mensaje==1){
            error("Esa cuenta ya existe, no se pueden duplicar registros");
          }else if(respuesta.mensaje==2){
            ok("Su registro ha sido procesado exitosamente, un correo ha sido enviado a su cuenta personal. "+codigo);
            document.getElementById("CrearCuenta").reset();
          }else if(respuesta.mensaje==3){
            error("Por favor complete los datos requeridos");
          }else if(respuesta.mensaje==5){
            error("No se pudo enviar el correo");
          }
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
<form name="crearCuenta" id="CrearCuenta">
<!--<form name="crearCuenta" id="CrearCuenta">-->
<table width="100%" border="0" align="center">
  <tr>
    <td colspan="2" align="center">
      <img src="img/CSJ.png" style="padding-right:10px;" />
      <h3>
          CORTE SUPREMA DE JUSTICIA<br />
          SOLICITUD DE REGISTRO DE CUENTA ELECTRÓNICA ÚNICA (CEU)<br />
          SISTEMA DE NOTIFICACIÓN ELECTRÓNICA JUDICIAL (SNE)
      </h3>
    </td>
  </tr>
  <tr>
    <th align="right">Nombre:</th>
    <td><input type="text" style="" name="txtNombre" id="txtNombre" maxchar="150" size="50" title="Nombre completo" required /></td>
  </tr>
  <tr>
    <th align="right">Número de carné de abogado:</th>
    <td><input type="number" name="txtCarne" id="txtCarne" maxchar="150" min="0" title="Numero de carnet" required /></td>
  </tr>
  <tr>
    <th align="right">Fecha de expedición:</th>
    <td><input type="text" name="txtFechaExp" id="txtFechaExp" class="date" maxchar="150" readonly='readonly' title="Fecha de expedicion" /></td>
  </tr>
  <tr>
    <th align="right">Número de acuerdo de autorización:</th>
    <td><input type="text" name="txtAcuerdo" id="txtAcuerdo" min="0" maxchar="150" title="Numero de acuerdo" required /></td>
  </tr>
  <tr>
    <th align="right">Fecha de acuerdo:</th>
    <td><input type="text" name="txtFechaAcuerdo" id="txtFechaAcuerdo" class="date" maxchar="50"  readonly='readonly' title="Fecha de acuerdo" /></td>
  </tr>
  <tr>
    <th align="right">Número de DUI:</th>
    <td><input type="text" name="txtDUI" id="txtDUI" maxchar="10" title="DUI" required /></td>
  </tr>
  <tr>
    <th align="right">Nombre según DUI:</th>
    <td><input type="text" name="txtNombreDUI" id="txtNombreDUI" maxchar="150" size="50" title="Nombre DUI" required /></td>
  </tr>
  <tr>
    <th align="right">Dirección:</th>
    <td><textarea cols="40" name="txtDireccion" title="Direccion" required></textarea></td>
  </tr>
  <tr>
    <th align="right">Departamento:</th>
    <td>
    <?php
	function generaPaises()
	{
		$objSisnej=new Sisnej;
		$departamentos=$objSisnej->consultar_departamentos();
		/*include 'conexion.php';
		conectar();
		$consulta=mysql_query("SELECT id, opcion FROM lista_paises");
		desconectar();*/
	
		// Voy imprimiendo el primer select compuesto por los paises
		echo "<select name='paises' id='paises' onChange='cargaContenido(this.id)' title='Departamento'>";
		echo "<option value='0'>Elige</option>";
		while($row=$departamentos->fetch(PDO::FETCH_OBJ))
		{
			?>
			<option value="<?php echo $row->IdDepto ?>"><?php echo $row->DESCRIPCIO ?></option>
            <?php
		}
		echo "</select>";
	}
	?>
   <div id=""><?php generaPaises(); ?></div></td>
    </tr>
    <tr><th align="right">Municipio:</th><td>
    <div id="">
        <div id="">
            <select readonly="readonly" name="estados" id="estados" title="Municipio">
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
    <td><input type="email" name="txtEmail" id="txtEmail" maxchar="100" required title="Correo Eletronico Personal" /></td>
  </tr>
  <tr>
    <th align="right">Teléfono móvil:</th>
    <td><input type="text" name="txtMovil" id="txtMovil" maxchar="10" title="Telefono movil" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="checkbox" name="terminos" id="terminos" title="Terminos" />Acepto los t&eacute;rminos y condiciones del servicio. <a href='?mod=terminos' onClick="window.open(this.href, this.target, 'width=500,height=600'); return false;">Ver los t&eacute;rminos y condiciones.</a></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="button" name="cmdEnviar" id="cmdEnviar" value="Crear Cuenta" /></td>
  </tr>
  <tr>
    <td><div id="error"></div></td>
  </tr>
</table>
</form>