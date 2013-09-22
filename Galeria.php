<?php 
include_once ('DBManager.class.php'); //Clase de Conexión a las Base de Datos
include('sisnej.class.php');
include("conf.php");
include("conexion.php");
include_once('thumb.php');
define('RESPONSIVE',"js/responsive/");
$id=$_GET["id"];
$objAlbum=New Noticias;
$albumes=$objAlbum->consultar_album($id);
$i=0;
$album=$albumes->fetch(PDO::FETCH_OBJ);
?>
        <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
        <meta name="description" content="Responsive Image Gallery with jQuery" />
        <meta name="keywords" content="jquery, carousel, image gallery, slider, responsive, flexible, fluid, resize, css3" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="<?php echo RESPONSIVE ?>css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo RESPONSIVE ?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo RESPONSIVE ?>css/elastislide.css" />
		<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow&v1' rel='stylesheet' type='text/css' />
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
		<noscript>
			<style>
				.es-carousel ul{
					display:block;
				}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
		<div class="container">	
			<div class="content">
				<h1><?php echo $album->Nombre ?><span><?php echo strip_tags($album->Descripcion) ?></span></h1>
				<div id="rg-gallery" class="rg-gallery">
					<div class="rg-thumbs" style="display:block;">
						<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class="es-carousel-wrapper">
							<div class="es-nav">
								<span class="es-nav-prev">Previous</span>
								<span class="es-nav-next">Next</span>
							</div>
							<div class="es-carousel">
								<ul>
<?php 
	$confoto=$objAlbum->consultar_fotos($album->idAlbum);
	$mythumb = new thumb();
	while($foto=$confoto->fetch(PDO::FETCH_OBJ)){
?>
<!--<li><a href="#">
<img src="<?php echo "galeria/".$album->idAlbum."/thumbs/".$foto->url; ?>" data-large="<?php echo "galeria/".$album->idAlbum."/".$foto->url ?>" alt="<?php echo $foto->url ?>" data-description="<?php echo $album->Nombre ?>" /></a></li>-->
<li><a href="#"><img src="<?php echo "galeria/".$album->idAlbum."/thumbs/".$foto->url; ?>" data-large="<?php echo "galeria/".$album->idAlbum."/".$foto->url ?>" alt="image01" data-description="From off a hill whose concave womb reworded" /></a></li>
<?php
	}
?>
							  </ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->
			</div><!-- content -->
		</div><!-- container -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo RESPONSIVE ?>js/jquery.tmpl.min.js"></script>
		<script type="text/javascript" src="<?php echo RESPONSIVE ?>js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?php echo RESPONSIVE ?>js/jquery.elastislide.js"></script>
		<script type="text/javascript" src="<?php echo RESPONSIVE ?>js/gallery.js"></script>