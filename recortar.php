<?php 
function createthumb($name,$filename,$new_w,$new_h,$type){
	$system=explode('.',$name);
	if ($type == "jpg" || $type == "jpeg"){
		$src_img=imagecreatefromjpeg($name);
	}
	if ($type == "png"){
		$src_img=imagecreatefrompng($name);
	}
	if ($type == "gif"){
		$src_img=imagecreatefromgif($name);
	}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y) {
		$thumb_w=$new_w;
		$percent = ($new_w * 100) / $old_x;
		$thumb_h = ($percent * $old_y) / 100;
	}
	if ($old_x < $old_y) {
		$percent = ($new_h * 100) / $old_y;
		$thumb_w = ($percent * $old_x) / 100;
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y) {
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y); 
	
	if ($type == "png")
	{
		imagepng($dst_img,$filename); 
	}
	if ($type == "gif")
	{
		imagegif($dst_img,$filename); 
	} 
	if ($type == "jpg" || $type == "jpeg")
	{	
		imagejpeg($dst_img,$filename); 
	}
	imagedestroy($dst_img); 
	imagedestroy($src_img); 
}
?>