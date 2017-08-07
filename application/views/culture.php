<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- BEGIN head -->
<head>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

<meta name="author" content="cm.ivan@163.com"/>
<meta name="description" content="<?php echo $seo['description'];?>">
<meta name="keywords" content="<?php echo $seo['keywords'];?>">
<title><?php echo $seo['title']?></title>

<link href="<?php echo base_url();?>public/style/culture.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
var base_url='<?php echo base_url()?>';var img_url ='<?php echo $style['img_url']?>';var js_url='<?php echo $style['js_url']?>';
</script>
<script type="text/javascript" src="<?php echo $style['jq_url'];?>"></script>
</head>
<!-- BEGIN body -->
<body>


<div id="body_main">
  <?php if(!empty($list)){?>
  
  <div class="phone_waterfall">
  <?php $this->load->view('culture_page');?>
  </div>
  
  <div class="clear">&nbsp;</div>
  <div id="pagenavi" title="<?php echo $this->paging->pageCount; ?>">&nbsp;</div>
  
  <?php }else{?>
  <!--content-none-->
  <div style="width:220px; margin:auto;">
  <div class="no-info"><a href="<?php echo site_url('index');?>">还没添加文化墙内容哦,先回到首页看看吧！</a></div>
  </div>
  <?php }?>
</div>

<div class="clear">&nbsp;</div>
<div id="footer-wall">&nbsp;</div>

<div id="cate" title="easeInQuad" alt="1" noajax=""></div>
<script type="text/javascript" language="javascript" src="/public/js/waterfall/jquery.waterfall.js"></script>
<script type="text/javascript" language="javascript" src="/public/js/waterfall/waterfall.js"></script>

<!--END body-->
</body>
<!--END html-->
</html>