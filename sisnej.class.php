<?php
class Sisnej {
    //constructor
    function Sisnej() {

    }
    function setName2(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SET NAMES 'utf8'";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
	}

    function consultar_usuario($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM usuario where Usuario=:Usuario and Contrasena=md5(:Pwd)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Usuario",$campos[0]);
        $query->bindParam(":Pwd",$campos[1]);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 		else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_estado_usuario($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT Estado FROM usuario where Usuario=:Usuario";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Usuario",$campos);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    
    function consultar_ceu($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM ceu where CEU=:ceu";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":ceu",$campos);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_terminos() {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM contenidos where idContenido=1";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_notificador($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM notificador where Usuario=:Usuario";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Usuario",$campos);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_notificacion_abogado($ceu) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT n.idNotificacion,n.Leido,n.Asunto,date_format(n.FechaEnvio,'%d-%m-%Y %h:%i:%s %p') as Fecha, CONCAT(j.Descripcio,', ',m.Descripcio,', ',d.Descripcio) as Juzgado FROM notificacion as n INNER JOIN juzgado AS j ON n.idNotificador=j.Contador
        INNER JOIN municipios as m ON j.IdMunic=m.IdMunic and j.IdDepto=m.IdDepto INNER JOIN departamentos AS d ON m.IdDepto=d.IdDepto where n.CEU=:ceu ORDER BY FechaEnvio DESC";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":ceu",$ceu);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_notificacion($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT n.idNotificacion,n.CEU,n.Contenido,n.Asunto,n.Archivo,date_format(n.FechaEnvio,'%d-%m-%Y %h:%i:%s %p') as Fecha, CONCAT(j.Descripcio,', ',m.Descripcio,', ',d.Descripcio) as Juzgado, FechaEnvio FROM notificacion as n INNER JOIN juzgado AS j ON n.idNotificador=j.Contador
        INNER JOIN municipios as m ON j.IdMunic=m.IdMunic and j.IdDepto=m.IdDepto INNER JOIN departamentos AS d ON m.IdDepto=d.IdDepto where n.idNotificacion=:id";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function MarcarLeido($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "UPDATE notificacion SET Leido=1 where idNotificacion=:id";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function ValidarCuenta($ceu) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "UPDATE usuario SET Estado=1 where usuario=:ceu";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":ceu",$ceu);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function DarSeguimiento($id,$tipo,$user,$tipou){
        date_default_timezone_set('America/Chicago'); 
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "INSERT INTO seguimiento_notificacion VALUES(:id,:Fecha,:Tipo,:User,:TipoUsuario)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$id);
        $query->bindParam(":Fecha",date('Y-m-d H:i:s'));
        $query->bindParam(":Tipo",$tipo);
        $query->bindParam(":User",$user);
        $query->bindParam(":TipoUsuario",$tipou);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function registrar_ingreso($ceu,$Fecha){
        date_default_timezone_set('America/Chicago'); 
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "INSERT INTO ingreso VALUES(:ceu,:Fecha)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":ceu",$ceu);
        $query->bindParam(":Fecha",date('Y-m-d H:i:s'));
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_ingreso($ceu,$Fecha){
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $dia=24*60*60;
        $fechasuperior=strtotime($Fecha)+$dia;
        $fec=date('Y-m-d H:i:s',$fechasuperior);
        //$sql = "SELECT * FROM ingreso WHERE ceu=:ceu AND Fecha BETWEEN :Fecha AND :Fecha2";
        $sql = "SELECT * FROM ingreso WHERE ceu='".$ceu."' AND Fecha BETWEEN '".$Fecha."' AND '".$fec."'";
        //echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":ceu",$ceu);
        $query->bindParam(":Fecha",date('Y-m-d H:i:s'));
        $query->bindParam(":Fecha2",$fec);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_notificaciones($juzgado) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT n.idNotificacion,n.Leido,n.Asunto,n.Archivo,date_format(n.FechaEnvio,'%d-%m-%Y %h:%i:%s %p') as Fecha, CONCAT(j.Descripcio,', ',m.Descripcio,', ',d.Descripcio) as Juzgado FROM notificacion as n INNER JOIN juzgado AS j ON n.idNotificador=j.Contador
        INNER JOIN municipios as m ON j.IdMunic=m.IdMunic and j.IdDepto=m.IdDepto INNER JOIN departamentos AS d ON m.IdDepto=d.IdDepto where n.idNotificador=:juzgado AND (SELECT COUNT(*) FROM borrados b WHERE b.idNotificacion=n.idNotificacion)  = 0  ORDER BY FechaEnvio DESC";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":juzgado",$juzgado);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
     function consultar_seguimiento($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,date_format(Fecha,'%d-%m-%Y %h:%i:%s %p') as Fecha FROM seguimiento_notificacion WHERE idNotificacion=:id ORDER BY Fecha ASC";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function registrar_borrado($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "INSERT INTO borrados VALUES(:Usuario,:Fecha,:idNotificacion)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Usuario",$campos[0]);
        $query->bindParam(":Fecha",$campos[1]);
        $query->bindParam(":idNotificacion",$campos[2]);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function crear_tabla_temporal() {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $this->borrar_tabla_tempo();
        $sql = "CREATE TABLE IF NOT EXISTS `notificacion_temporal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idNotificacion` int(11) NOT NULL,
  `Asunto` varchar(100) NOT NULL,
  `FechaEnvio` datetime NOT NULL,
  `Juzgado` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function guardar_tabla_tempo($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "INSERT INTO notificacion_temporal VALUES('',:Id,:Asunto,:Fecha,:Juzgado)";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Id",$campos[0]);
        $query->bindParam(":Asunto",$campos[1]);
        $query->bindParam(":Fecha",$campos[2]);
        $query->bindParam(":Juzgado",$campos[3]);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function borrar_tabla_tempo() {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "DROP TABLE notificacion_temporal";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_juzgado($campos) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT j.DESCRIPCIO as Juzgado, m.Descripcio as Municipio, d.Descripcio as Departamento FROM juzgado AS j INNER JOIN municipios AS m ON j.IdMunic=m.IdMunic and j.IdDepto=m.IdDepto INNER JOIN departamentos AS d ON j.IdDepto=d.IdDepto where j.Contador=:id";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$campos);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
    function consultar_juzgados() {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT j.IdUnidad,j.Contador,CONCAT(j.DESCRIPCIO,' DE ',m.Descripcio,' DE ', d.Descripcio) AS Juzgado FROM juzgado AS j INNER JOIN municipios AS m ON j.IdMunic=m.IdMunic and j.IdDepto=m.IdDepto INNER JOIN departamentos AS d ON j.IdDepto=d.IdDepto";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$campos);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
	function buscar_usuario($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM usuario where usuario=:Usuario";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":Usuario",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 		else
            return false;
        unset($dbh);
        unset($query);
    }
	function crear_cuenta($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO ceu VALUES ('',:Email,:Nombre,:Carnet,:FechaExp,:Acuerdo,:FechaAcuerdo,:DUI,:NombreDUI,:Direccion,:Depto,:Munic,:Email,:Movil)";
        $add = $dbh->prepare($sql);
         $add->bindParam(":Nombre",$campos[0]);
		$add->bindParam(":Carnet",$campos[1]);
        $add->bindParam(":FechaExp",$campos[2]);
        $add->bindParam(":Acuerdo",$campos[3]);
        $add->bindParam(":FechaAcuerdo",$campos[4]);
        $add->bindParam(":DUI",$campos[5]);
        $add->bindParam(":NombreDUI",$campos[6]);
		$add->bindParam(":Direccion",$campos[7]);
		$add->bindParam(":Munic",$campos[9]);
		$add->bindParam(":Depto",$campos[8]);
		$add->bindParam(":Email",$campos[10]);
		$add->bindParam(":Movil",$campos[11]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function actualizar_cuenta($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE ceu SET Nombre=:Nombre,Carne=:Carnet,FechaExpedicion=:FechaExp,NoAcuerdo=:Acuerdo,FechaAcuerdo=:FechaAcuerdo,DUI=:DUI,NombreDUI=:NombreDUI,Direccion=:Direccion,IdDepartamento=:Depto,IdMunicipio=:Munic,Email=:Email,Movil=:Movil WHERE CEU=:Email";
        $add = $dbh->prepare($sql);
         $add->bindParam(":Nombre",$campos[0]);
        $add->bindParam(":Carnet",$campos[1]);
        $add->bindParam(":FechaExp",$campos[2]);
        $add->bindParam(":Acuerdo",$campos[3]);
        $add->bindParam(":FechaAcuerdo",$campos[4]);
        $add->bindParam(":DUI",$campos[5]);
        $add->bindParam(":NombreDUI",$campos[6]);
        $add->bindParam(":Direccion",$campos[7]);
        $add->bindParam(":Munic",$campos[9]);
        $add->bindParam(":Depto",$campos[8]);
        $add->bindParam(":Email",$campos[10]);
        $add->bindParam(":Movil",$campos[11]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function consultar_correos(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM bandejasalida ORDER BY idSalida ASC";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
	}
    function consultar_adminceu($user){
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM adminceu WHERE Usuario='".$user."'";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
    }
	function consultar_departamentos(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM departamentos";	
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
		
        if ($query){
        	return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_correo($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM notificacion WHERE idNotificacion=:id";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
		$query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
	}
	function consultar_notificados() {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM ceu";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        //$query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
	    else
            return false;
        unset($dbh);
        unset($query);
    }
	function consultar_notificado_especifico($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM ceu WHERE CEU=:id";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
	    else
            return false;
        unset($dbh);
        unset($query);
    }
	//OTRAS FUNCIONES
    function buscarNoticias($sql) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
    }
	function consultar_usuarios($sql) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
    }


	function consultar_noticia_etiqueta($idN){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM noticia as n INNER JOIN noticia_etiqueta as ne ON n.idNoticia=ne.idNoticia INNER JOIN etiqueta as e ON e.idEtiqueta=ne.idEtiqueta where n.idNoticia='".$idN."'";	
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
		
        if ($query){
        	return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_relacionadas($tag,$not){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *
				FROM noticia AS n
				INNER JOIN noticia_etiqueta AS ne ON n.idNoticia = ne.idNoticia
				WHERE ne.idEtiqueta = '$tag'
				and ne.idNoticia <> '$not' 
				";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
	}
	function consultar_archivos($not,$a){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "
		SELECT *
		FROM noticia AS a
		INNER JOIN archivo_noticia AS b ON a.idNoticia = b.idNoticia
		INNER JOIN archivo AS c ON b.idArchivo = c.idArchivo
		WHERE c.TipoArchivo = '$a'
		AND a.idNoticia = '$not'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 		else
            return false;
        unset($dbh);
        unset($query);
	}
	function consultar_archivo($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "
		SELECT *
		FROM archivo AS a
		INNER JOIN archivo_noticia as an
		ON a.idArchivo=an.idArchivo
		INNER JOIN noticia as n
		ON an.idNoticia=n.idNoticia
		WHERE a.idArchivo = '$id'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 		else
            return false;
        unset($dbh);
        unset($query);
	}
	function consulta_archivos($a){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM archivo
		WHERE TipoArchivo = 1
		ORDER BY idArchivo ASC
		LIMIT 0,15";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 		else
            return false;
        unset($dbh);
        unset($query);
	}
    function consultar_borrados_not($a,$tipo){
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM seguimiento_notificacion WHERE idNotificacion=".$a." and tipo=2 and TipoUsuario='".$tipo."'";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
        else
            return false;
        unset($dbh);
        unset($query);
    }
	function consultar_eventos_proximos(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM evento WHERE Fecha>='".date('Y-m-d')."'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_eventos(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM evento";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_contenido($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM contenido WHERE idContenido=:id OR Identificador=:id";
		
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
		$query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_funcionario($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM funcionario WHERE idFuncionario=:id";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
		$query->bindParam(":id",$id);
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_funcionarios($sala){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM funcionario WHERE Sala=:sala";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
		$query->bindParam(":sala",$sala);
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_albumes(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM album";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_videos(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM video";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_video($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM video WHERE idVideo=".$id;
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_boletin($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM boletin WHERE idBoletin=".$id;
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_boletines(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM boletin";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_boletines_urgentes(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM boletin WHERE Urgente=1 AND Fecha LIKE '%".date('Y-m-d')."%'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_album($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM album WHERE idAlbum='".$id."'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_comunicados(){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d-%m-%Y') as Fec FROM comunicado ORDER BY Fecha DESC";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}
	function consultar_comunicado($id){
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d-%m-%Y') as Fec FROM comunicado WHERE idComunicado=".$id;
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta

        if ($query){
			return $query; //pasamos el query para utilizarlo luego con fetch	
		}else{
			return false;
		}
        unset($dbh);
        unset($query);
	}

	function consultar_noticias(){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM noticia ORDER BY Fecha DESC";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_fotografias(){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM fotografia ORDER BY Fecha DESC LIMIT 0,12";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_foto($id){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM fotografia WHERE idFotografia=:id";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
		$query->bindParam("id",$id);
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_contenidos($pos){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
		if($pos=="todos"){
			$sql = "SELECT * FROM contenido";
		}else{
        $sql = "SELECT * FROM contenido WHERE posicion='$pos'";
		}
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_fotos($id){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT * FROM fotografia WHERE idAlbum='".$id."' ORDER BY idFotografia";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_noticia($id){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM noticia where idNoticia='$id'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	function consultar_evento($id){
		$this->setName2();
		$con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT *,DATE_FORMAT(Fecha,'%d/%m/%Y') as Fec FROM evento where idEvento='$id'";
		//echo $sql;
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query){
        	return $query;
			//return $query; //pasamos el query para utilizarlo luego con fetch
		}else{
			return false;
		}
            
        unset($dbh);
        unset($query);
	}
	
	function agregar_noticia($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO noticia VALUES ('',:Fecha,:Titulo,:Resumen,:Imagen,:FechaProcesamiento,:idUsuario)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Fecha",$campos[0]);
        $add->bindParam(":Titulo",$campos[1]);
        $add->bindParam(":Resumen",$campos[2]);
        $add->bindParam(":Imagen",$campos[3]);
        $add->bindParam(":FechaProcesamiento",date('Y-m-d H:i:s'));
        $add->bindParam(":idUsuario",$campos[4]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregar_contenido($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO contenido VALUES ('',:Nombre,:Contenido,:Identificador,:Imagen,:Posicion)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Nombre",$campos[0]);
        $add->bindParam(":Contenido",$campos[1]);
        $add->bindParam(":Identificador",strtolower(substr($campos[0],0,7)));
        $add->bindParam(":Imagen",$campos[2]);
		$add->bindParam(":Posicion",$campos[4]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregar_boletin($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO boletin VALUES ('',:Titulo,:URL,:Fecha,:Urgente,:User)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Titulo",$campos[0]);
        $add->bindParam(":Fecha",$campos[1]);
        $add->bindParam(":URL",$campos[2]);
		$add->bindParam(":User",$campos[3]);
		$add->bindParam(":Urgente",$campos[4]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function guardar_album($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO album VALUES (:id,:Nombre,:Fecha,:Descripcion,:Lugar,:Usuario)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Nombre",$campos[0]);
        $add->bindParam(":Fecha",$campos[1]);
        $add->bindParam(":Descripcion",$campos[3]);
        $add->bindParam(":Lugar",$campos[2]);
        $add->bindParam(":Usuario",$campos[4]);
        $add->bindParam(":id",$campos[5]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function guardar_boleta($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO boleta VALUES (LAST_INSERT_ID(id+1),:Fecha,:idUsuario,:Contenido,:idNotificacion)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Fecha",$campos[0]);
        $add->bindParam(":idUsuario",$campos[1]);
        $add->bindParam(":Contenido",$campos[2]);
        $add->bindParam(":idNotificacion",$campos[3]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function consultar_boleta($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "SELECT * FROM boleta WHERE idNotificacion=:id";
        $add = $dbh->prepare($sql);
        $add->bindParam(":id",$id);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function guardar_usuario($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO usuario VALUES ('',:usuario,:Contrasena,:TipoUsuario,:Estado)";
        $add = $dbh->prepare($sql);
        $add->bindParam(":usuario",$campos[0]);
        $add->bindParam(":Contrasena",md5($campos[1]));
        $add->bindParam(":TipoUsuario",$campos[2]);
        $add->bindParam(":Estado",$campos[3]);
        //$add->bindParam(":id",$campos[0]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function obtener_id(){
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager
        $dbh = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar para el caso MySQL.
        $sql = "SELECT LAST_INSERT_ID(idNotificacion) +1 AS ProximoId FROM notificacion ORDER BY idNotificacion DESC LIMIT 1";
        $query = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->execute(); // Ejecutamos la consulta
        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($dbh);
        unset($query);
    }
    function guardar_correo($asunto,$contenido,$notificado,$archivo,$juzgado) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO bandejasalida VALUES ('',:Asunto,:Contenido,:Fecha,:Notificado,0,0,:Archivo,:Juzgado)";
        //echo $sql;
         //$sql = "INSERT INTO noticia VALUES ('".$campos[6]."','".$campos[0]."','".$campos[1]."', '".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[8]."','".$campos[5]."','".$campos[7]."')";
        //echo $sql."<br>";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Asunto",$asunto);
        $add->bindParam(":Contenido",$contenido);
        $add->bindParam(":Fecha",date("Y-m-d H:i:s"));
        $add->bindParam(":Notificado",$notificado);
        $add->bindParam(":Archivo",$archivo);
        $add->bindParam(":Juzgado",$juzgado);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function guardar_notificacion($asunto,$contenido,$notificado,$archivo,$juzgado) {
        date_default_timezone_set('America/Chicago');
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO notificacion (idNotificacion,CEU,Asunto,Contenido,Archivo,FechaEnvio,idNotificador) VALUES ('',:Notificado,:Asunto,:Contenido,:Archivo,:Fecha,:Juzgado)";
        //echo $sql;
         //$sql = "INSERT INTO noticia VALUES ('".$campos[6]."','".$campos[0]."','".$campos[1]."', '".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[8]."','".$campos[5]."','".$campos[7]."')";
        //echo $sql."<br>";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Asunto",$asunto);
        $add->bindParam(":Contenido",$contenido);
        $add->bindParam(":Fecha",date("Y-m-d H:i:s"));
        $add->bindParam(":Notificado",$notificado);
        $add->bindParam(":Archivo",$archivo);
        $add->bindParam(":Juzgado",$juzgado);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	
	function actualizar_album($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE album SET Nombre=:Nombre,Fecha=:Fecha,Descripcion=:Descripcion,Lugar=:Lugar,Usuario=:Usuario WHERE idAlbum=:id";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Nombre",$campos[0]);
        $add->bindParam(":Fecha",$campos[1]);
        $add->bindParam(":Descripcion",$campos[3]);
        $add->bindParam(":Lugar",$campos[2]);
        $add->bindParam(":Usuario",$campos[4]);
        $add->bindParam(":id",$campos[5]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function actualizar_foto($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE fotografia SET Titulo=:Titulo WHERE idFotografia=:id";
        $add = $dbh->prepare($sql);
        $add->bindParam(":Titulo",$campos[1]);
        $add->bindParam(":id",$campos[0]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregar_evento($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO evento VALUES ('',:Titulo,:Fecha,:HoraIni,:HoraFin,:Lugar,:Descripcion,:Imagen)";
        $add = $dbh->prepare($sql);
		$add->bindParam(":Titulo",$campos[0]);
        $add->bindParam(":Fecha",$campos[1]);
        $add->bindParam(":HoraIni",$campos[2]);
        $add->bindParam(":HoraFin",$campos[3]);
        $add->bindParam(":Lugar",$campos[4]);
        $add->bindParam(":Descripcion",$campos[5]);
		$add->bindParam(":Imagen",$campos[6]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregar_fotografia($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO fotografia (idFotografia,Fecha,url,idAlbum,Titulo) VALUES ('',:Fecha,:url,:album,:titulo)";
        $add = $dbh->prepare($sql);
		$add->bindParam(":Fecha",$campos[0]);
        $add->bindParam(":url",$campos[1]);
        $add->bindParam(":album",$campos[2]);
	 	$add->bindParam(":titulo",$campos[3]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregar_comunicado($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO comunicado VALUES ('',:Fecha,:Resumen)";
		 //$sql = "INSERT INTO noticia VALUES ('".$campos[6]."','".$campos[0]."','".$campos[1]."', '".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[8]."','".$campos[5]."','".$campos[7]."')";
        //echo $sql."<br>";
        $add = $dbh->prepare($sql);
        //$add->bindParam(":idN",$campos[0]);
        $add->bindParam(":Fecha",$campos[0]);
        $add->bindParam(":Resumen",$campos[1]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function actualizar_comunicado($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE comunicado Set Fecha=:Fecha,Detalle=:Resumen WHERE idComunicado=:id";
		 //$sql = "INSERT INTO noticia VALUES ('".$campos[6]."','".$campos[0]."','".$campos[1]."', '".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[8]."','".$campos[5]."','".$campos[7]."')";
        //echo $sql."<br>";
        $add = $dbh->prepare($sql);
        $add->bindParam(":id",$campos[2]);
        $add->bindParam(":Fecha",$campos[0]);
        $add->bindParam(":Resumen",$campos[1]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function actualizar_contenido($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE contenido Set Nombre=:Nombre,Contenido=:Detalle,Imagen=:Imagen,Posicion=:Pos WHERE idContenido=:id";
		 //$sql = "INSERT INTO noticia VALUES ('".$campos[6]."','".$campos[0]."','".$campos[1]."', '".$campos[2]."','".$campos[3]."','".$campos[4]."','".$campos[8]."','".$campos[5]."','".$campos[7]."')";
        //echo $sql."<br>";
        $add = $dbh->prepare($sql);
        $add->bindParam(":id",$campos[4]);
        $add->bindParam(":Nombre",$campos[0]);
        $add->bindParam(":Detalle",$campos[1]);
		$add->bindParam(":Imagen",$campos[2]);
		$add->bindParam(":Pos",$campos[5]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function agregarBitacora($accion,$user,$tipo){
		$con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO bitacora VALUES(:Fecha,:User,:Accion,:Tipo)";
		$add = $dbh->prepare($sql);
		$add->bindParam(":Fecha",date('Y-m-d H:i:s a'));
        $add->bindParam(":Accion",$accion);
        $add->bindParam(":User",$user);
        $add->bindParam(":Tipo",$tipo);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
	}
	function registrarvisita(){
		$con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO visita VALUES(:Fecha,:IP,:Equipo,:Navegador)";
		$add = $dbh->prepare($sql);
		$add->bindParam(":Fecha",date('Y-m-d H:i:s a'));
        $add->bindParam(":IP",$_SERVER['REMOTE_ADDR']);
        $add->bindParam(":Equipo",php_uname("n"));
        $add->bindParam(":Navegador",$_SERVER['HTTP_USER_AGENT']);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
	}
    function actualizar_noticia($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE noticia SET Titulo=:Titulo,Resumen=:Resumen,Fecha=:Fecha,Imagen=:Imagen where idNoticia=:idN";
		//	$sql = "UPDATE noticia SET Titulo='".$campos[1]."',Resumen='".$campos[2]."',Fecha='".$campos[0]."',Imagen='".$campos[3]."' where idNoticia='".$campos[5]."'";
		echo $sql;
        $add = $dbh->prepare($sql);
        $add->bindParam(":idN",$campos[5]);
        $add->bindParam(":Titulo",$campos[1]);
        $add->bindParam(":Resumen",$campos[2]);
        //$add->bindParam(":Usuario",$campos[4]);
        $add->bindParam(":Imagen",$campos[3]);
        $add->bindParam(":Fecha",$campos[0]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
	function actualizar_evento($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE evento SET Titulo=:Titulo,Fecha=:Fecha,HoraInicio=:HoraIni,HoraFin=:HoraFin,Lugar=:Lugar,Descripcion=:Descripcion,Imagen=:Imagen WHERE idEvento=:id";
        $add = $dbh->prepare($sql);
		$add->bindParam(":Titulo",$campos[0]);
        $add->bindParam(":Fecha",$campos[1]);
        $add->bindParam(":HoraIni",$campos[2]);
        $add->bindParam(":HoraFin",$campos[3]);
        $add->bindParam(":Lugar",$campos[4]);
        $add->bindParam(":Descripcion",$campos[5]);
		$add->bindParam(":Imagen",$campos[6]);
		$add->bindParam(":id",$campos[7]);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function guardar_archivo($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO archivo VALUES ('".$campos[0]."','".$campos[1]."','".$campos[2]."', '".$campos[3]."')";
        $add = $dbh->prepare($sql);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function guardar_archivo_noticia($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO archivo_noticia VALUES ('".$campos[0]."','".$campos[1]."')";
        $add = $dbh->prepare($sql);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
    }
    function agregar_funcionario($campos){
		$con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "INSERT INTO funcionario VALUES ('','".$campos[0]."','".$campos[1]."','".$campos[2]."-".$campos[3]."','".$campos[6]."','".$campos[4]."')";
        $add = $dbh->prepare($sql);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
	}
	function actualizar_funcionario($campos){
		$con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE funcionario SET Nombre='".$campos[0]."',Sala='".$campos[1]."',Periodo='".$campos[2]."-".$campos[3]."',Biografia='".$campos[6]."',Fotografia='".$campos[4]."' WHERE idFuncionario='".$campos[7]."'";
        $add = $dbh->prepare($sql);
        $add->execute();
        if ($add)
           return true;
        else
           return false;
        unset($dbh);
        unset($add);
	}
	
	
	/************************************************************************/

    function consultar_id($id) {
        $con = new DBManager(); //creamos el objeto $con a partir de la clase DBManager

        $db = $con->conectar("mysql"); //Pasamos como parametro que la base de datos a utilizar es MySQL.
        $sql = "SELECT * FROM usuarios WHERE id_usuario =:id";
        $query = $db->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $query->bindParam(':id', $id); // Pasamos los parametros para el where
        $query->execute(); // Ejecutamos la consulta

        if ($query)
            return $query; //pasamos el query para utilizarlo luego con fetch
 else
            return false;
        unset($db);
        unset($query);
    }

    function borrar_id($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM usuarios WHERE id_usuario=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_album($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM album WHERE idAlbum=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
    function eliminar_notificacion($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM notificacion WHERE idNotificacion=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
    /*function eliminar_notificacion($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM notificacion WHERE idNotificacion=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }*/
    function eliminar_notificacion_notificador($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM notificacion WHERE idNotificacion=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_funcionario($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM funcionario WHERE idFuncionario=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_contenido($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM contenido WHERE idContenido=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_fotos($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM fotografia WHERE idAlbum=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_noticia($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM noticia WHERE idNoticia=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_foto($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM fotografia WHERE idFotografia=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_evento($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM evento WHERE idEvento=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function eliminar_comunicado($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM comunicado WHERE idComunicado=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }
	function borrar_periodista($id) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "DELETE FROM noticia_periodista WHERE idNoticia=:id";
        $borrar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $borrar->bindParam(':id', $id); // Pasamos los parametros para el where
        $borrar->execute();
        
        if ($borrar)
            return true;
        else
            return false;
        unset($dbh);
        unset($borrar);
    }

    function actualizar_id($id, $campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");
        $sql = "UPDATE usuarios SET nombre=:nombre, login=:login, password=:password WHERE id_usuario=:id";
        $actualizar = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion

        $actualizar->bindParam(':nombre', $campos[0]);
        $actualizar->bindParam(':login', $campos[1]);
        $actualizar->bindParam(':password', $campos[2]);
        $actualizar->bindParam(':id', $id); // Pasamos los parametros para el where

        $actualizar->execute();
        if ($actualizar)
            return true;
        else
            return false;
        
        unset($dbh);
        unset($actualizar);
    }

    /*function agregar($campos) {
        $con = new DBManager();
        $dbh = $con->conectar("mysql");

        $sql = "INSERT INTO usuarios (nombre, login, password) VALUES (:nombre, :login, :password )";

        $add = $dbh->prepare($sql); // Preparamos la consulta para dejarla lista para su ejecucion
        $add->bindParam(':nombre', $campos[0]);
        $add->bindParam(':login', $campos[1]);
        $add->bindParam(':password', md5($campos[2]));

        $add->execute();
        if ($add)
            return true;
        else
            return false;

        unset($dbh);
        unset($add);
    }*/

}

?>
