<?php $this->load->view('public/header');?>
<!-- BEGIN body -->
<body class="page page-template page-template-template-portfolio-php ie layout-2cr">

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
                      
<?php if(!empty($list)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table">
<?php
$i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>"><td width="4"></td>
<td class="title"><i class="icon-leaf"></i> <a target="_blank" href="<?php echo site_url('news/view/'.$item->id);?>" title="<?php echo $item->title;?>"><?php echo $item->title;?></a></td>
<td class="time"><?php echo dateTime($item->add_time);?></td></tr>
<?php }?>
</table>
<div class="clear"></div>
<?php $this->paging->links(); ?>
<?php }else{?>

<div class="no_info"><strong>新闻动态还没有内容！</strong><br><br></div>
<?php }?>
                      
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