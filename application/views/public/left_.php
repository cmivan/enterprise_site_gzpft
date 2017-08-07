<div class="sidebar_main">

<?php $this->load->view('public/left_login_ok');?>

<div class="sidebar_left">
<div class="clear"></div>
<div><strong><?php echo getnav($nav,'news');?></strong></div>

<div id="home-promo">
<?php if(!empty($top_news)){?>
<script type="text/javascript">
<?php /*?>滚动信息<?php */?>
$(function(){ $("#news_rolling").Scroll({line:1,speed:500,timer:3000,up:"news_rolling_up",down:"news_rolling_down"}); });
</script>

<div id="news_rolling">
<ul>
<?php foreach($top_news as $item){?>
<li>
<h1><a href="<?php echo site_url('news/view/'.$item->id);?>" title="<?php echo $item->title;?>"><?php echo cutstr($item->title,14);?></a></h1>
<p><?php echo $item->note;?></p>
</li>
<?php }?>
</ul></div>
<?php }?>


<?php if(!empty($products_ok)){ $i = 0; ?>
<?php foreach($products_ok as $item){ $i++; ?>
<div id="home-promo-img"<?php if($i%2==0){echo ' style="margin-right:0;"';}?>><a href="<?php echo site_url('products/view/'.$item->id);?>"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>" alt="<?php echo $item->title;?>"></a></div>
<?php }}?>
</div>
<div class="clear"></div>
</div>

<?php $this->load->view('public/left_login_box');?>

<div class="sidebar_left">&nbsp;</div>

</div>