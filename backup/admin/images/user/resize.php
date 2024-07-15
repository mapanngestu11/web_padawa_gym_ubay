<?php
$filename = $_GET['src'];
$percent = $_GET['scale'];
$quality = ($_GET['q'])?$_GET['q']:100;
header('Content-Type: image/jpeg');
$img_type = exif_imagetype($filename);
list($width, $height) = getimagesize($filename);
$newwidth = ($width * 0) + $percent;
$newheight = ($height * 0) + $percent;
$image_p = imagecreatetruecolor($newwidth, $newheight);
if($img_type == 1){
$image = imagecreatefromgif($filename);
}elseif($img_type == 2){
$image = imagecreatefromjpeg($filename);
}elseif($img_type == 3){
$image = imagecreatefrompng($filename);
}
imagecopyresized($image_p, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
imagejpeg($image_p, null, $quality);
imagedestroy($image_p);
?>