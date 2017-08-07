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
<?php $this->load->view('public/product_left');?>
<!--END .sidebar -->
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
<?php if(!empty($sBox['p_nav'])){?>
  <tr>
    <td width="80" align="right"><strong>正在查看：</strong></td>
    <td><?php echo $sBox['p_nav'];?></td>
  </tr>
<?php }?>

<?php if(!empty($sBox['p_styles_html'])){?>
<tr><td width="80" align="right"><strong>风格：</strong></td>
<td><?php echo $sBox['p_styles_html'];?></td></tr>
<?php }?>
    
<?php if(!empty($sBox['p_types_html'])&&1==2){?>
<tr><td width="80" align="right"><strong>类型：</strong></td>
<td><?php echo $sBox['p_types_html'];?></td></tr>
<?php }?>
    
<?php if(!empty($sBox['p_types_use_html'])&&1==2){?>
<tr><td width="80" align="right"><strong>细分：</strong></td>
<td><?php echo $sBox['p_types_use_html'];?></td></tr>
<?php }?>
    </table>
</div>

</div>


<?php if(!empty($list)){?>

<div class="content-paging"><?php $this->paging->links(); ?></div>    
<div class="clear"></div>
<ul id="items" class="image-grid">
<?php foreach($list as $item){
	$view_url = site_url('products/view/'.$item->id);
	$_zwh = orderShowSize($item->size_z,$item->size_w,$item->size_h);
	?> 
    <li>
    <!--BEGIN .hentry -->
    <div class="portfolio type-portfolio status-publish hentry">
    <div class="post-thumb">
    <a href="<?php echo $view_url;?>" title="朴风堂<?php echo $item->title;?>" target="_blank"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>" width="210"></a>
    </div>                         
              
    <h2 class="entry-title"><a href="<?php echo $view_url;?>" target="_blank"><?php echo $item->title;?></a></h2>
    <div class="clear"></div>
    <div class="entry-content">
    <p>库存：<?php echo $item->price_vip;?> <?php echo $item->i_title;?></p>
    <p>价格：<?php echo $item->price;?> 元</p>
    <p title="长宽高：<?php echo $_zwh;?>">尺寸：<?php echo $_zwh;?></p>
    <?php if(!empty($item->pro_no)){?><p>编号：<?php echo $item->pro_no;?></p><?php }?>
    </div>  
                  
    <!--END .hentry-->  
    </div>
    </li>
<?php }?>
<div class="clear"></div>
<div class="content-paging"><?php $this->paging->links(); ?></div>          
</ul>

<?php }else{?>
<div class="no_info"><strong><?php echo $pro['noinfo'];?>,
可以先看看我们</strong>
<a style="text-decoration:underline;" href="<?php echo site_url('products');?>"><span class="icon-search"></span>其他的产品</a>
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