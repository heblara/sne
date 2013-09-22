function nuevoAjax()
{ 
	/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
	lo que se puede copiar tal como esta aqui */
	var xmlhttp=false;
	try
	{
		// Creacion del objeto AJAX para navegadores no IE
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			// Creacion del objet AJAX para IE
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(E)
		{
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') xmlhttp=new XMLHttpRequest();
		}
	}
	return xmlhttp; 
}


function numNit(e,totCadena){ 
if(totCadena.length<14){
tecla2 = (document.all) ? e.keyCode : e.which; 
    if (tecla2==8 || tecla2==0) return true;
    patron =/[0-9]/;
	te = String.fromCharCode(tecla2);
	return patron.test(te);
}
}//fin de la funcion allcaracter


function tecla(e){
teclaP = (document.all) ? e.keyCode : e.which; 
    //if (teclaP==8 || teclaP==0) return true;
	if(teclaP==49){
		document.getElementById("rdSi").checked=true;
	}else if(teclaP==50){
		document.getElementById("rdNo").checked=true;
	}
	
	//verificacion de la tecla enter
	if((teclaP==13) && ((document.getElementById("rdSi").checked==true)||(document.getElementById("rdNo").checked==true))){

		//verificion de si
		if(document.getElementById("rdSi").checked==true){
			setTimeout($.unblockUI, 1); //cierra el formulario
			//informacion en el formulario
			var nom=document.getElementById("tConfirmacion").rows[0].cells[0].innerHTML;
			var h3=document.createElement("h3");
			h3.innerHTML=nom;
			document.getElementById("divNombre").appendChild(h3);
			document.getElementById("cargarNombre").removeAttribute("onkeypress");
			//colocando funciones de teclas en el div
			document.getElementById("divPregunta").setAttribute("onkeypress","teclaRespuesta(event)");
			document.getElementById("divPregunta").setAttribute("onclick","document.getElementById('opcion1').focus()");
			document.getElementById("divPregunta").setAttribute("onblur","document.getElementById('opcion1').focus()");
			//asignacion de valor
			document.getElementById("txtNitP").value=document.getElementById("txtNit").value;
			document.getElementById("opcion1").focus();
		}else{
			document.getElementById("cargarNombre").innerHTML="";	
			document.getElementById("txtNit").value="";
			document.getElementById("txtNit").focus();
		}
	}

}//fin de funcion tecla


function teclaRespuesta(e){
teclaP = (document.all) ? e.keyCode : e.which; 
    //if (teclaP==8 || teclaP==0) return true;
	if(teclaP==49){
		document.getElementById("opcion1").checked=true;
	}else if(teclaP==50){
		document.getElementById("opcion2").checked=true;
	}else if(teclaP==51){
		document.getElementById("opcion3").checked=true;
	}

}//fin de funcion tecla

function validarFormulario(){
	var opc1=document.getElementById("opcion1").checked;
	var opc2=document.getElementById("opcion2").checked;
	var opc3=document.getElementById("opcion3").checked;
	
	if((opc1==true)||(opc2==true)||(opc3==true)){
		//asignacion de valo
		if(opc1==true){
			document.getElementById("txtOpcion").value=document.getElementById("opcion1").value;
		}else if(opc2==true){
			document.getElementById("txtOpcion").value=document.getElementById("opcion2").value;
		}else{
			document.getElementById("txtOpcion").value=document.getElementById("opcion3").value;	
		}
	return true;
	}else{
	alert("Debe de seleccionar una opcion");	
	return false;
	}	
}


function cargarNombre(cadena){
	//creacionFormulario('hola');
	//validacion de los 14 digitos 
	if(cadena.length==14){
		var text;
		//busqueda en ajax
		divResultado=document.getElementById("cargarNombre");
		divResultado.innerHTML="";
		var ajax=nuevoAjax();
		ajax.open("GET","buscarNit.php?NIT="+cadena,true);
		ajax.onreadystatechange=function(){
			if(ajax.readyState==4){
				//partir cadena
				var cadServidor=(ajax.responseText).split("*");
				//verifiacion de la accion
				if((cadServidor[1]=="1") || (cadServidor[1]=="2")){
					if(cadServidor[1]=="1"){
						text="Registro no encontrado"
					}else{
						text=cadServidor[0]+" <br>Usted ya voto";	
					}
					divResultado.setAttribute("style","background:#FFF; color:#F00; width:45%");
					divResultado.innerHTML=(text).toUpperCase();	
				}else{
					//divResultado.innerHTML=(ajax.responseText).toUpperCase();	
					creacionFormulario(cadServidor[0])
				}//fin de if que comprueba la accion a realizar
			}
		}
		ajax.send(null)
	}//fin de validacion de 14 digitos
}//fin de la funcion


function creacionFormulario(nombre){
divResultado=document.getElementById("cargarNombre");
divResultado.setAttribute("style","background:#FFF; color:#000; width:45%");

/*var p=document.createElement("h4");
p.innerHTML="¿Confirme si es su nombre? (Tecla: 1=Si; 2=No; Enter=Confirmar)";
divResultado.appendChild(p);*/

var form=document.createElement("form");
form.setAttribute("id","frmConfirmacion");
form.setAttribute("name","frmConfirmacion");

var table=document.createElement("table");
table.setAttribute("id","tConfirmacion");
table.setAttribute("border","0");
table.insertRow(0);
table.rows[0].insertCell(0).innerHTML="Nombre: "+nombre;
table.rows[0].cells[0].setAttribute("colspan","3");


table.insertRow(1);
table.rows[1].insertCell(0).innerHTML="Seleccione una opcion y Presione la tecla Enter";
table.rows[1].cells[0].setAttribute("colspan","3");
table.rows[1].cells[0].setAttribute("align","center");

table.insertRow(2);

var img1=document.createElement("img");
img1.setAttribute("WIDTH","32");
img1.setAttribute("HEIGHT","32");
img1.setAttribute("border","0");
img1.setAttribute("src","img/like.gif");
img1.setAttribute("Title","Presione el numero 1");
table.rows[2].insertCell(0);
table.rows[2].cells[0].setAttribute("align","center");
table.rows[2].cells[0].appendChild(img1);
//table.rows(1).cells(0).setAttribute("colspan","2");

var img2=document.createElement("img");
img2.setAttribute("WIDTH","32");
img2.setAttribute("HEIGHT","32");
img2.setAttribute("border","0");
img2.setAttribute("src","img/dislike.gif");
img2.setAttribute("Title","Presione el numero 2");
table.rows[2].insertCell(1);
table.rows[2].cells[1].setAttribute("align","center");
table.rows[2].cells[1].appendChild(img2);


table.insertRow(3);

var radio1=document.createElement("input");
radio1.setAttribute("type","radio");
radio1.setAttribute("id","rdSi");
radio1.setAttribute("name","rd");
radio1.setAttribute("value","Si");
table.rows[3].insertCell(0);
table.rows[3].cells[0].setAttribute("align","center");
table.rows[3].cells[0].appendChild(radio1);
//table.rows(1).cells(0).setAttribute("colspan","2");

var radio2=document.createElement("input");
radio2.setAttribute("type","radio");
radio2.setAttribute("id","rdNo");
radio2.setAttribute("name","rd");
radio2.setAttribute("value","No");
table.rows[3].insertCell(1);
table.rows[3].cells[1].setAttribute("align","center");
table.rows[3].cells[1].appendChild(radio2);

form.appendChild(table);
divResultado.appendChild(form);

//form.focus();
document.getElementById("rdSi").focus();
document.getElementById("cargarNombre").setAttribute("onkeypress","tecla(event)");
document.getElementById("cargarNombre").setAttribute("onclick","document.getElementById('rdSi').focus()");
document.getElementById("cargarNombre").setAttribute("onblur","document.getElementById('rdSi').focus()");
}//fin de creacionFormulario
