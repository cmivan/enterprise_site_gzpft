<?php
 $this->load->view('public/header');?>

<!-- BEGIN body -->
<body class="page page-id-4527 page-template page-template-template-portfolio-php ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<?php
 $this->load->view('public/top');?>
		<!--BEGIN #content -->
		<div id="content" class="clearfix">

            <div class="page-title">艺术木境&nbsp;-&nbsp;意象随形</div>
            <div class="clear"></div>

            <!--BEGIN #recent-portfolio  .home-recent -->
            <div id="recent-portfolio" class="home-recent portfolio-recent clearfix">
            	
<!--BEGIN .sidebar -->
<div class="sidebar" style="padding-top:48px;">
  <?php
 $this->load->view('public/left');?>
  <!--END .sidebar -->
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap">  

<div id="search-box" style=" padding-bottom:5px;">

<div class="clear"></div>

<div id="search-select-box">
<div id="search-select-items">
<?php
 echo $site['sitename'];?> <span style="font-weight:lighter">拥有各种各样的原木家具产品！</span>
</div>
</div>

<div class="no_info product_login">

<?php
 $this->load->view('public/left_login_box');?>

</div>

</div>
</div>
<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    </div>
<!-- BEGIN #footer-container -->
<?php
 $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>