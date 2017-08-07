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
<div class="sidebar productTop2">
  <?php
 $this->load->view('public/left');?>
  <!--END .sidebar -->
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap" style="padding-top:34px;">  

<?php
 if(!empty($list)){?>

<ul id="items" class="image-grid">
<?php
 foreach($list as $item){
	$view_url = site_url('products/scene_view/'.$item->id);?>
    <li>
    <!--BEGIN .hentry -->
    <div class="portfolio type-portfolio status-publish hentry">
    <div class="post-thumb">
    <a href="<?php
 echo $view_url;?>" title="朴风堂<?php
 echo $item->title;?>" target="_blank"><img src="<?php
 echo $item->pic_s;?>" title="<?php
 echo $item->title;?>"  width="210" height="160"></a>
    </div>                         
    <div class="count hidden">1</div>                    
    <h2 class="entry-title"><a href="<?php
 echo $view_url;?>" rel="bookmark" id="menu-products"><?php
 /*?><span class="red">新</span><?php
 */?><?php
 echo $item->title;?></a></h2>
    <div class="clear"></div>
    <!--BEGIN .entry-content -->
<?php
 /*?>
<div class="entry-content">
    <p>Commission for Media associated.co.tld for L.... &nbsp;</p>
    <!--END .entry-content -->
    </div>
<?php
 */?>                     
    <!--END .hentry-->  
    </div>
    </li>
<?php
 }?>      
</ul>
<div class="clear"></div>
<div class="content-paging"><?php
 $this->paging->links(); ?></div>    

<?php
 }else{?>

<div class="no_info"><strong><?php
 echo $pro['noinfo'];?>,
可以先看看我们</strong>
<a style="text-decoration:underline;" href="<?php
 echo site_url('products');?>"><span class="icon-search"></span>其他的产品</a>
<br><br>

</div>

<?php
 }?>

                        

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
<?php
 $this->load->view('public/footer_pro');?>
<style type="text/css">.image-grid li { height: 300px;}</style>

<!--END body-->
</body>
<!--END html-->
</html>