<script language="javascript" type="text/javascript" src="js/jquery.easing.js"></script>
<script language="javascript" type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
 $(document).ready( function(){	
		$('#lofslidecontent45').lofJSidernews( { interval:5000,
											 	easing:'easeOutBounce',
												duration:1200,
												auto:true } );						
	});

</script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/sv_style.css" />
<style>
.lof-snleft .lof-main-outer {
	float:right;
}
/* move the main wapper to the right side */
	.lof-snleft .lof-main-wapper {
	margin-left:0;
	margin-right:inherit;
	clear:both;
	height:80px;
}
/* move the navigator to the left  side */
	.lof-snleft .lof-navigator-outer {
	left:0;
	top:0;
	right:inherit;
}
ul.lof-main-wapper li {
	position:relative;
}
/*Flecha derecha*/
.lof-snleft .lof-navigator .active {

}
.lof-snleft .lof-navigator li div {
	margin-left:0px;
	margin-right:2px;
}
.lof-snleft .lof-navigator li.active div {
	margin-left:inherit;
	margin-right:2px;
}
</style>
</head><body>
<!------------------------------------- THE CONTENT ------------------------------------------------->
<div id="lofslidecontent45" class="lof-slidecontent  lof-snleft">
  <div class="preload"></div>
  <!-- NAVIGATOR -->
  
  <div class="lof-navigator-outer">
    <ul class="lof-navigator">
		<?php 
		$conNoticia=$objNoticia->consultar_noticias();
		$c=$conNoticia->rowCount();
		//echo $c;
		if($c>0){
		
		while($resNoticia=$conNoticia->fetch(PDO::FETCH_OBJ)){ 
			echo "<li><span><b>".$resNoticia->Titulo."</b></span><br><img src='galeria/noticias/".$resNoticia->Imagen."' width='100' class='img' />".$resNoticia->Fec."<br>".strip_tags(substr($resNoticia->Resumen,0,150))."<br><a href='#'>Leer mas</a><br /></li>";
		}
		}else{
			echo "No hay noticias";
		}
		?>
        <?php
        /*$fecha= explode("-",$dpRows['FECHA']);
        $nuevafecha=meses($fecha[1])."-".$fecha[2]."-".$fecha[0];
        echo "<span class='home_rows_event_date_month'>".$nuevafecha."</span>"; 
        ?>
                <br>
          <?php echo $dpRows['ANUNCIO'];?>
      <?php
		 $dpRows = mysql_fetch_array($dpQuery);*/
		//}//fin while
    ?>
    </ul>
  </div>
  
  <!-- MAIN CONTENT -->
  <!--<div class="lof-main-outer">
    <ul class="lof-main-wapper">
      <?php
		 //Aqui se generan imagenes en blanco sino no funcionara
		 /*$dpJ=0;
		 for($dpJ=0;$dpJ<=$dpI;$dpJ++){
        ?>
      <li> <img src="images/blank.gif" title="dp" height="64" width="64">
        <div class="lof-main-item-desc">
        </div>
      </li>
      <?php
		 }*/
        ?>
    </ul>
  </div>-->
  <!-- END MAIN CONTENT --> 
</div>

<!------------------------------------- END OF THE CONTENT ------------------------------------------------->
<?php
//cerrando conexion y liberando recursos
/*if($dpQuery){
	mysql_free_result($dpQuery);
}*/
?>