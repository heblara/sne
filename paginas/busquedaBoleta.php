<style type="text/css">
	@import url("../estilos.css");
</style>
<?php
include_once ('../DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('../sisnej.class.php');
//include("conexion.php");
ob_start();
//echo "<a style='text-align:left;' title='Cerrar esta ventana' href='#' onclick=\"document.getElementById('resultado').style.display='none'\"><img src='img/elim.png' width='16' /></a><br>";
@session_start();
//$condicion=" AND idNotificador=".$_SESSION["juzgado"]." ";
$mod="modificarcuenta";
$condicion="";
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
$consulta="SELECT * FROM boleta WHERE idBoleta='".$_GET["usuario"]."'";
//	echo $consulta;
//echo $consulta;
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
echo $total." boletas coinciden con su busqueda<br>";
//echo "Se muestran paginas de " . $tamanopag . " registros cada una<br>"; 
echo "P&aacute;gina " . $pagina . " de " . $total_paginas . "";
$con2=$objBuscar->buscarNoticias($consulta.$limit);
$total=$con2->rowCount();
  if ($total > 0) { 
  echo "<table align='center' class='busqueda' width='100%'>";
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
	  echo "<td align='center' style='$estilo'><a href='?mod=".$mod."&id=".base64_encode($row->CEU)."'><img src='img/edit.png' width='32' title='Editar Noticia' /></a>&nbsp;&nbsp;&nbsp;";
	  		?>
			<a onclick="Javascript:var opc=confirm('Realmente desea eliminar?');if(opc){location.href='?mod=elimCEU&id=<?php echo base64_encode($row->CEU); ?>'}"><img src="img/delete.png" width="20" title="Eliminar Noticia" /></a></td>
        <?php  
	  }
	  }else{
		  echo "<td align='center' style='$estilo'><a href='?mod=vernoticia&id=".$row->idCEU."'><img src='img/edit.png' width='16' title='Editar informacion' /></a></td>";
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