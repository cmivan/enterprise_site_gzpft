<?php $this->load->view('public/header');?>
<!-- BEGIN body -->
<body class="page page-id-4527 page-template page-template-template-portfolio-php ie layout-2cr">

	<!-- BEGIN #container -->
	<div id="container">
	
		<!-- BEGIN #header -->
		<?php $this->load->view('public/top');?>
		<!--BEGIN #content -->
		<div id="content" class="clearfix">

            <div class="page-title">艺术木境&nbsp;-&nbsp;意象随形</div>
            <div class="clear"></div>

<!--BEGIN #recent-portfolio  .home-recent -->
<div id="recent-portfolio" class="home-recent portfolio-recent clearfix">
            	
<!--BEGIN .sidebar -->
<div class="sidebar pageTop">
  <?php $this->load->view('public/left');?>
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap pageTop">  
<div class="entry-content"><?php echo $view->content;?></div>
</div>
<!--END #recent-portfolio .home-recent -->
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