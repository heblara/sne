<script language="javascript">
document.addNew.lstMedio.disabled=false;
</script>
<?php
include_once ('DBManager.class.php');
include_once ('sisnej.class.php');
$elegido=$_POST["elegido"];
$objMedio=new Noticias;
$consultar=$objMedio->consultar_medio_com($elegido);
while ($data = $consultar->fetch(PDO::FETCH_OBJ))
{
	echo "<option value='".$data->idMedioComunicacion."'>".$data->Nombre."</option>";
}
?>