<?php $this->load->view('public/header');?>
<link href="<?php echo base_url();?>public/style/products.css" rel="stylesheet" type="text/css">

<!-- BEGIN body -->
<body class="page page-template-default ie layout-2cr">
<!-- BEGIN #container -->
<div id="container">
<!-- BEGIN #header -->
<?php $this->load->view('public/top');?>
<!--BEGIN #content -->
<div id="orders_list" class="clearfix">		
<div class="page-title">中国个性原木家居领航者</div>
<div class="clear"></div>
<?php $this->load->view('orders_nav');?>
<div class="clear"></div>

<div class="entry-content">
                      
<?php if(!empty($list)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead>
<tr class="">
<td class="title">
<i class="icon-shopping-cart">&nbsp;</i>订单编号</td>
<td class="time"><i class="icon-time">&nbsp;</i>创建时间</td>
<td class="time"><i class="icon-time">&nbsp;</i>提交时间</td>
<td class="time"><i class="icon-info-sign">&nbsp;</i>状态</td>
<td class="time"><i class="icon-certificate">&nbsp;</i>总额(元)</td>
<td align="center">操作</td>
</tr>
</thead>

<tbody>
<?php $i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>">
<td class="title">
<a target="_blank" href="<?php echo site_url('orders/view/'.$item->oid);?>" title="<?php echo $item->order_no;?>"><?php echo $item->order_no;?></a></td>
<td class="time"><?php echo dateTime($item->add_time);?></td>
<td class="time"><?php echo orderStatusStr($item->status,$item->add_time);?></td>
<td class="time"><?php echo ordersStatusShow($item->status);?></td>
<td class="time"><?php echo $this->Orders_Model->shopping_total($item->oid);?></td>
<td align="center" class="del">
<?php if(strpos($item->status,'.ok.')<=0){?>
<a href="<?php echo reURl('cmd=del&oid='.$item->oid);?>">×取消订单</a>
<? }else{?>
-
<? }?>
</td>
</tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>
<?php $this->paging->links(); ?>
<?php }else{?>
<div class="no_info car_empty">
<div id="empty"><strong>还没有发现失效的订单哦！您可以：</strong><br><br>
  <a href="<?php echo site_url('products');?>">马上去 挑选商品</a><br>
  <a href="<?php echo site_url('orders');?>">看看 已买到的商品</a>
</div></div>
<?php }?>

                      </div>

</div></div> 	
<?php $this->load->view('public/footer');?>

<script language="javascript">
$(function(){
	$('.del a').click(function(){
		if(confirm('确定取消订单吗？')){
			return true;
		}else{
			return false;
		};
	});
});
</script>

<!--END body-->
</body>
<!--END html-->
</html>