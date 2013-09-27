<?php
$user=base64_decode($_GET["ceu"]);
if($user=="" || $user==null || trim($user)==""){
    header("Location:?mod=home");
}else{
    $objUser=new Sisnej;
    $consultarCEU=$objUser->consultar_ceu($user);
    if($consultarCEU->rowCount()==1){
        if($validar=$objUser->ValidarCuenta($user)){
            echo "Su cuenta ha sido validada con exito<br>Para ingresar a su cuenta haga <a href='?mod=login'>clic aqui</a>";
        }
    }
}
?>