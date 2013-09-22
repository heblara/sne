<?php
include_once ('../DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('../sisnej.class.php');
?>
<style type="text/css">
	.title{
		background-color: silver;
	}
</style>
<?php
//include("conexion.php");
if (isset($_GET["usuario"])) {
  //tiempo de espera 
  sleep(1);
  // Enviar la consulta para ver si el USUARIO recibido existe
  $consulta="SELECT * FROM usuario WHERE Usuario LIKE'%".$_GET["usuario"]."%' order by idUser";
  $objBuscar=new Sisnej;
  $con1=$objBuscar->consultar_usuarios($consulta);
  $total=$con1->rowCount();	
  echo $total;
  if ($total > 0) { 
  echo "<table align='left' width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'";
  echo "<tr>
  <th class='title' colspan='5' width='5%'>Numero</th>
  <th class='title' width='40%'>Nombre</th>";
  echo "<th class='title' width='30%'>Cargo</th><th class='title'>Opcion</th></tr>";
  $i=0;
  while($row=$con1->fetch(PDO::FETCH_OBJ)){
  	$i++;
  	if($i%2==0){
		$estilo="background-color:silver;color:black;";
	}else{
		$estilo="background-color:white;color:black;";
	}
	$cargo=strtoupper($row->TipoUsuario);
	if($cargo=="ADMINCEU"){
		$cargo="Administrador de Cuenta ElectrÓnica Única";
	}
	  echo "<tr><td colspan='5' style='$estilo'>".$i."</td>";
	  echo "<td align='center' style='$estilo'>".$row->Usuario."</td>";
	  if(isset($cargo)){
	  	echo "<td align='center' style='$estilo'>".utf8_encode(strtoupper($cargo))."</td>";
  	  }else{
		  echo "<td style='$estilo'>&nbsp;</td>";
	  }
	  echo "<td align='center' style='$estilo'>
	  <a href='?mod=updateUser&id=".base64_encode($row->idUser)."'>
	  <img src='img/edit.png' width='32' title='Modificar datos del usuario' />
	  </a>
	  <a href='?mod=resetPwdUser&id=".base64_encode($row->idUser)."'>
	  <img src='img/reset.png' width='32' title='Resetear contrase&ntilde;a de este usuario' /></a></td>";
	  /*echo "<td align='center'>";
	  echo "<a href='#'>Seleccionar</a>";
	  echo "</td>";*/
	  echo "</tr>";
  }
  echo "</table>";
  }//fin de if que verifica que existan datos
  else { ?>
 <center><b style="font:Verdana, Arial, Helvetica, sans-serif:; font-size:12px;">No hay datos</b></center><?php }
  exit();
}

?>