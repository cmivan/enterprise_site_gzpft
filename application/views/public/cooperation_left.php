<div id="content-form">
<div id="home-promo">

<?php
 /*?><h4><?php
 echo $nav['cooperation'];?></h4><?php
 */?>
<?php
 if(!empty($list)){ $i = 0; ?>
<?php
 foreach($list as $item){ $i++; ?>
<div class="home-promo-img"<?php
 if($i%2==0){echo ' style="margin-right:0;"';}?>><a class="cooperation_item" href="<?php
 echo site_url('cooperation/view/'.$item->id);?>"><?php
 echo $item->title;?></a></div>
<?php
 }}?>
</div>
       
<?php
 if(!empty($user_power)){?>
<div class="left-promo" style="margin-bottom:0;">
<?php
 $this->load->view('public/left_login_ok');?>
</div>
<?php
 }?>

<div id="home-promo">
<?php
 if(!empty($top_news)){?>
<script type="text/javascript">
$(function(){
   <?php
 /*?>滚动信息<?php
 */?>
   $("#news_rolling").Scroll({line:1,speed:500,timer:3000,up:"news_rolling_up",down:"news_rolling_down"});
});
</script>
<div id="news_rolling">
<ul>
<?php
 foreach($top_news as $item){?>
<li>
<h1><a href="<?php
 echo site_url('news/view/'.$item->id);?>" title="<?php
 echo $item->title;?>"><?php
 echo cutstr($item->title,11);?></a></h1>
<p><a href="<?php
 echo site_url('news/view/'.$item->id);?>"><?php
 echo $item->note;?></a></p>
</li>
<?php
 }?>
</ul>
</div>
<?php
 }?>


<?php
 if(!empty($products_ok)){ $i = 0; ?>
<?php
 foreach($products_ok as $item){ $i++; ?>
<div class="home-promo-img"<?php
 if($i%2==0){echo ' style="margin-right:0;"';}?>><a href="<?php
 echo site_url('products/view/'.$item->id);?>"><img src="<?php
 echo $item->pic_s;?>" width="135" title="<?php
 echo $item->title;?>" alt="<?php
 echo $item->title;?>"></a></div>
<?php
 }}?>
</div>
       

<?php
 /*?><?php
 $this->load->view('public/public_type');?><?php
 */?>

       
     
<?php
 /*?>
<div id="enquiry-form">
<!--提示信息-->
<div class="enquiry-form-text"><div id="regformtip"></div></div>
<!--表单-->
<?php
 $this->load->view('public/left_form_box');?>
</div>
<?php
 */?>


<?php
 $this->load->view('public/left_login_box');?>

</div>