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
<div class="sidebar productTop">
  <?php $this->load->view('public/left');?>
</div>
                                
<!--BEGIN .recent-wrap -->
<div class="recent-wrap">  

<div id="search-box">
<form class="form-search">
<input type="text" name="keyword" placeholder="可以在这里填写你想找的产品..." value="<?php echo $sBox['keyword'];?>" />
<button type="submit" class="btn"><span class="icon-search"></span>搜索一下</button>
</form>
<div class="clear"></div>

<div id="search-select-box">
<div id="search-select-items">
&nbsp;<?php if($sBox['keyword']!=''){?><span>“<?php echo $sBox['keyword'];?>”</span> 找到 <b><?php echo $listRows;?></b> 件相关商品
<?php }else{?>
<?php echo $site['sitename'];?> <span style="font-weight:lighter">拥有各种各样的原木家具产品！</span>
<?php }?></div>

<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" class="table table-condensed">
<?php if(!empty( $sBox['p_types_use_html'] )){?>
  <tr>
    <td width="90" align="right"><strong>新品分类：</strong></td>
    <td><?php echo $sBox['p_types_use_html'];?></td>
  </tr>
<?php }?>
</table>
</div></div>

<?php if(!empty($list)){?>
<div class="clear"></div>
<ul id="items" class="image-grid">
<?php foreach($list as $item){
	$view_url = site_url('products/view/'.$item->id); ?> 
    <li data-id="id-1">
    <!--BEGIN .hentry -->
    <div class="portfolio type-portfolio status-publish hentry">
    <div class="post-thumb">
    <a href="<?php echo $view_url;?>" title="朴风堂<?php echo $item->title;?>" target="_blank"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>"  width="214"></a>
    </div>                         
     
    <h2 class="entry-title"><a href="<?php echo $view_url;?>" target="_blank" id="menu-products" rel="bookmark"><span class="red">新</span><?php echo $item->title;?></a></h2>
    <div class="clear"></div>    
    <!--BEGIN .entry-content -->

<div class="entry-content"><p><?php echo toText($item->note);?></p></div>                       

    </div>
    </li>
<?php }?>
<div class="clear"></div>
<div class="content-paging"><?php $this->paging->links(); ?></div>          
</ul>

<?php }else{?>

<div class="no_info"><strong><?php echo $pro['noinfo'];?>,可以先看看我们</strong>
<br><br>
</div>

<?php }?>

                        

<!--END .recent-wrap -->
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