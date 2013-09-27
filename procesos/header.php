<?php 
if (!ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
require_once ('../DBManager.class.php'); //Clase de Conexión a las Base de Datos
require('../sisnej.class.php');
require("../conf.php");
require("../conexion.php");
require("../funciones/funciones.php");
require_once("../phpmailer/class.phpmailer.php");
?>