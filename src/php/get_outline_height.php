<?php
if(!isset($_GET['window_width'])){exit();}
if(!isset($_GET['img_number'])){exit();}
require_once ('config.php');
$window_width=(int)$_GET['window_width']*0.192;
$file='../thumbnail/'.$_GET['img_number'].'.jpg';
$picture=getimagesize($file);
echo (((int)$window_width/$picture[0])*$picture[1]+12);
?>