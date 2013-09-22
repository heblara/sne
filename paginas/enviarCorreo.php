<script>
/*$(document).ready(function(){
	console.log($("#guardar"));
	$("#guardar").click(function(){
		var formulario = $("#frmEnviar").serializeArray();
		$.ajax({
			type: "POST",
			dataType: 'json',
			url: "procesos/sendMail.php",
			data: formulario,
		}).done(function(respuesta){
			//$("#mensaje").html(respuesta.mensaje);
			if(respuesta.mensaje==1){
				error("Por favor llene todos los campos");
			}else if(respuesta.mensaje==2){
				error("Algo anduvo mal, por favor intentelo de nuevo");
			}else if(respuesta.mensaje==3){
				ok("Notificacion enviada con exito");
			}
		});
	});
});*/
</script>
<script type="text/javascript">bkLib.onDomLoaded(function() {
		 new nicEditor({iconsPath : 'images/nicEditorIcons.gif'}).panelInstance('txtContenido');
		 });</script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		// General options
		mode : "exact",
		elements : "txtContenido",
		theme : "advanced",
		skin : "default",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,copy,paste,pastetext,bullist,numlist,blockquote",
		theme_advanced_buttons2 : "undo,redo,|,link,unlink,|,insertdate,inserttime,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,fullscreen",
		theme_advanced_buttons3 : "",
		//theme_advanced_buttons4 : "cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
<!-- RECURSOS PARA EL BUSCADOR DE FUNCIONARIOS-->
	<link rel="stylesheet" href="test.css" type="text/css" media="screen" title="Test Stylesheet" charset="utf-8" />
	<script src="js/search/protoculous-effects-shrinkvars.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/search/textboxlist.js" type="text/javascript" charset="utf-8"></script>
	<script src="js/search/test.js" type="text/javascript" charset="utf-8"></script>

	<script>
	function validar(){
		var funcionario=document.datosCorreo.idFuncionario.value;
		var dato=$F('facebook-demo').split("###");
		tlist2.update();
		//alert("Valor: "+dato[0]);
		if($F('facebook-demo')!=""){
			document.datosCorreo.idFuncionario.value=$F('facebook-demo');
			//enviarnot();
			return true;
			//return true;	
		}else{
			error("Es necesario ingresar una Cuenta Electrónica Única");
			return false;
		}
	}
	</script>


<!-- FIN DE RECURSOS FUNCIONARIOS-->
<!--
<script type="text/javascript" src="Scripts/nicEdit.js"></script>
<script type="text/javascript">
//	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
	bkLib.onDomLoaded(function() {
//			new nicEditor({fullPanel : true).panelInstance('txtContenido');
new nicEditor({iconsPath : 'images/nicEditorIcons.gif'}).panelInstance('txtContenido');
//new nicEditor({fullPanel : true}).panelInstance('txtContenido'); 

			//new nicEditor({fullPanel : true}).panelInstance('txtContenido');
			
			
			
//			new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('txtContenido');
	//new nicEditor({maxHeight : 200}).panelInstance('txtContenido');
	});
</script>-->
<table align='center'>
<tr>
<td>
<h1>ENVIO DE NOTIFICACIÓN</h1><h2 align='center'>Ingresa la Cuenta Electr&oacute;nica &Uacute;nica a la que se enviar&aacute; la notificaci&oacute;n</h2>
</td>
</tr>
<form name='datosCorreo' id="frmEnviar" enctype="multipart/form-data" onsubmit="return validar();" action="?mod=sendMail" method="post">
<tr>
<td>
<div title="Escriba el nombre de cada uno de los notificados, mientras escriba le mostrara los magistrados existentes, si alguno no aparece favor agreguelo antes." style="cursor:pointer;"><b>(?)</b></div></sup>
	<div id="text">
	</div>
    <div id="facebook-list" class="input-text">
    	Destinatario:
      <textarea id="facebook-demo" placeholder="Comience a digitar el nombre o la CEU del litigante"></textarea>

      <input type="hidden" id="idFuncionario" name="idFuncionario" />	
      <div id="facebook-auto">
        <div class="default">Lista de personas.</div> 
        <ul class="feed">
        </ul>
      </div>
    </div>
    
          <script language="JavaScript">
	        document.observe('dom:loaded', function() {
	          // init
	          tlist2 = new FacebookList('facebook-demo', 'facebook-auto',{fetchFile:'fetched.php'});
	          // fetch and feed
	          new Ajax.Request('json.php', {
	            onSuccess: function(transport) {
	                transport.responseText.evalJSON(true).each(function(t){tlist2.autoFeed(t)});
	            }
	          });
	        });    
    </script>
    </div> 
</td>
</tr>
<tr>
<td>Asunto: <input type='text' name="txtAsunto" id="txtAsunto" required="required" size="100" placeholder="Ingrese el asunto de la notificación" /></td>
</tr>
<tr>
<td>
Contenido:
</td>
</tr>
<tr>
<td>
<textarea cols="85" name="txtContenido" id="txtContenido" style="background-color:white;z-index:-3000;"></textarea>
</td>
</tr>
<tr>
<td>
<input type="file" name="documento" id="documento" accept="application/pdf" />
</td>
</tr>
<tr>
<td><input type="submit" name="submit" class="submit" id="guardar" value="Enviar notificacion" /></td>
</tr>
</form>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
</table>