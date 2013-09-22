<!---->
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
<style>
/*.lof-snleft .lof-main-outer {
	float:right;
}*/
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
<!------------------------------------- THE CONTENT ------------------------------------------------->
<div id="wrapper">
	<div id="article">	
<!--<div id="lofslidecontent45" class="lof-slidecontent  lof-snleft">
  <div>
    <ul class="lof-navigator">-->
    	<?php 
		$conNoticia=$objNoticia->consultar_noticias();
		$c=$conNoticia->rowCount();
		//echo $c;
		if($c>0){
		while($resNoticia=$conNoticia->fetch(PDO::FETCH_OBJ)){ 
		?>
        <!--<li>-->
        <blockquote>
        <?php echo $resNoticia->Fec ?> - <?php echo "<b>".$resNoticia->Titulo."</b><br>"; ?>
			<img src='galeria/noticias/<?php echo $resNoticia->Imagen ?>' width='100' style="float:left; padding-right:10px;" /><?php echo substr(strip_tags($resNoticia->Resumen),0,200) ?>... <a href='#'>Leer mas</a>
        </blockquote>
        <!-- </li> -->
		<?php
		}
		}else{
			echo "No hay noticias";
		}
		?>
        
    <!--</ul>-->
    
 </div>
</div>
<!------------------------------------- END OF THE CONTENT ------------------------------------------------->