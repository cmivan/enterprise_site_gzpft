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
                      
<?php if(!empty($info)){?>

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead>
<tr class="">
<td class="title">
<i class="icon-shopping-cart">&nbsp;</i>订单编号</td>
<td class="time"><i class="icon-time">&nbsp;</i>创建时间</td>
<td class="time"><i class="icon-time">&nbsp;</i>提交时间</td>
<td class="time"><i class="icon-info-sign">&nbsp;</i>状态</td>
<td class="time"><i class="icon-certificate">&nbsp;</i>总额(元)</td>
</tr>
</thead>

<tbody>
<?php if(!empty($info)){?>
<tr class="news_item news_item_hr">
<td class="title"><?php echo $info->order_no;?></td>
<td class="time"><?php echo dateTime($info->add_time);?></td>
<td class="time"><?php if($info->status=='u.shopping'){ echo '-'; }else{ echo dateTime($info->add_time); }?></td>
<td class="time"><strong><?php echo $this->Orders_Model->shopping_status($info->status);?></strong></td>
<td class="time"><span class="all_total"><?php echo $this->Orders_Model->shopping_total($info->oid);?></span></td></tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>

<?php if(!empty($info->note_a)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<tr><td>
<?php if(!empty($info->note_a)&&$info->status=='a.ok.notshipment'){?>
<span class="red"><strong>未发货原因：</strong><?php echo $info->note_a;?></span>
<?php }elseif(!empty($info->note_a)&&$info->status=='a.ok.shipment'){?>
<span class="red"><strong>已发货备注：</strong><?php echo $info->note_a;?></span>
<? }?>
</td></tr>
</table>
<? }?>


<div class="clear"></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead>
<tr>
<td class="title"><i class="icon-shopping-cart">&nbsp;</i>产品名称</td>
<td><i class="icon-time">&nbsp;</i><span class="title">产品预览</span></td>
<td class="time"><i class="icon-time">&nbsp;</i>单价</td>
<td colspan="2" align="center" class="time"><i class="icon-info-sign">&nbsp;</i>订购数量</td>
<td class="time"><i class="icon-certificate">&nbsp;</i>合算(元)</td>
</tr>
</thead>

<tbody>
<?php $i = 1;
foreach($list as $item){
	$i++; if($i%2==0){ $iclass = "news_item news_item_hr"; }else{ $iclass = "news_item"; }
?>
<tr class="<?php echo $iclass;?>">
<td class="title">
<a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><?php echo $item->title;?>
<?php if(!empty($item->pro_no)){?>(<?php echo $item->pro_no;?>)<?php }?></a>
<br><br>
<p>尺寸：<?php echo $item->size_z;?>&nbsp;*&nbsp;<?php echo $item->size_w;?>&nbsp;*&nbsp;<?php echo $item->size_h;?></p>
</td>
<td class="time"><a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><img src="<?php echo $item->pic_s;?>" width="80" /></a></td>
<td class="time"><span class="price"><?php echo $item->price;?></span></td>
<td align="center" class="changeObj"><div class="num"><?php echo $item->num;?></div></td>
<td width="40" align="center">
<?php echo $this->Products_Model->get_inventory_name($item->i_type);?>
</td>
<td class="time"><span class="total"><?php echo $item->num*$item->price;?></span></td>
</tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>
<?php if(!empty($info->note_u)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered">
<thead><tr><td class="title"><i class="icon-shopping-cart">&nbsp;</i>备注</td>
</tr></thead><tbody><tr><td class="title"><?php echo noHtml($info->note_u);?></td>
</tr></tbody></table>
<div class="clear"></div>
<?php }?>

<?php }else{?>
<div class="no_info"><strong>还没有订单哦～</strong><br><br></div>
<?php }?>
</div>
</div></div>

<style type="text/css">
.all_total{
	color:#F00;
	font-weight:bold;
	}
.changeObj{
	width:93px;
	height:30px;
	line-height:30px;
	overflow:hidden;
	}
.changeObj .num{ }
.changeObj .num input{
	width:65px;
	height:18px;
	line-height:18px;
	text-align:center;
	font-weight:bold;
	border:#F63 1px solid;
	border-bottom:#fff 1px solid;
	border-right:#fff 1px solid;
	background-color:#FC9;
	}
</style>

<?php $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>