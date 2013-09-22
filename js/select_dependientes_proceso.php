<script>
document.getElementById("estados").disabled=true;
</script>
<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
include_once ('../DBManager.class.php');
include_once ('../noticias.class.php');
$listadoSelects=array(
"paises"=>"lista_paises",
"estados"=>"lista_estados"
);
function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; $opcionSeleccionada=$_GET["opcion"];
//echo $selectDestino."-".$opcionSeleccionada;
if(validaOpcion($opcionSeleccionada))
{
	$objMedio=new Noticias;
    $consultar=$objMedio->consultar_medio_com($opcionSeleccionada);
    echo "<select name='$selectDestino' id='$selectDestino' onChange='document.getElementById(\"txtMedio\").value=this.value'>";
	echo "<option value='0'>Elige</option>";
	$i=0;
    while ($data = $consultar->fetch(PDO::FETCH_OBJ))
	{
		$i++;
		echo "<option value='".$data->idMedioComunicacion."'>".$data->Nombre."</option>";
	}
	if($i==0){
	?>
	<script language="Javascript">
		document.getElementById("estados").disabled=true;
	</script>
	<?php
	}
	echo "</select>";
}
?>