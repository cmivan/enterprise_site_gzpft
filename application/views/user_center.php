<?php $this->load->view('public/header');?>
<link href="<?php echo base_url();?>public/style/products.css" rel="stylesheet" type="text/css">

<!-- BEGIN body -->
<body class="page page-template-template-portfolio-php ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<?php $this->load->view('public/top');?>
		<!--BEGIN #content -->
<div id="content" class="clearfix">

<div class="page-title">艺术木境&nbsp;-&nbsp;意象随形</div>
<div class="clear"></div>

<div id="user_center">
 <div class="box" id="user_center_edit"><a href="<?php echo site_url('user');?>" target="_blank">user_center_products</a></div>
 <div class="box" id="user_center_products"><a href="<?php echo site_url('products');?>" target="_blank">user_center_products</a></div>
 <div class="box" id="user_center_activity"><a href="<?php echo site_url('user/activity');?>" target="_blank">user_center_activity</a></div>
 <div class="box" id="user_center_download"><a href="<?php echo site_url('download');?>" target="_blank">user_center_download</a></div>
</div>

<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    
<!-- BEGIN #footer-container -->
<?php $this->load->view('public/footer');?>
<?php $this->load->view('public/footer_pro');?>

<!--END body-->
</body>
<!--END html-->
</html>