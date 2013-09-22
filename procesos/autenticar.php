<?php
include("header.php");
session_start();
$user=$_POST["username"];
$pwd=$_POST["password"];
$respuesta = new stdClass();
if($user=="" || $user==null || trim($user)=="" || $pwd=="" || $pwd==null || trim($pwd)==""){
    $respuesta->mensaje = 1;
    //echo "Combinaci&oacute;n de usuario y contrase&ntilde;a incorrecta";
    //header("Location:?mod=login&msj=1");
}else{
    $objUser=new Sisnej;
    $log=array($user,$pwd);
    $consultarUsuario=$objUser->consultar_usuario($log);
    $c=$consultarUsuario->rowCount();
    if($c>0){ //Verificando que exista ese usuario
        $consultarestado=$objUser->consultar_estado_usuario($log[0]);
        $estado=$consultarestado->fetch(PDO::FETCH_OBJ);
        if($estado->Estado==1){ //verificando que usuario este activo
            $usuario=$consultarUsuario->fetch(PDO::FETCH_OBJ);
            //session_start();
            $_SESSION["tipo"]=$usuario->TipoUsuario;
            $_SESSION["nombre"]=$usuario->Usuario;
            $consultarUsuario=$objUser->consultar_notificador($_SESSION['nombre'])->fetch(PDO::FETCH_OBJ);
            $_SESSION["autenticado"]="si";
            //echo "Usuario encontrado";
            //$_SESSION["tipo"]=$usuario->TipoUsuario;
            if($usuario->TipoUsuario=="notificador"){
                $_SESSION["juzgado"]=$consultarUsuario->idJuzgado;
                $_SESSION["usuario"]=$user;
                //header("Location:?mod=notificador");
            }else if($usuario->TipoUsuario=="Abogado"){
                $_SESSION["ceu"]=$user;
                //header("Location:?mod=bandejaentrada");
            }else if($usuario->TipoUsuario=="admin"){
               // header("Location:?mod=home");
            }else if($usuario->TipoUsuario=="adminceu"){
                //header("Location:?mod=crearcuenta");
            }
            $respuesta->mensaje = 3;
        }else{
            $respuesta->mensaje=4;
        }
    }else{ //Si los datos ingresados son incorrectos mostrara el mensaje de alerta
        $respuesta->mensaje = 2;
        //header("Location:?mod=login&msj=2");
    }
}
echo json_encode($respuesta);
?>