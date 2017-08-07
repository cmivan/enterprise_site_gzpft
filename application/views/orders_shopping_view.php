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
<tr>
<td class="title"><i class="icon-shopping-cart">&nbsp;</i>产品名称</td>
<td width="73"><i class="icon-time">&nbsp;</i><span class="title">预览</span></td>
<td width="60">当前库存</td>
<td class="time"><i class="icon-time">&nbsp;</i>单价</td>
<td colspan="2" align="center" class="time"><i class="icon-info-sign">&nbsp;</i>订购数量</td>
<td class="changeObj"><i class="icon-certificate">&nbsp;</i>合算(元)</td>
<td width="40" align="center">操作</td>
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
<td><a target="_blank" href="<?php echo site_url('products/view/'.$item->pid);?>"><img src="<?php echo $item->pic_s;?>" width="80" /></a></td>
<td><b class="all_num red"><?php echo $item->price_vip;?></b></td>
<td class="time"><span class="price"><?php echo $item->price;?></span></td>
<td align="center" class="changeObj"><div class="num"><?php echo orderInput($item->id,'num',$item->num);?></div></td>
<td width="40" align="center"><?php echo $this->Products_Model->get_inventory_name($item->i_type);?></td>
<td class="changeObj"><span class="total"><?php echo $item->num*$item->price;?></span></td>
<td align="center" class="cmd">
<a href="<?php echo reUrl('cmd=del&id='.$item->id);?>" class="del" pid="<?php echo $item->pid;?>" md5="<?php echo pass_key($item->pid);?>">&nbsp;</a>
</td></tr>
<?php }?>
</tbody>
</table>
<div class="clear"></div>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-bottom:8px;">
<thead><tr><td>
<i class="icon-heart">&nbsp;</i><strong>下单备注</strong>
<br>
<div style="line-height:180%;">
    <textarea id="note_u" name="note_u" placeholder="可以在里填写你的备注..." style="width:99%;height:120px;"></textarea>
</div>
 </td>
</tr>
</thead>
</table>
<div class="clear"></div>


<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-bordered" style="margin-bottom:8px;background-color:#FFF3DF">
<thead>
<tr>
  <td>
<i class="icon-heart">&nbsp;</i><strong>下单须知</strong>
<br>
<div style="line-height:180%;">
  1. 木制品尺寸、制作工艺、价格，若根据实际情况做出更改，需经双方沟通确认后执行。
  <br>
  2. 定购单一旦确认，须交足总货款的30% - 50%方构成有效定金；如未付足30%，于3个工作日内补足或付清全款，否则我司拥有以上产品的所有权和处置权，亦有权取消该定单，且定金不予退回。提货方式为款到发货。
  <br>
  3. 因朴风堂产品特性，如未付清全款，提货周期不得超过60个工作日，逾期产生缺货/延迟发货，由买方自行承担。
  <br>
  4. 本售价不含木架费/运费等相关物流费用；如产品需打木架，费用按统一标准100元/方由物流公司收取。
  <br>
  5. 在运输过程中如因我司包装原因所致的产品受损，由我司负责；如因物流公司人为所致或不可抗力因素导致的产品受损，则由买方与物流公司自行协商解决。
  <br>
  6. 本定购单等同于协议效力，签署如有修改，需经双方沟通确认后执行。
</div>
  </td>
</tr>
</thead>
</table>

 


<div class="clear"></div>
<?php if(!empty($info->a_note)&&$info->status=='a.ok.notshipment'){?>
<strong class="red">未发货原因：<?php echo $info->a_note;?></strong>
<?php }elseif(!empty($info->a_note)&&$info->status=='a.ok.shipment'){?>
<strong class="red">已发货备注：<?php echo $info->a_note;?></strong>
<? }?>

<div class="clear"></div>
<div class="btn-buy"><a href="javascript:void(0);" id="order-send">查看订单</a></div>
<div class="clear"></div>

<?php }else{?>
<div class="no_info car_empty">
<div id="empty"><strong>您的购物车还是空的，赶紧行动吧！您可以：</strong><br><br>
  <a href="<?php echo site_url('products');?>">马上去 挑选商品</a><br>
  <a href="<?php echo site_url('orders');?>">看看 已买到的商品</a>
</div></div>
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
			
			//获取当前库存,判断是否已经超出库存
			var pObj = liObj.find('.cmd').find('a.del');
			var pid = pObj.attr('pid'),md5 = pObj.attr('md5');
			if(pid==parseInt(pid)){
				$.ajax({
					type:'POST',
					url:'/orders/all_num.htm',
					data:{'pid':pid,'md5':md5},
					dataType:'json',
					success:function(da){
						var all_num = parseInt(da.info);
						liObj.find('.all_num').text(all_num);
						if(da.cmd=='y'){
							if(all_num>=num){
								//在库存范围内
								liObj.find('.total').text(price*num).fadeOut(0).fadeIn(300);
								liObj.find('.num').find('input').attr('val',num);
							}else{
								alert('该产品只有 [ ' + all_num + ' ] 件库存\r\n您填写的购买数量不能超出库存数量!');
								//超出库存范围
								_input.val(val); /*还原数值*/
							}
						}else{
							alert(da.info);
						}
						//累计所有价格
						reTotal();
					}
				});
			}else{ alert('添加失败,无法获取产品ID'); }

		}else{ _input.val(val); /*还原数值*/ }
	});
	//提交产品
	$('#order-send').click(function(){
		var _orders='',_id,_idmd5,_num,_note_u;
		$('.table-bordered').find('.num').each(function(){
			_id    = $(this).find('input').attr('key');
			_idmd5 = $(this).find('input').attr('idmd5');
			_num   = $(this).find('input').val();
			if(_orders!=''){ _orders+= "@"; }
			_orders+= _id+'$'+_idmd5+'$'+_num;
		});
		if(_orders!=''){
			_note_u= $('#note_u').val();
			_orders = {'orders':_orders,'note_u':_note_u};
			$.ajax({
				   type:'POST',
				   url:'<?php echo site_url('orders/action');?>',
				   data:_orders,
				   dataType:'json',
				   success:function(da){
					   if(da.cmd='y'){
						   alert(da.info);
						   window.location.href='<?php echo site_url('orders');?>';
					   }else{
						   alert(da.info);
					   }
				   }
		    });
		}else{ alert('未能正确获取订单数据,您可能为未添加产品!'); }
	});
	//删除订单
	$('.cmd').find('a.del').click(function(){
		if(confirm('确定将该产品从订单中取消吗？')){
			var pid = $(this).attr('pid'),md5=$(this).attr('md5');
			if(pid==parseInt(pid)){
				$.ajax({
					type:'POST',
					url:'/orders/del.htm',
					data:{'pid':pid,'md5':md5},
					dataType:'json',
					success:function(data){
						if(data.cmd=='y'){
							window.location.reload();
						}else{
							alert(data.info);
						}	
					}
				});
			}else{ alert('添加失败,无法获取产品ID'); }
		}
	});
	//重计总额
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