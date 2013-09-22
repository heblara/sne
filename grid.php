<link rel="stylesheet" href="grid2/demo/style.css" />
	<link rel="stylesheet" type="text/css" href="grid2/css/flexigrid.pack.css" />
	<script type="text/javascript"
		src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
	<script type="text/javascript" src="grid2/js/flexigrid.pack.js"></script>
   	<table class="flexme3" style="display: none;z-index:-3;"></table>
	<script type="text/javascript">
		$('.flexme1').flexigrid();
		$('.flexme2').flexigrid({
			height : 'auto',
			striped : false
		});
		$(".flexme3").flexigrid({
			url : 'grid2/demo/post-xml.php',
			dataType : 'xml',
			colModel : [ {
				display : 'No.',
				name : 'iso',
				width : 40,
				sortable : true,
				align : 'left'
			}, {
				display : 'Asunto',
				name : 'name',
				width : 180,
				sortable : true,
				align : 'left'
			},{
				display : 'Enviado a',
				name : 'numcode',
				width : 120,
				sortable : true,
				align : 'left'
			},{
				display : 'Fecha Envio',
				name : 'numcode',
				width : 120,
				sortable : true,
				align : 'left'
			},{
				display : 'Recibido',
				name : 'recibido',
				width : 120,
				sortable : true,
				align : 'left'
			},{
				display : 'Fecha Recibido',
				name : 'fecharecibido',
				width : 120,
				sortable : true,
				align : 'left'
			}, ],
			/*buttons : [ {
				name : 'Add',
				bclass : 'add',
				onpress : test
			}, {
				name : 'Delete',
				bclass : 'delete',
				onpress : test
			}, {
				separator : true
			} ],*/
			searchitems : [ {
				display : 'ISO',
				name : 'iso'
			}, {
				display : 'Name',
				name : 'name',
				isdefault : true
			} ],
			sortname : "iso",
			sortorder : "asc",
			usepager : true,
			title : 'Correos Enviados',
			useRp : true,
			rp : 15,
			showTableToggleBtn : true,
			width : '100%',
			height : 300
		});

		function test(com, grid) {
			if (com == 'Delete') {
				confirm('Delete ' + $('.trSelected', grid).length + ' items?')
			} else if (com == 'Add') {
				alert('Add New Item');
			}
		}
	</script>

<?php
//include('../../Glimpse/index.php');
require_once("phpGrid_Lit/conf.php");      
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>A Basic PHP Datagrid</title>
</head>
<body> 
<?php
echo $_SESSION["juzgado"];
$dg = new C_DataGrid("SELECT * FROM bandejasalida", "idSalida", "bandejasalida");
//$dg = new C_DataGrid("SELECT bs.idSalida as Codigo, n.Nombres, n.Apellidos, bs.Asunto, bs.Contenido, bs.Fecha, bs.FechaLeido FROM bandejasalida as bs INNER JOIN notificado as n ON bs.idNotificado=n.idNotificado WHERE bs.idJuzgado=".$_SESSION["juzgado"], "Codigo", "bandejasalida");
$dg -> set_row_color('yellow', 'blue', 'lightgray');
$dg -> display();
?>

</body>
</html>