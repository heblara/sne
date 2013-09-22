<link rel="shortcut icon" href="img/poderjudicial.png">
<script type="text/javascript" src="lib/alertify.js"></script>
<link rel="stylesheet" href="themes/alertify.core.css" />
<link rel="stylesheet" href="themes/alertify.default.css" />
<script src="lib/eventos.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<table width="100%">
                <tr>
                	<!--<td width='25px'><a href='?mod=home'><img src='img/poderjudicial.png' width='32'><a href="?mod=home"></a></td>-->
                    <td width='32px'><a href='?mod=home'><img src='img/SNE.png' style="float:left;"></a></td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><div id="nombre"><?php 
                      $objSisnej=new Sisnej;
                      if(isset($_SESSION["tipo"])){
                        if($_SESSION["tipo"]=="notificador"){
                          if(isset($_SESSION["nombre"])){
                            $consultarUsuario=$objSisnej->consultar_notificador($_SESSION['nombre'])->fetch(PDO::FETCH_OBJ);
                            $nombre=$consultarUsuario->Nombre;
                            $apellido=$consultarUsuario->Apellido;
                            $consultarJuzgado=$objSisnej->consultar_juzgado($consultarUsuario->idJuzgado)->fetch(PDO::FETCH_OBJ);
                            $juzgado=$consultarJuzgado->Juzgado;
                            $municipio=$consultarJuzgado->Municipio;
                            $departamento=$consultarJuzgado->Departamento;
                            if(substr($juzgado, -strlen($municipio))==$municipio || $municipio=="NUEVA SAN SALVADOR"){
                              $njuzgado=$juzgado;
                            }else{
                              $njuzgado=$juzgado." DE ".$municipio;
                            }
                            //extract($consultarJuzgado);
                            echo "Ha iniciado sesi&oacute;n como: ".strtoupper($nombre)." ".strtoupper($apellido)." DEL ".$njuzgado;
                          }
                        }else if($_SESSION["tipo"]=="Abogado"){
                            $consultarCEU=$objSisnej->consultar_ceu($_SESSION["ceu"]);
                            $ceu=$consultarCEU->fetch(PDO::FETCH_OBJ);
                            echo "Bienvenido a su cuenta ".$ceu->Nombre." (".$ceu->CEU.")";
                        }
                      }else{
                        echo "<h3>SISTEMA DE NOTIFICACI&Oacute;N ELECTR&Oacute;NICA JUDICIAL</h3>";
                      }
                    ?></div></td>
<td><link href="front.css" media="screen, projection" rel="stylesheet" type="text/css">
<?php
if(isset($_SESSION['autenticado'])){
  if($_SESSION['autenticado']=='si'){ ?>
  <td>
    <a href='?mod=logout' style='float:right;padding-left:12px;'><img src='img/logout.png' width='32' title='Cerrar Sesi&oacute;n' border='1' /></a>
    <a href='?mod=changePwd' style='float:right;padding-left:12px;'><img src='img/pwd.png' width='32' title='Cambiar contrase&ntilde;a' border='1' /></a>
    <a href='?mod=infouser'  style='float:right;padding-left:12px;'><img src='img/user_info.png' width='32' title='Informací&oacute;n del usuario' border='1' />
      <a href="?mod=home"><img src='img/home.png' width="32" title='Ir al inicio' style="float:right;padding-bottom:10px;"></a>
  </td>
<?php
  }
}else{
?>
<div id="menu" class="ocultar">
    <div id="container2" style='float:right;'>
      <div id="topnav" class="topnav">
        <a href="?mod=login" class="signin"><span>Iniciar Sesi&oacute;n</span></a> 
      </div>
      <fieldset id="signin_menu">
        <form method="post" id="signin" action="?mod=autenticar">
          <label for="username">Correo Electr&oacute;nico Personal:</label>
          <input id="username" name="username" value="" title="username" tabindex="4" type="text" required>
          </p>
          <p>
            <label for="password">Contrase&ntilde;a</label>
            <input id="password" name="password" value="" title="password" tabindex="5" type="password" required>
          </p>
          <input id="signin_submit" value="Iniciar Sesi&oacute;n" tabindex="6" type="submit">
          <!--<p class="remember">
            <input id="remember" name="remember_me" value="1" tabindex="7" type="checkbox">
            <label for="remember">Recordarme</label>
          </p>
          <p class="forgot"> <a href="#" id="resend_password_link">Olvid&oacute; su contrase&ntilde;a?</a> </p>
          <p class="forgot-username"> <A id=forgot_username_link 
    title="If you remember your password, try logging in with your email" 
    href="#">Olvid&oacute; su usuario?</A> </p>-->
        </form>
      </fieldset>
    </div>
</div>
<script src="javascripts/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $(".signin").mouseover(function(e) {          
          e.preventDefault();
          $("fieldset#signin_menu").toggle();
          $(".signin").toggleClass("menu-open");
      });
      $("fieldset#signin_menu").mouseup(function() {
        return false
      });
      $(".ocultar").onblur(function(e) {
        //alert("Fuera de container2");
        if($(e.target).parent("a.signin").length==0) {
          $(".signin").removeClass("menu-open");
          $("fieldset#signin_menu").hide();
        }
     });
      /*$('#midiv').click(function(event){
         event.stopPropagation();
     });*/
      /*$(document).click(function(e) {
        if($(e.target).parent("a.signin").length==0) {
          $(".signin").removeClass("menu-open");
          $("fieldset#signin_menu").hide();
        }
    });*/
  });
</script>
<script src="javascripts/jquery.tipsy.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function() {
    $('#forgot_username_link').tipsy({gravity: 'w'});   
    });
  </script>
<?php
}
?>
</td>
</tr>
</table>
<?php 
if(isset($_GET["mod"])){
  if($_GET["mod"]=="bandejaentrada"){
?>
<table width='100%'>
  <tr>
    <th width="50%">Asunto</th>
    <th width="11.35%">Fecha</th>
    <th width="48.65">Juzgado</th>
  </tr>
</table>
<?php   
  }else if($_GET["mod"]=="correoEnviado"){
?>
<table width='100%' id='tcontainer'>
  <tr>
    <th width="40%" rowspan="2">Asunto</th>
    <th width="11.35%" rowspan="2">Fecha</th>
    <th colspan="3">Estado</th>
    <th rowspan="2" width='8%'>Borrar</th>
  </tr>
  <tr>
    <th width='16.217%'>Le&iacute;do</th>
    <th width='16.217%'>Tiempo</th>
    <th width='8.217%'>Recibido</th>
  </tr>
</table>
<?php
  }
}
?>