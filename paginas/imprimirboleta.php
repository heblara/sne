<?php 
include_once ("html2pdf/html2fpdf.php");
$id=base64_decode($_GET["id"]);
$objSisnej=new Sisnej;
$consultarNot=$objSisnej->consultar_notificacion($id);
$resNot=$consultarNot->fetch(PDO::FETCH_OBJ);
$html= "";
$html='<table width="50%" style="background-color:#FFF;">
	<tr>
		<td rowspan=\'3\'><img src="img/CSJ.jpg" /></td>
		<td><h3>'.$juzgado.' DE '.$municipio.', '.$departamento.'</h3></td>
	</tr>
	<tr>
		<td>'.strtoupper($nombre).' '.strtoupper($apellido).'</td>
	</tr>
	<tr>
		<td>'.$resNot->Fecha.'</td>
	</tr>
	<tr>
		<td>Enviado a:</td>
		<td>';
		$conNotificado=$objSisnej->consultar_notificado_especifico($resNot->CEU);
		$resceu=$conNotificado->fetch(PDO::FETCH_OBJ);
		$html.=$resceu->Nombre.' ('.$resceu->CEU.')</td>
	</tr>
	<tr>
		<td>Observaciones:</td>
		<td style=\'text-decoration:underline;\'>'; 
			$leido=0;
			$fecha="";
			$consultarSeguimiento=$objSisnej->consultar_seguimiento($id);
			while($res=$consultarSeguimiento->fetch(PDO::FETCH_OBJ)){
				if($res->Tipo=="1"){
					$leido++;
					$fecha=$res->Fecha;
				}else if($res->Tipo=="2"){
					$html.=' Borrado: '.$res->Fecha;
				}
			}
			if($consultarSeguimiento->rowCount()>0){
				$html.='El mensaje ha sido leído '.$leido.' veces y la ultima vez fue el '.$fecha.' <br>';
			}
			$consultarIngreso=$objSisnej->consultar_ingreso($resNot->CEU,$resNot->FechaEnvio);
			$j=0;
			while($ingreso=$consultarIngreso->fetch(PDO::FETCH_OBJ)){
				$j++;
				//echo $ingreso->Fecha;
			}
			//if($consultarIngreso->rowCount>0){
				$html.='El usuario ingres&oacute; '.$j.' veces';
			//}
			$html.='</td>
	</tr>
	<tr>
		<td></td>
		<td><a href=\'#\' onclick="descongelar()">Cerrar (X)</a></td>
	</tr>
</table>';
echo $html;
$pdf = new HTML2FPDF(); // Creamos una instancia de la clase HTML2FPDF
$pdf -> AddPage(); // Creamos una página
$pdf -> WriteHTML($html);//Volcamos el HTML contenido en la variable $html para crear el contenido del PDF
$pdf -> Output("doc.pdf","D");//Volcamos el pdf generado con nombre ‘doc.pdf’. En este caso con el parametro ‘D’ forzamos la descarga del mismo.
?>