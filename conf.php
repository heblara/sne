<?php
define('MODULO_DEFECTO','home');
define('LAYOUT_DEFECTO','inicio.php');//Administrador
define('LAYOUT_LOGIN','login.php');//Administrador
define('LAYOUT_ADMINISTRADOR','administrador.php');
define('LAYOUT_ADMINCEU','adminceu.php');
define('LAYOUT_ABOGADO','abogado.php');
define('LAYOUT_NOTIFICADOR','notificador.php');
define('LAYOUT_INICIO','inicio.php');//Para cualquier tipo de usuario
define('MODULO_PATH',realpath('paginas'));
define('LAYOUT_PATH',realpath('plantillas'));
//ADMINISTRADOR DE CUENTAS ELECTRÓNICAS
$conf['crearcuenta']=array(
'archivo'=>'frmCEU.php',
'layout'=>LAYOUT_ADMINCEU
);
$conf['modificarcuenta']=array(
'archivo'=>'frmmodificarCEU.php',
'layout'=>LAYOUT_ADMINCEU
);
$conf['guardarCuenta']=array(
'archivo'=>'guardarCuenta.php',
'layout'=>LAYOUT_ADMINCEU
);
$conf['actualizarCuenta']=array(
'archivo'=>'actualizarCuenta.php',
'layout'=>LAYOUT_ADMINCEU
);
$conf['validarcorreo']=array(
'archivo'=>'validarcorreo.php',
'layout'=>LAYOUT_INICIO
);
$conf['validarcuenta']=array(
'archivo'=>'validarcorreo.php',
'layout'=>LAYOUT_INICIO
);
$conf['registro']=array(
'archivo'=>'frmRegistro.php',
'layout'=>LAYOUT_INICIO
);
//Archivos generales
$conf['home']=array(
'archivo'=>'home.php',
'layout'=>LAYOUT_INICIO
);
$conf['terminos']=array(
'archivo'=>'terminos.php',
'layout'=>LAYOUT_LOGIN
);
$conf['404']=array(
'archivo'=>'404.php',
'layout'=>LAYOUT_INICIO
);
$conf['login']=array(
'archivo'=>'login.php',
'layout'=>LAYOUT_INICIO
);
$conf['autenticar']=array(
'archivo'=>'autenticar.php',
'layout'=>LAYOUT_INICIO
);
$conf['logout']=array(
'archivo'=>'logout.php',
'layout'=>LAYOUT_INICIO
);
$conf['principalAdmin']=array(
'archivo'=>'principalAdmin.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['buscarboletas']=array(
'archivo'=>'searchBoleta.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['changePwd']=array(
'archivo'=>'frmCambiarContra.php',
'layout'=>LAYOUT_INICIO
);
$conf['cambiarPwd']=array(
'archivo'=>'procesoFrmCambiarContra.php',
'layout'=>LAYOUT_INICIO
);
$conf['resetPwdUser']=array(
'archivo'=>'pwdRecovery.php',
'layout'=>LAYOUT_INICIO
);
$conf['addUser']=array(
'archivo'=>'addUser.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['saveUser']=array(
'archivo'=>'saveUser.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['searchUser']=array(
'archivo'=>'searchUser.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['updateUser']=array(
'archivo'=>'updateUser.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['saveUpUser']=array(
'archivo'=>'saveUpUser.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['buscarceu']=array(
'archivo'=>'searchCEU.php',
'layout'=>LAYOUT_ADMINCEU
);
//MODULOS DEL NOTIFICADOR
$conf['adminceu']=array(
'archivo'=>'adminceu.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['correoEnviado']=array(
'archivo'=>'correoEnviado.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['notificador']=array(
'archivo'=>'notificador.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['buscarnotificaciones']=array(
'archivo'=>'searchNotificaciones.php',
'layout'=>LAYOUT_ADMINISTRADOR
);
$conf['envioCorreo']=array(
'archivo'=>'enviarCorreo.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['elimNot']=array(
'archivo'=>'elimNot.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['sendMail']=array(
'archivo'=>'sendMail.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['imprimirboleta']=array(
'archivo'=>'imprimirboleta.php',
'layout'=>LAYOUT_NOTIFICADOR
);

//MODULOS USUARIO
$conf['bandejaentrada']=array(
'archivo'=>'bandeja_usuario.php',
'layout'=>LAYOUT_ABOGADO
);
$conf['notificacion']=array(
'archivo'=>'notificacion.php',
'layout'=>LAYOUT_ABOGADO
);
$conf['seguimiento']=array(
'archivo'=>'seguimiento.php',
'layout'=>LAYOUT_NOTIFICADOR
);
$conf['infouser']=array(
'archivo'=>'datauser.php',
'layout'=>LAYOUT_ABOGADO
);
$conf['imprimirceu']=array(
'archivo'=>'imprimirCEU.php',
'layout'=>LAYOUT_ADMINCEU
);
?>