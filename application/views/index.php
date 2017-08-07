<?php
 $this->load->view('public/header');?>
<!-- BEGIN body -->
<body class="home">
<!-- BEGIN #container -->
<div id="container">
<!-- BEGIN #header -->
<?php
 $this->load->view('public/top');?>
<!--BEGIN #content -->
<div id="content" class="clearfix">

<!--BEGIN #home-message -->
<div id="home-message"><div style="text-align:center; padding-top:12px; color:#666; letter-spacing:20px;">中国个性原木家居领航者</div></div>
<!--END #home-message -->

<!--BEGIN #slider .clearfix -->
<?php
 $this->load->view('public/banner');?>

<!--BEGIN #recent-portfolio  .home-recent -->
<div id="recent-portfolio" class="home-recent clearfix ">
<!--BEGIN .sidebar -->
<div class="sidebar">
<?php
 $this->load->view('public/left');?>
<!--END .sidebar -->
</div>

<!--BEGIN .recent-wrap -->
<div class="recent-wrap">
<!--BEGIN .hentry-wrap --><div class="hentry-wrap clearfix">
<!--BEGIN .hentry --><div class="portfolio type-portfolio status-publish hentry"><div class="post-thumb"><a title="链接到品牌故事" href="<?php
 echo site_url('about_us');?>"><img src="/public/images/pft/IMG_7974.JPG" width="210" height="160"></a></div><div class="entry-title"><?php
 echo getnav($nav,'about_us');?></div>
<div class="clear"></div>

<!--BEGIN .entry-content --><div class="entry-content"><p><?php
 echo $about_us_note;?></p><!--END .entry-content --></div><!--END .hentry--></div>
<!--BEGIN .hentry -->
<div class="portfolio type-portfolio status-publish hentry"><div class="post-thumb"><a title="链接到产品中心" href="<?php
 echo site_url('products');?>"><img src="/public/images/pft/IMG_8123.JPG" width="210" height="160"></a></div><div class="entry-title"><?php
 echo getnav($nav,'products');?></div>
<div class="clear"></div>
<!--BEGIN .entry-content -->
<div class="entry-content"><p>原生态实木家具的领航者。2005年4月创建于广州番禺。主生产老木家具及家居饰品，主原料取自全国各民间拆旧老房料，以老榆木、老樟木、老船木为主，经设计师的巧妙设计和朴风堂工匠纯手工打造而成 &#8230;</p><!--END .entry-content --></div><!--END .hentry--></div>

<!--BEGIN .hentry -->
<div class="portfolio type-portfolio status-publish hentry" style="margin-right:0;"><div class="post-thumb"><a title="链接到加盟合作" href="<?php
 echo site_url('cooperation');?>"><img src="/public/images/pft/IMG_8295.JPG" width="210" height="160"></a></div><div class="entry-title"><?php
 echo getnav($nav,'cooperation');?></div>
<div class="clear"></div>
<!--BEGIN .entry-content -->
<div class="entry-content"><p><?php
 echo $cooperation_note;?></p><!--END .entry-content --></div><!--END .hentry--></div>
<!--END .hentry-wrap--><div style="clear:both;">&nbsp;</div><div><a href="<?php
 echo site_url('about_us/culture');?>" target="_blank"><img src="/public/images/10nian.gif"/></a></div></div><!--END .recent-wrap --></div>
</div>
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