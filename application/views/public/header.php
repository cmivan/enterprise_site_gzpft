<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- BEGIN head -->
<head>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<meta name="author" content="cm.ivan@163.com"/>
<meta name="description" content="<?php
 echo $seo['description'];?>">
<meta name="keywords" content="<?php
 echo $seo['keywords'];?>">
<title><?php echo $seo['title']?></title>

<link href="<?php
 echo base_url();?>public/style/style.css" rel="stylesheet" type="text/css">
<link href="<?php
 echo base_url();?>public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
var base_url='<?php echo base_url()?>';var img_url ='<?php echo $style['img_url']?>';var js_url='<?php echo $style['js_url']?>';
</script>
<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
<script type='text/javascript' src="<?php echo base_url();?>public/js/slides.min.jquery.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	//切换banner
	if(jQuery().slides) {
		jQuery("#slider").slides({
			preload: true,
			effect: 'fade',
			fadeSpeed: 250,
			play: 5000,
			crossfade: true,
			generatePagination: false,
			autoHeight: true
		});
	}
});
</script>

</head>