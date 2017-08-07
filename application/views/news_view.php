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
<div class="sidebar sidebarTop">
  <?php
 $this->load->view('public/left');?>
  <!--END .sidebar -->
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap wrapTop">


<div class="content-text">

<div class="content-where">
<?php
 echo $site['where'];?>
：
<?php
 echo getnav($nav,'index', $site['sitename'] );?>
 / 
<?php
 echo getnav($nav,'news');?>
 / 
<a href="<?php
 echo site_url('news/view/'.$view->id);?>"><?php
 echo $view->title;?></a>
</div>

<div class="content-text-note">
    <h1><?php
 echo $view->title;?></h1>
    <?php
 if(!empty($view->note)){?><span><strong><?php
 echo $site['note'];?>：</strong><?php
 echo $view->note;?><?php
 }?></span>
</div>
<div class="content-view"><?php
 echo $view->content;?></div>
</div>
                     

<!--END .recent-wrap -->
</div>
<!--END #recent-portfolio .home-recent -->
</div>
<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    
<!-- BEGIN #footer-container -->
<?php
 $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>