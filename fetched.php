[
<?php
include_once ('DBManager.class.php');
include("sisnej.class.php");
$objMedio=new Sisnej;
$consultar=$objMedio->consultar_notificados();
$i=0;
while ($data = $consultar->fetch(PDO::FETCH_OBJ))
{
	$i++;
?>
{"caption":"<?php echo $data->Nombre." (".$data->Email.")"; ?>","value":"<?php echo $data->CEU; ?>"},
<?php	
}	
?>
]