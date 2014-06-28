<?php 
$slider_type = get_option('mainpage_page_title');
if($slider_type == 7 or $slider_type == 6 or $slider_type == 5){ ?>
<div class="container_12" style="width:1000px; position:relative;">
<?php  }else{ ?>
<div class="container_12" style="width:1000px; line-height: 0px;">
<?php  } ?>
<?php 
if($slider_type == 1){
	//require(TEMPLATEPATH . 'framework/slideshows/nivo-slider.php');
}elseif($slider_type == 2){
	//require(TEMPLATEPATH . 'framework/slideshows/custom-text.php');
}elseif($slider_type == 3){
	//require(TEMPLATEPATH . 'framework/slideshows/custom-image.php');
}elseif($slider_type == 4){
	//require(TEMPLATEPATH . 'framework/slideshows/3d-slider.php');
}elseif($slider_type == 5){
	//require(TEMPLATEPATH . 'framework/slideshows/accordion-slider.php');
}elseif($slider_type == 6){
	//require(TEMPLATEPATH . 'framework/slideshows/coin-slider.php');
}elseif($slider_type == 7){
	//require(TEMPLATEPATH . 'framework/slideshows/anything-slider.php');
}elseif($slider_type == 8){
	//require(TEMPLATEPATH . 'framework/slideshows/ad-gallery.php');
}
?>