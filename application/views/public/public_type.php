<?php
 if(!empty($p_types)){?>
<div class="clear"></div>
<div id="left-products-type">
<div id="left-products-type-box">

<?php

foreach($p_types as $item){
	$type_url = site_url('products').reUrl('p_type_id='.$item->type_id);
	$type_small = $this->Products_Model->get_types($item->type_id);
?> 
<div class="left_product_class_title">
<a href="<?php
 echo $type_url;?>" target="_blank"><i class="icon-chevron-right"></i> <?php
 echo $item->type_title;?>&nbsp;</a>
</div>

<?php
 if(!empty($type_small)){ $num = 0;?>
<div class="left_product_class_small">
<?php
 foreach($type_small as $type_item){$num++; if($num>1){echo ' | ';}?><a href="<?php
 echo site_url('products').reUrl('p_type_id='.$item->type_id.'&p_types_use_id='.$type_item->type_id);?>" target="_blank"><?php
 echo $type_item->type_title;?></a><?php
 }?>
</div>
<?php
 }?>
<?php
 }?>


<div class="left_product_class_title"><a href="javascript:void(0);"><i class="icon-chevron-right"></i> 风格&nbsp;</a></div>

<?php
 if(!empty($p_styles)){ $num = 0;?>
<div>
<?php
 foreach($p_styles as $style_item){$num++; if($num>1){echo ' | ';}?><a href="<?php
 echo site_url('products').reUrl('p_styles_id='.$style_item->type_id);?>" target="_blank"><?php
 echo $style_item->type_title;?></a><?php
 }?>
</div>
<?php
 }?>

</div></div>   
<?php
 }?>   