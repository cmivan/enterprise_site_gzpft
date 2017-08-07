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
<div class="entry-content">
                      
<?php
 if(!empty($list)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
<?php

$i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>"><td class="ico">&nbsp;</td>
<td class="title"><?php
 echo $item->title;?></td>
<td align="center" class="time"><a href="<?php echo site_url('download/view/'.$item->id);?>" target="_blank"><span class="icon-download">&nbsp;</span>下载该文档</a></td></tr>
<?php
 }?>
</table>
<div class="clear"></div>
<?php $this->paging->links(); ?>
<?php
 }else{?>

<div class="no_info"><strong>下载中心还没有内容！</strong><br><br></div>

<?php
 }?>
                      
                      <!--END .entry-content -->
                      </div>
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