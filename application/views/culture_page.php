<?php if(!empty($list)){?>
  <?php foreach($list as $item){?>
  <li><a href="<?php echo site_url('news/view/'.$item->id);?>" target="_blank"><img src="<?php echo $item->pic_s;?>" title="<?php echo $item->title;?>" /></a><div class="title"><?php echo $item->title;?></div></li>
  <?php }?>
<?php }else{?>
<div class="no_info">ffdddddd</div>
<?php }?>