<?php
date_default_timezone_set('America/Chicago'); 
session_start();
include("seguridad.php");
include("funciones/funciones.php");
ob_start();
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$c=0; 
if($_SESSION["tipo"]=="Abogado"){
    $objS=new Sisnej;
    $conNot=$objS->consultar_notificacion_abogado($_SESSION["ceu"]);
    $c=0;
    while($res=$conNot->fetch(PDO::FETCH_OBJ)){
        $consultaBorrado=$objS->consultar_borrados_not($res->idNotificacion,$_SESSION["tipo"]);
        if($consultaBorrado->rowCount()==0){
            if($res->Leido==0){
                $c++;
            }
        }
    }
}
?>
<title><?php if($c>0){ echo "(".$c.")"; } ?> Sistema de Notificaci&oacute;n Electr&oacute;nica Judicial - Corte Suprema de Justicia</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.8.2.js"></script>
<!--<script src="js/jquery-1.8.2.js"></script>-->
</head>
<body>
<div id="header-wrap">
	<div id="header-container">
		<div id="header">
			<?php include("paginas/header.php") ?>
		</div>
	</div>
</div>
<div style="background-color:#FFF;height:768px;">
    <div id="ie6-container-wrap">
        <div id="container">
            <div id="content" align="center">
            <?php 
                include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
            ?>  
            <br /><br />
        </div>
      </div>
    </div>
</div>
<?php 
/*if(isset($_GET["mod"])){
  if($_GET["mod"]!="bandejaentrada"){*/
?>
<div id="footer-wrap">
    <div id="footer-container">
        <div id="footer">
          <?php include('paginas/footer.php'); ?>
        </div>
    </div>
 </div>
 <?php //} }  ?>
</body>
</html>
<?php
ob_end_flush();
?>