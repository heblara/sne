<style type="text/css">
#lstJuzgado{
	width:400px;
}
</style>
<script type="text/javascript">
function validar(){
}
function validarCargo(opc){
  //alert(opc);
	div=document.getElementById("juz").style;
  //alert(div);
	if(opc=='1'){
    div.display="inline-block";
		//document.getElementById("juz").style="";
	}else{
		//document.getElementById("juz").style="display:none;";
    div.display="none";
	}

} </script> 
<form name='addUser' action="?mod=saveUser" method="post"> 
	<table align="center">         
		<caption><b>Agregar usuario al sistema</b></caption>         <tr>         <td>Usuario:</td>
<td><input type="text" maxlength="50" size="20" name="txtUsuario"
required></td>         
</tr>         
<tr> 
  <td>Nombre:</td> <td><input type="text" maxlength="100" size="50"  name="txtNombre" required></td></tr>
  <tr> 
  <td>Apellido:</td> <td><input type="text" maxlength="100" size="50"  name="txtApellido" required></td></tr>
<tr> 
	<td>Cargo:</td> <td>                 
		<select name="lstCargo" id="lstCargo" onchange="validarCargo(this.options[this.selectedIndex].value)" required>
			<option value='0'>Elija un cargo</option> 
			<option value='2'>Administrador de cuentas electr&oacute;nicas &uacute;nicas</option>                     
			<option value='1'>Notificador</option>                
	 	</select> 
	</td> 
</tr>
<tr>
<td colspan="2">
  <div class="ui-widget" id='juz' style="display:none;">
  <label>Juzgado: </label>
  <link rel="stylesheet" href="js/jquery/jquery-ui.css" />
  <script src="js/jquery/jquery-1.9.1.js"></script>
  <script src="js/jquery/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
  <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
    /* support: IE7 */
    *height: 1.7em;
    *top: 0.1em;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 0.3em;
  }
  </style>
  <script>
  (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
 
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
  </script>
  <select id="combobox" name="combobox">
  	<option value='0'>Elegir juzgado</option>
    <?php $consultarJuzgado=$objSisnej->consultar_juzgados();
while($juzgado=$consultarJuzgado->fetch(PDO::FETCH_OBJ)){ 
	echo "<option value='".$juzgado->Contador."'>".$juzgado->Juzgado."</option>"; } ?>
  </select>
</div>
<!--<select name="lstJuzgado" id="lstJuzgado" required disabled="disabled"> <option value='0'>Elija un juzgado</option> 
<?php $consultarJuzgado=$objSisnej->consultar_juzgados();
while($juzgado=$consultarJuzgado->fetch(PDO::FETCH_OBJ)){ 
	echo "<option value='".$juzgado->IdUnidad."'>".$juzgado->Juzgado."</option>"; } ?>
</select> -->
</td> </tr> 
<tr>         
<td>Email:</td>
<td><input type="email" maxlength="100" size="25" name="txtEmail"
required></td> </tr>         <tr>         <td colspan="2"
align="center"><input type="submit" name="cmdEnviar" value="Crear Usuario"
/></td>         </tr>     </table> </form>
