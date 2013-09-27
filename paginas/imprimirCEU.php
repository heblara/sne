<?php 
/*$html="
<style type=\"text/css\">
  th{
    align:right;
  }
</style>
<table class='boleta' width=\"100%\" style=\"background-color:#FFF;font-family: 'Trebuchet MS';\">
  <tr>
    <td><img src=\"../img/CSJ.png\" /></td>  
    <td colspan='3'><h1 style='padding-bottom:-30px;'>CORTE SUPREMA DE JUSTICIA</h1><br />
    <h2>BOLETA DE NOTIFICACION ELECTR&Oacute;NICA</h2></td>
  </tr>
  <tr>
    <td></td>
    <td><i><b>$resNot->Asunto</b></i></td>
  </tr>
  <tr>
    <th>Fecha de env&iacute;o:</th>
    <td>$resNot->Fecha</td>
  </tr>
  <tr>
    <th>Enviado a:</th>
    <td colspan='2'>".utf8_decode($resceu->Nombre)." (".$resceu->CEU.")</td>
  </tr>
  <tr>
    <th>Observaciones:</th>
    <td style='text-decoration:underline;' colspan='3'>".utf8_decode($observacion)."</td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td colspan='3' align='center'>Codigo: ".$codigo."<br />Generada por: ".$_SESSION["usuario"]."</td>
  </tr>
</table>";*/
//echo $consultarBoleta->rowCount();
/*$obj=new Sisnej;
$consultarBol=$obj->consultar_boleta($id);
  $row=$consultarBol->fetch(PDO::FETCH_OBJ);
  if($row->N==0){
    $boleta=array(date('Y-m-d H:i:s'),$_SESSION["usuario"],$html,$id);
    //$guardarBoleta=$objSisnej->guardar_boleta();
  }
*/
//echo $html;
/*require_once("dompdf-master/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("letter", "landscape");
$dompdf->render();
$dompdf->stream(base64_encode($_GET["id"]).".pdf");*/
if(isset($_GET["ceu"])){
	$ceu=$_GET["ceu"];
	$objSisnej=new Sisnej;
	$consultarCEU=$objSisnej->consultar_ceu($ceu);
	if($consultarCEU->rowCount()>0){
	$datos=$consultarCEU->fetch(PDO::FETCH_OBJ);
	$consultarDepto=$objSisnej->consultar_departamento($datos->IdDepartamento);
	$depto=$consultarDepto->fetch(PDO::FETCH_OBJ);
	$departamento=$depto->DESCRIPCIO;
	$consultarMunic=$objSisnej->consultar_municipio($datos->IdMunicipio,$datos->IdDepartamento);
	$munic=$consultarMunic->fetch(PDO::FETCH_OBJ);
	$municipio=$munic->Descripcio;
	$html="<table width='100%' id='datauser'>
		<caption><h1>DATOS DE REGISTRO</h1><br />
		Verifique que los datos estén correctos, luego firme y selle.<br /><br />
		</caption>
		<tr>
			<th width='35%'>Nombre:</th>
			<td>$datos->Nombre</td>
		</tr>
		<tr>
			<th>Carne de abogado No:</th>
			<td>$datos->Carne</td>
		</tr>
		<tr>
			<th>Fecha Expedici&oacute;n del carnet:</th>
			<td>$datos->FechaExpedicion</td>
		</tr>
		<tr>
			<th>N&uacute;mero de acuerdo:</th>
			<td>$datos->NoAcuerdo</td>
		</tr>
		<tr>
			<th>Fecha de acuerdo:</th>
			<td>$datos->FechaAcuerdo</td>
		</tr>
		<tr>
			<th>DUI:</th>
			<td>$datos->DUI</td>
		</tr>
		<tr>
			<th>NombreDUI:</th>
			<td>$datos->NombreDUI</td>
		</tr>
		<tr>
			<th>Direcci&oacute;n:</th>
			<td>$datos->Direccion</td>
		</tr>
		<tr>
			<th>Tel&eacute;fono:</th>
			<td>$datos->Movil</td>
		</tr>
		<tr>
			<th>Email:</th>
			<td>$datos->Email</td>
		</tr>
		<tr>
			<th>Departamento:</th>
			<td>$departamento</td>
		</tr>
		<tr>
			<th>Municipio:</th>
			<td>$municipio</td>
		</tr>
		<tr>
			<td height='25px' colspan='2' valign='middle' align='center'>SAN SALVADOR, ".strtoupper(num2letras(date("d")))." DE ".strtoupper(num2month(date("m")))." DE ".strtoupper(num2letras(date("Y")))."
			<br/><br/><br /><br />
			F: ______________________________________<br/>
			".$datos->Nombre."<br/>DUI: ".$datos->DUI."</td>
		</tr>
	</table>";
	echo ($html);
	/*require_once("dompdf-master/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->set_paper("letter", "landscape");
	$dompdf->render();
	$dompdf->stream(base64_encode($_GET["ceu"]).".pdf");*/
	}
}
?>