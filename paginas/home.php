<?php 
if(isset($_SESSION['autenticado'])){
	if($_SESSION['autenticado']=="si"){
		if($_SESSION["tipo"]=="notificador"){
			header("Location:?mod=notificador");
		}else if($_SESSION["tipo"]=="Abogado"){
			header("Location:?mod=bandejaentrada");
		}else if($_SESSION["tipo"]=="admin"){
			header("Location:?mod=principalAdmin");
		}else if($_SESSION["tipo"]=="adminceu"){
			header("Location:?mod=adminceu");
		}
	}else{

	}
}else{
?>
<table>
	<tr>
		
	</tr>
	<tr>
		<td><a href='?mod=login'><img src="img/ingresarCEU.png" /></a></td>
		<td><a href='?mod=registro'><img src="img/registroAbogados.png" /></a></td>
	</tr>
</table>
<?php
}
?>