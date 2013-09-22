<?php 
$objSisnej=new Sisnej;
$consultarTerminos=$objSisnej->consultar_terminos();
$terminos=$consultarTerminos->fetch(PDO::FETCH_OBJ);
echo $terminos->Contenido;
?>