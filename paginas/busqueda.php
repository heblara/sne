<?php 
ob_start();
session_start(); ?>
<?php
include_once ('../DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('../sisnej.class.php');
//include("conexion.php");
//echo "<a style='text-align:left;' title='Cerrar esta ventana' href='#' onclick=\"document.getElementById('resultado').style.display='none'\"><img src='img/elim.png' width='16' /></a><br>";
$condicion=" AND idNotificador=".$_SESSION["juzgado"]." ";
$mod="seguimiento";
if(isset($_SESSION["privilegio"])){
	if($_SESSION["privilegio"]=="DIG"){
		$condicion=" AND Usuario='".$_SESSION["user"]."' ";
		$mod="modificarNoticiaD";
	}else{
		$condicion="";
		$mod="modificarNoticia";
	}
}
if (isset($_GET["usuario"])) { 
sleep(1);
$_GET["usuario"];
$opc=$_GET["opc"];
$objBuscar=new Sisnej;
//$condicion=" AND (SELECT COUNT(*) FROM borrados b WHERE b.idNotificacion=n.idNotificacion)  = 0 ";
if($_GET["opc"]=="2"){
  $consulta="SELECT * FROM notificacion WHERE Fecha='".$_GET["usuario"]."'".$condicion."ORDER BY Fecha DESC";
  }
else if($_GET["opc"]=="1"){ //Busqueda por titular
  $consulta="SELECT * FROM notificacion WHERE Contenido LIKE'%".$_GET["usuario"]."%'".$condicion."order by Fecha DESC";
}
if($_GET["opc"]=="0"){
	$consulta="SELECT *,DATE_FORMAT(FechaEnvio,'%d-%m-%Y') as Fecha FROM notificacion AS n WHERE CEU LIKE'%".$_GET["usuario"]."%' OR Contenido LIKE'%".$_GET["usuario"]."%' OR Asunto LIKE'%".$_GET["usuario"]."%' OR FechaEnvio LIKE'%".$_GET["usuario"]."%'".$condicion." ORDER BY FechaEnvio DESC";
//	echo $consulta;
}
echo $consulta;
$tamanopag=15;
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
echo $total." notificaciones encontradas<br>";
//echo "Se muestran paginas de " . $tamanopag . " registros cada una<br>"; 
echo "P&aacute;gina " . $pagina . " de " . $total_paginas . "";
$con2=$objBuscar->buscarNoticias($consulta.$limit);
$total=$con2->rowCount();
  if ($total > 0) { 
  echo "<table align='center' width='100%' style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px'>";
  echo "<tr>";
  echo "<td colspan='13'>";
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
					 <a href="#" onclick="leerDatosPag('<?php echo $_GET["usuario"] ?>',<?php echo $opc ?>,<?php echo $i ?>)"><?php echo $i; ?></a>&nbsp;
                     <?php
				 }
			} 
		}	  
  echo "</td>";
  echo "</tr>";
  echo "<tr><th class='title' colspan='5' width='20%'>Fecha</th><th class='title' width='40%'>Titular</th>";
  echo "<th class='title' width='30%'>Destinatario</th><th class='title'>Opcion</th></tr>";
  $i=0;
  while($row=$con2->fetch(PDO::FETCH_OBJ)){
  	$i++;
  	//echo "Not ".$row->IdNotificacion;
  	if($i%2==0){
		$estilo="background-color:silver;color:black;";
	}else{
		$estilo="background-color:white;color:black;";
	}
	  echo "<tr><td colspan='5' style='$estilo'>".$row->idNotificacion.$row->Fecha."</td><td style='$estilo'>".$row->Asunto."</td>";
	  echo "<td align='center' style='$estilo'>".$row->CEU."</td>";
	  if(isset($_SESSION["autenticado"])){
		  if($_SESSION["autenticado"]=="si"){
		  echo "<td align='center' style='$estilo'><a href='?mod=".$mod."&id=".base64_encode($row->idNotificacion)."'><img src='img/edit.png' width='32' title='Editar Noticia' /></a>&nbsp;&nbsp;&nbsp;";
		  //echo "";
		  //Javascript:
		  		?>
		  		<a href="#" onclick="Javascript:confirmar('Realmente desea eliminar?',<?php echo $row->idNotificacion; ?>);">
				<img src="img/elim.png" width="32" title="Eliminar Noticia" id="eliminar" /></a></td>
	      <?php  
		  }
	  }else{
		  echo "<td align='center' style='$estilo'><a href='?mod=vernoticia&id=".$row->IdNotificacion."'><img src='img/edit.png' width='32' title='Ver Noticia' /></a></td>";
	  }
	  /*echo "<td align='center'>";
	  echo "<a href='#'>Seleccionar</a>";
	  echo "</td>";*/
	  echo "</tr>";
  }
  echo "<tr>";
  echo "<td colspan='13'>";
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
					 <a href="#" onclick="leerDatosPag('<?php echo $_GET["usuario"] ?>',<?php echo $opc ?>,<?php echo $i ?>)"><?php echo $i; ?></a>&nbsp;
                     <?php
				 }
			} 
		}
		echo "</td></tr>";	
  echo "</table>";
  }//fin de if que verifica que existan datos
  else { ?>
 <center><b style="font:Verdana, Arial, Helvetica, sans-serif:; font-size:12px;">No hay datos</b></center><?php }
  exit();
}
ob_end_flush();
?>