<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Identificaci&oacute;n</title>
	<link href="css/login-box.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div align="center">
    	<div class="head"></div>
        <br /><br /><br /><br />
		<div id="login-box">
            <H2 class="h2">Identificaci&oacute;n</H2>
            Programaci&oacute;n y Control de Eventos
            <img src="images/identi.png" width="52" border="0" style="margin-left:265px; margin-top:-55px;"/>
            <br />
            <br />
            <form name="frmLogin" id="frmLogin" onsubmit="return alert('Enviando'); false;" action="?mod=autenticar">
            <div id="login-box-name" style="margin-top:20px;">Usuario:</div>
            <div id="login-box-field" style="margin-top:20px;">
            	<input name="txtUser" id="txtUser" class="form-login" title="Usuario" value="" size="30" maxlength="6" />
            </div>
            <div id="login-box-name">Password:</div>
            <div id="login-box-field">
	          <input name="txtPassword" id="txtPassword" type="password" class="form-login" title="Password" value="" size="30" maxlength="16" />            </div>
            <img src="images/login-btn.png" width="103" height="42" style="margin-left:90px; margin-top:25px;cursor:pointer;" title="Login"/>
            </form>
            <img src="images/logo.png" style="margin-left:285px; margin-top:-25px;" title="Inform&aacute;tica"/>
		</div>
	</div>
    <div class="foot">
    Desarrollado por el departamento de informatica
    </div>
</body>
</html>