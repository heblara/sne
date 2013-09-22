		/*
		--------------------------------------------------------------------------------
		| EJEMPLO Y SCRIPT ADAPTADO AL ESPAÑOL POR http://blog.reaccionestudio.com/    |
		--------------------------------------------------------------------------------
		|	VISÍTANOS !!!                                                              |
		--------------------------------------------------------------------------------
		*/
			function alerta(text){
				//un alert
				alertify.alert(text, function () {
					//aqui introducimos lo que haremos tras cerrar la alerta.
					//por ejemplo -->  location.href = 'http://www.google.es/';  <-- Redireccionamos a GOOGLE.
				});
			}
			
			function confirmar(text,not){
				//un confirm
				alertify.confirm(text, function (e) {
					if (e) {
						eliminarnot(not);
						//alertify.success("Has pulsado '" + alertify.labels.ok + "'");
					} else { //alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
					}
				}); 
				return false
			}
			
			function datos(text){
				//un prompt
				alertify.prompt(text, function (e, str) { 
					if (e){
						alertify.success("Has pulsado '" + alertify.labels.ok + "'' e introducido: " + str);
					}else{
						alertify.error("Has pulsado '" + alertify.labels.cancel + "'");
					}
				});
				return false;
			}
			
			function notificacion(text){
				alertify.log(text); 
				return false;
			}
			
			function ok(text){
				alertify.success(text); 
				return false;
			}
			
			function error(text){
				alertify.error(text); 
				return false; 
			}
