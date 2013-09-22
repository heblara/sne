<?php
if($_SESSION["autenticado"]!="si"){
	header("Location:?mod=home");
}
?>