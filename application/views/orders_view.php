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

<div class="orders_list_header">&nbsp;导航栏</div>

<div class="clear"></div>

<div class="entry-content">
                      
<?php if(!empty($info)){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-bottom:8px;">
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
<td class="time"><?php echo orderStatusStr($info->status,$info->add_time);?></td>
<td class="time"><strong><?php echo $this->Orders_Model->shopping_status($info->status);?></strong></td>
<td class="time"><span class="all_total"><?php echo $this->Orders_Model->shopping_total($info->oid);?></span></td>
</tr>
<?php }?>
</tbody>
</table>

<div class="clear"></div>
<div class="btn-buy"><a href="javascript:void(0);" id="order-send">查看订单</a></div>
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
<td class="time"><a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><img src="<?php echo $item->pic_s;?>" width="50" /></a></td>
<td class="time"><span class="price"><?php echo $item->price;?></span></td>
<td align="center" class="changeObj"><div class="num"><?php echo orderInput($item->id,'num',$item->num);?></div></td>
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

<script language="javascript">
var $CAR = {};
$CAR = {
	'oid':'<?php echo $info->oid;?>',
	'order_no':'<?php echo $info->order_no;?>',
	'md5':'<?php echo $info->md5;?>'
	};
$(function(){
	//修改产品数量
	$('.table-bordered').find('.num').find('input').change(function(){
		var liObj = $(this).parent().parent().parent();
		var price = liObj.find('.price').text();
		var _input= liObj.find('.num').find('input');
		var num   = _input.val();
		var val   = _input.attr('val');
		if( num!=''&&num==parseInt(num)&&num>0 ){
			num = parseInt(num);
			price = parseInt(price);
			liObj.find('.total').text(price*num).fadeOut(0).fadeIn(300);
			liObj.find('.num').find('input').attr('val',num);
			//累计所有价格
			reTotal();
		}else{
			//还原数值
			_input.val(val);
		}
	});
	//提交产品
	$('#order-send').click(function(){
		var _orders='',_id,_idmd5,_num;
		$('.table-bordered').find('.num').each(function(){
			_id   = $(this).find('input').attr('key');
			_idmd5= $(this).find('input').attr('idmd5');
			_num  = $(this).find('input').val();
			if(_orders!=''){ _orders+= "@"; }
			_orders+= _id+'$'+_idmd5+'$'+_num;
		});
		if(_orders!=''){
			_orders = {"orders":""+_orders+""};
			$.ajax({
				   type:'POST',
				   url:'<?php echo site_url('orders/action');?>',
				   data:_orders,
				   //dataType:'json',
				   success:function(da){
					   alert(da);
				   }
		    });
		}else{
			alert('未能正确获取订单数据!');
		}
	});
	function reTotal(){
		var _total = 0;
		$('.table-bordered').find('.total').each(function(){
			_total+= Math.floor($(this).text());
		});
		if(_total!==0){
			$('.all_total').text(_total).fadeOut(0).fadeIn(300);
		}
	}
});
</script>

<?php $this->load->view('public/footer');?>
<!--END body-->
</body>
<!--END html-->
</html>