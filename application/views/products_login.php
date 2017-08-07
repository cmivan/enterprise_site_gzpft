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
    <td width="80" align="right"><strong>已选择：</strong></td>
    <td><?php echo $sBox['p_nav'];?></td>
  </tr>
<?php }?>

  <tr>
    <td width="80" align="right"><strong>风格：</strong></td>
    <td><?php echo $sBox['p_styles_html'];?></td>
    </tr>

  <tr>
    <td width="80" align="right"><strong>类型：</strong></td>
    <td><?php echo $sBox['p_types_html'];?></td>
    </tr>
    
<?php if(!empty( $sBox['p_types_use_html'] )){?>
  <tr>
    <td width="80" align="right"><strong>细分：</strong></td>
    <td><?php echo $sBox['p_types_use_html'];?></td>
  </tr>
<?php }?>
</table>

</div>
</div>

<div class="no_info product_login">

<form class="form-inline" method="post">
<input type="password" value="<?php echo $password;?>" name="password" placeholder="请在这里填写密码!"/>
<input type="hidden" value="ok" name="action"/>
<button type="submit" class="btn"><i class="icon-download"></i>查看产品</button>
</form>

<?php if($errtip!=''){?>
<span class="red">温馨提示：<?php echo $errtip;?></span>
<?php }?>

</div>

</div>
</div>
<!-- END #content -->
</div>
<!-- END #container -->
</div> 	
    
<!-- BEGIN #footer-container -->
<?php $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>