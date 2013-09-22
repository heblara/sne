<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema de Notificaci&oacute;n Electr&oacute;nica Judicial - Corte Suprema de Justicia</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="estilos.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.8.2.js"></script>
<!--<script src="js/jquery-1.8.2.js"></script>-->
</head>
<body>
<div style="background-color:#FFF;height:768px;">
    <div id="ie6-container-wrap">
        <div id="container">
            <div id="content" align="center">
            <?php 
                include(MODULO_PATH . "/" . $conf[$modulo]['archivo']);
            ?>  
        </div>
      </div>
    </div>
</div>
</body>
</html>